<?php

namespace App\Http\Livewire\Admin\Plans;

use App\Http\Requests\RequestPlan;
use App\Models\Plan;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
//use Livewire\WithFileUploads;

class ModalPlan extends Component
{
    //use WithFileUploads;

    public $showModal = 'hidden';
    public $nickname = '';
    public $description = '';
    public $amount = '';
    public $product_id = '';
    public $product = '';
    public $stripe_id = '';
    public $product_name = '';
    //public $attachment;
    public $products = [];
    public $plan;
    public $action = '';
    public $method = '';
    public $iterator='';

    protected $listeners = ['showModal', 'showModalNewPlan', 'removeFile'];

    public function mount(){

        $this->iterator = rand();

    }

    public function hydrate(){

        $this->products = Product::pluck('name', 'id')->toArray();

    }

    public function render(){

        return view('livewire.admin.plans.modal-plan');

    }

    public function showModal(Plan $plan){

        //can('user update');
        $this->resetErrorBag();
        $this->resetValidation();
        $this->plan = $plan;
        $this->nickname = $plan->nickname;
        $this->description = $plan->description;
        $this->amount = $plan->amount;
        $this->product_id = $plan->product()->first()->id ?? '';
        //$this->attachment = $plan->attachment;
        $this->action = 'Update';
        $this->method = 'updatePlan';
        $this->showModal = '';
    
    }

    public function closeModal()
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();
    }

    //Update Plan
    public function updatePlan(){

        $stripe = new \Stripe\StripeClient(env("STRIPE_SECRET"));
        $requestPlan = new RequestPlan();
        $values = $this->validate($requestPlan->rules($this->plan));

        DB::beginTransaction();

        try {

            $stripe->prices->update(
                $this->plan->stripe_id,
                ['nickname' => $values['nickname']]
            );
            
            $this->plan->update([
                'nickname' => $values['nickname'],
                'description' => $values['description']
            ]);

            $this->dispatchBrowserEvent('swal:modal', [
                'type' =>'success',
                'title' => 'Plan update successfully',
                'text' => '',
            ]);

            DB::commit();

        } catch (\Exception $e) {

            $this->dispatchBrowserEvent('swal:modal', [
                'type' =>'warning',
                'title' => 'Plan error',
                'text' => '',
                ]);
            
            DB::rollBack();
        }

        $this->emit('planListUpdated');
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();
        $this->iterator = rand();
    }

    //Validaciones en tiempo real
    public function updated($label){

        $requestPlan = new RequestPlan();
        $this->validateOnly($label, $requestPlan->rules($this->plan));

    }

    public function showModalNewPlan(){
        //can('user create');

        $this->resetErrorBag();
        $this->resetValidation();
        $this->plan = null;
        $this->action = 'Create';
        $this->method = 'createPlan';
        $this->showModal = '';

    }
    
    //Create Plan
    public function createPlan(){

        $stripe = new \Stripe\StripeClient(env("STRIPE_SECRET"));
        $requestPlan = new RequestPlan();
        $values = $this->validate($requestPlan->rules(''));

        $producto = Product::find($values['product_id']);

        $amount = intval($values['amount'] * 100);

        DB::beginTransaction();
            
        try {

            $planStripe = $stripe->prices->create([
                'unit_amount' => $amount,
                'currency' => 'usd',
                'recurring' => ['interval' => 'month'],
                'product' => $producto->stripe_id,
                'nickname' => $values['nickname']
              ]);


            $values['product_name'] = $producto->name;
            $values['product'] = $producto->stripe_id;
            $values['stripe_id'] = $planStripe->id;

            $plan = new Plan();
            $plan->fill($values);
            $plan->save();

            $this->dispatchBrowserEvent('swal:modal', [
                'type' =>'success',
                'title' => 'Plan added successfully',
                'text' => '',
            ]);

            DB::commit();

        } catch (\Exception $e) {

            $this->dispatchBrowserEvent('swal:modal', [
                'type' =>'warning',
                'title' => 'Plan error',
                'text' => '',
                ]);

            DB::rollBack();
        }

        $this->emit('planListUpdated');
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();
        $this->closeModal();
    }

    //Remove Attachment
}
