<?php

namespace App\Http\Livewire\RequestManagement\ActivationServicesRequests;

use App\Events\RequestManagement\StatusActivationServiceEvent;
use App\Http\Requests\RequestActivationServiceTransaction;
use App\Models\ActivationServiceTransaction;
use App\Models\ActivationStatus;
use App\Models\RequestStatus;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class ModalActivationServiceRequest extends Component
{
    public $showModal = 'hidden';
    public $status = '';
    public $activation_service_id = '';
    public $request_status_id = '';
    public $comment = '';
    public $activationServiceTransaction;
    public $requestStatus = [];
    public $action = '';
    public $method = '';

    protected $listeners = ['showModal'];

    public function hydrate(){

        $this->requestStatus = RequestStatus::pluck('name', 'id')->toArray();

    }

    public function render(){

        return view('livewire.request-management.activation-services-requests.modal-activation-service-request');

    }

    public function showModal(ActivationServiceTransaction $activationServiceTransaction){

        $this->resetErrorBag();
        $this->resetValidation();
        $this->activationServiceTransaction = $activationServiceTransaction;
        $this->request_status_id = $activationServiceTransaction->requestStatus()->first()->id ?? '';
        $this->action = 'Update';
        $this->method = 'updateActivationServiceTransaction';
        $this->showModal = '';
        $this->comment = '';
    
    }

    public function closeModal()
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();
    }

    //Update ActivationService
    public function updateActivationServiceTransaction(){
        $requestActivationServiceTransaction = new RequestActivationServiceTransaction();
        $values = $this->validate($requestActivationServiceTransaction->rules($this->activationServiceTransaction));

        DB::beginTransaction();

        try {
            $activationServiceTransaction = ActivationServiceTransaction::find($this->activationServiceTransaction->id);
            $activationServiceTransaction->request_status_id = $values['request_status_id'];
            $activationServiceTransaction->save();

            $activationStatus = new ActivationStatus();
            $activationStatus->activation_service_transaction_id = $this->activationServiceTransaction->id;
            $activationStatus->request_status_id = $values['request_status_id'];
            $activationStatus->comment = $this->comment;
            $activationStatus->save();

            event(new StatusActivationServiceEvent($activationServiceTransaction));

            $this->dispatchBrowserEvent('swal:modal', [
                'type' =>'success',
                'title' => 'Activation Service Transaction update successfully',
                'text' => '',
            ]);

            DB::commit();

        } catch (\Exception $e) {

            $this->dispatchBrowserEvent('swal:modal', [
                'type' =>'warning',
                'title' => 'Activation Service Transaction error',
                'text' => '',
                ]);

            DB::rollback();

        }

        $this->emit('activationServiceTransactionListUpdated');
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();
    }

    //Validaciones en tiempo real
    public function updated($label){

        $requestActivationServiceTransaction = new RequestActivationServiceTransaction();
        $this->validateOnly($label, $requestActivationServiceTransaction->rules($this->activationServiceTransaction));

    }

}

