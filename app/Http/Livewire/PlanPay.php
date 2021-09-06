<?php

namespace App\Http\Livewire;

use App\Events\Marketplace\PlanRequestEvent;
use App\Models\Plan;
use App\Models\PlanStatus;
use App\Models\PlansTransaction;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Laravel\Cashier\Exceptions\IncompletePayment;
use Laravel\Cashier\Subscription;
use Throwable;

class PlanPay extends Component
{
    public $price;
    public $name;
    public $amount;
    public $coupon;
    protected $listeners = ['render'];

    public function mount($price){

        $this->price = $price;

    }
    
    public function render()
    {
        return view('livewire.plan-pay');
    }

    public function newSubscription(){

        DB::beginTransaction();

        try {
            if ($this->coupon) {
                $newSubscription = auth()->user()->newSubscription($this->name, $this->price)
                                        //->trialDays(7)
                                        ->withCoupon($this->coupon)
                                        ->create();
            } else {
                $newSubscription = auth()->user()->newSubscription($this->name, $this->price)
                                        //->trialDays(7)
                                        ->create();       
            }

            $plan = Plan::where('stripe_id', '=', $this->price)->firstOrFail();

            $planTransaction = PlansTransaction::create([
                'user_id' => auth()->user()->id,
                'plan_id' => $plan->id,
                'stripe_id' => $newSubscription->id
            ]);

            $planStatus = new PlanStatus();
            $planStatus->plans_transaction_id = $planTransaction->id;
            $planStatus->save();

            event(new PlanRequestEvent($planTransaction));

            $this->emitTo('invoices.invoice-list', 'render');
            $this->emitTo('plan-pay', 'render');

            $this->dispatchBrowserEvent('swal:modal', [
                'type' =>'success',
                'title' => 'Your payment was successfully processed',
                'text' => '',
            ]);
        
            DB::commit();

        } catch (IncompletePayment $exception) {
            return redirect()->route(
                'cashier.payment',
                [$exception->payment->id, 'redirect' => route('billing')]
            );

            DB::rollBack();

        }
    }

    public function changingPlans(){

        DB::beginTransaction();

        try {
            $changingPlan = auth()->user()->subscription($this->name)->swapAndInvoice($this->price);

            $plan = Plan::where('stripe_id', '=', $this->price)->firstOrFail();

            PlansTransaction::where('user_id', auth()->user()->id)
                    ->where('stripe_id', $changingPlan->id)
                    ->update(['plan_id' => $plan->id, 'plan_status' => 'active']);

            $this->emitTo('invoices', 'render');
            $this->emitTo('plan-pay', 'render');

            DB::commit();

        } catch (Throwable $e) {
            report($e);
    
            return false;

            DB::rollBack();

        }
    }

    public function cancellingSubscription(){

        DB::beginTransaction();

        try {
            $cancellingPlan = auth()->user()->subscription($this->name)->cancel();

            PlansTransaction::where('user_id', auth()->user()->id)
                    ->where('stripe_id', $cancellingPlan->id)
                    ->update(['plan_status' => 'cancel']);

            $this->emitTo('plan-pay', 'render');

            DB::commit();

        } catch (Throwable $e) {
            report($e);
    
            return false;

            DB::rollBack();

        }
    }

    public function resuminSubscription(){

        DB::beginTransaction();

        try {
            $resuminPlan = auth()->user()->subscription($this->name)->resume();

            PlansTransaction::where('user_id', auth()->user()->id)
                    ->where('stripe_id', $resuminPlan->id)
                    ->update(['plan_status' => 'active']);

            $this->emitTo('plan-pay', 'render');

            DB::commit();
        
        } catch (Throwable $e) {
            report($e);
    
            return false;

            DB::rollBack();

        }
    }
}