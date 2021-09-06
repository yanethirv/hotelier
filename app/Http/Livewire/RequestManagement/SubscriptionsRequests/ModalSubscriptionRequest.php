<?php

namespace App\Http\Livewire\RequestManagement\SubscriptionsRequests;

use App\Events\RequestManagement\StatusSubscriptionEvent;
use App\Http\Requests\RequestSubscriptionsTransaction;
use App\Models\SubscriptionStatus;
use App\Models\SubscriptionsTransaction;
use App\Models\RequestStatus;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ModalSubscriptionRequest extends Component
{
    public $showModal = 'hidden';
    public $status = '';
    public $plan_id = '';
    public $request_status_id = '';
    public $comment = '';
    public $subscriptionsTransaction;
    public $requestStatus = [];
    public $action = '';
    public $method = '';

    protected $listeners = ['showModal'];

    public function hydrate(){

        $this->requestStatus = RequestStatus::pluck('name', 'id')->toArray();

    }

    public function render(){

        return view('livewire.request-management.subscriptions-requests.modal-subscription-request');

    }

    public function showModal(SubscriptionsTransaction $subscriptionsTransaction){

        $this->resetErrorBag();
        $this->resetValidation();
        $this->subscriptionsTransaction = $subscriptionsTransaction;
        $this->request_status_id = $subscriptionsTransaction->requestStatus()->first()->id ?? '';
        $this->action = 'Update';
        $this->method = 'updateSubscriptionTransaction';
        $this->showModal = '';
        $this->comment = '';
    
    }

    public function closeModal()
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();
    }

    //Update ActivationSubscription
    public function updateSubscriptionTransaction(){
        $requestSubscriptionTransaction = new RequestSubscriptionsTransaction();
        $values = $this->validate($requestSubscriptionTransaction->rules($this->subscriptionsTransaction));

        DB::beginTransaction();

        try {
            $subscriptionsTransaction = SubscriptionsTransaction::find($this->subscriptionsTransaction->id);
            $subscriptionsTransaction->request_status_id = $values['request_status_id'];
            $subscriptionsTransaction->save();

            $subscriptionStatus = new SubscriptionStatus();
            $subscriptionStatus->subscriptions_transaction_id = $subscriptionsTransaction->id;
            $subscriptionStatus->request_status_id = $subscriptionsTransaction->request_status_id;
            $subscriptionStatus->comment = $this->comment;
            $subscriptionStatus->save();

            event(new StatusSubscriptionEvent($subscriptionsTransaction));

            $this->dispatchBrowserEvent('swal:modal', [
                'type' =>'success',
                'title' => 'Subscription Transaction update successfully',
                'text' => '',
            ]);

            DB::commit();

        } catch (\Exception $e) {

            $this->dispatchBrowserEvent('swal:modal', [
                'type' =>'warning',
                'title' => 'Subscription Transaction error',
                'text' => '',
                ]);

            DB::rollback();

        }

        $this->emit('subscriptionTransactionListUpdated');
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();
    }

    //Validaciones en tiempo real
    public function updated($label){

        $requestSubscriptionTransaction = new RequestSubscriptionsTransaction();
        $this->validateOnly($label, $requestSubscriptionTransaction->rules($this->subscriptionsTransaction));

    }

}