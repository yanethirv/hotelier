<?php

namespace App\Http\Livewire;

use App\Events\Marketplace\CancelSubscriptionEvent;
use App\Events\Marketplace\ChangeSubscriptionEvent;
use App\Events\Marketplace\ResumeSubscriptionEvent;
use App\Events\Marketplace\SubscriptionRequestEvent;
use App\Mail\Marketplace\ChangeSubscriptionAdminMail;
use App\Models\MarketplaceSubscription;
use App\Models\SubscriptionStatus;
use App\Models\SubscriptionsTransaction;
use App\Models\User;
use App\Notifications\Marketplace\ChangeSubscriptionAdmin;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Livewire\Component;
use Laravel\Cashier\Exceptions\IncompletePayment;
use Laravel\Cashier\Subscription;
use Throwable;

class SubscriptionPay extends Component
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
        return view('livewire.subscription-pay');
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

            $marketplaceSubscription = MarketplaceSubscription::where('price', '=', $this->price)->firstOrFail();

            $subscriptionTransaction = SubscriptionsTransaction::create([
                'user_id' => auth()->user()->id,
                'marketplace_subscription_id' => $marketplaceSubscription->id,
                'stripe_id' => $newSubscription->id
            ]);

            $subscriptionStatus = new SubscriptionStatus();
            $subscriptionStatus->subscriptions_transaction_id = $subscriptionTransaction->id;
            $subscriptionStatus->save();

            event(new SubscriptionRequestEvent($subscriptionTransaction));

            $this->emitTo('marketplace.invoices.invoice-list', 'render');
            $this->emitTo('subscription-pay', 'render');

            $this->dispatchBrowserEvent('swal:modal', [
                'type' =>'success',
                'title' => 'Your subscription was successfully processed',
                'text' => '',
            ]);

            DB::commit();

        } catch (IncompletePayment $exception) {
            return redirect()->route(
                'cashier.payment',
                [$exception->payment->id, 'redirect' => route('billing')]
            );

            $this->dispatchBrowserEvent('swal:modal', [
                'type' =>'success',
                'title' => 'Error subscription',
                'text' => '',
            ]);

            DB::rollBack();
        }
    }

    public function changingPlans(){

        DB::beginTransaction();

        try {

            $changingSubscription = auth()->user()->subscription($this->name)->swapAndInvoice($this->price);

            $marketplaceSubscription = MarketplaceSubscription::where('price', '=', $this->price)->firstOrFail();

            SubscriptionsTransaction::where('user_id', auth()->user()->id)
                    ->where('stripe_id', $changingSubscription->id)
                    ->update(['marketplace_subscription_id' => $marketplaceSubscription->id,
                            'request_status_id' => 8]);

            $subscriptionTransaction = SubscriptionsTransaction::where('user_id', auth()->user()->id)->firstOrFail();

            $subscriptionStatus = new SubscriptionStatus();
            $subscriptionStatus->subscriptions_transaction_id = $subscriptionTransaction->id;
            $subscriptionStatus->request_status_id = $subscriptionTransaction->request_status_id;
            $subscriptionStatus->save();

            $this->emitTo('invoices', 'render');
            $this->emitTo('subscription-pay', 'render');
   
            event(new ChangeSubscriptionEvent($subscriptionTransaction));

            $this->dispatchBrowserEvent('swal:modal', [
                'type' =>'success',
                'title' => 'Your subscription has been successfully changed',
                'text' => '',
            ]);

            DB::commit();

        } catch (Throwable $e) {
            report($e);
    
            return false;

            $this->dispatchBrowserEvent('swal:modal', [
                'type' =>'success',
                'title' => 'Error susbcription',
                'text' => '',
            ]);

            DB::rollBack();
        }
    }

    public function cancellingSubscription(){

        DB::beginTransaction();

        try {
            $cancellingSubscription = auth()->user()->subscription($this->name)->cancel();

            $subscriptionTransaction = SubscriptionsTransaction::where('user_id', auth()->user()->id)
                    ->where('stripe_id', $cancellingSubscription->id)
                    ->update(['request_status_id' => 6]);

            $subscriptionTransaction = SubscriptionsTransaction::where('user_id', auth()->user()->id)->firstOrFail();

            $subscriptionStatus = new SubscriptionStatus();
            $subscriptionStatus->subscriptions_transaction_id = $subscriptionTransaction->id;
            $subscriptionStatus->request_status_id = $subscriptionTransaction->request_status_id;
            $subscriptionStatus->save();

            event(new CancelSubscriptionEvent($subscriptionTransaction));

            $this->emitTo('subscription-pay', 'render');

            $this->dispatchBrowserEvent('swal:modal', [
                'type' =>'success',
                'title' => 'Your subscription has been cancelled',
                'text' => '',
            ]);

            DB::commit();

        } catch (Throwable $e) {
            report($e);
    
            return false;

            $this->dispatchBrowserEvent('swal:modal', [
                'type' =>'success',
                'title' => 'Error subscription',
                'text' => '',
            ]);

            DB::rollBack();

        }
    }

    public function resuminSubscription(){

        DB::beginTransaction();

        try {
            $resuminSubscription = auth()->user()->subscription($this->name)->resume();

            $subscriptionTransaction = SubscriptionsTransaction::where('user_id', auth()->user()->id)
                    ->where('stripe_id', $resuminSubscription->id)
                    ->update(['request_status_id' => 7]);

            $subscriptionTransaction = SubscriptionsTransaction::where('user_id', auth()->user()->id)->firstOrFail();

            $subscriptionStatus = new SubscriptionStatus();
            $subscriptionStatus->subscriptions_transaction_id = $subscriptionTransaction->id;
            $subscriptionStatus->request_status_id = $subscriptionTransaction->request_status_id;
            $subscriptionStatus->save();
        
            event(new ResumeSubscriptionEvent($subscriptionTransaction));

            $this->emitTo('subscription-pay', 'render');
        
            $this->dispatchBrowserEvent('swal:modal', [
                'type' =>'success',
                'title' => 'Your subscription has been resumed',
                'text' => '',
            ]);

            DB::commit();

        } catch (Throwable $e) {
            report($e);
    
            return false;

            $this->dispatchBrowserEvent('swal:modal', [
                'type' =>'success',
                'title' => 'Error subscription',
                'text' => '',
            ]);

            DB::rollBack();

        }
    }
}