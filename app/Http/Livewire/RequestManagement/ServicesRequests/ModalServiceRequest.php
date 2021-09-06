<?php

namespace App\Http\Livewire\RequestManagement\ServicesRequests;

use App\Events\RequestManagement\StatusServiceEvent;
use App\Http\Requests\RequestServiceTransaction;
use App\Models\ServiceStatus;
use App\Models\ServicesTransaction;
use App\Models\RequestStatus;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ModalServiceRequest extends Component
{
    public $showModal = 'hidden';
    public $status = '';
    public $plan_id = '';
    public $request_status_id = '';
    public $comment = '';
    public $servicesTransaction;
    public $requestStatus = [];
    public $action = '';
    public $method = '';

    protected $listeners = ['showModal'];

    public function hydrate(){

        $this->requestStatus = RequestStatus::pluck('name', 'id')->toArray();

    }

    public function render(){

        return view('livewire.request-management.services-requests.modal-service-request');

    }

    public function showModal(ServicesTransaction $servicesTransaction){

        $this->resetErrorBag();
        $this->resetValidation();
        $this->servicesTransaction = $servicesTransaction;
        $this->request_status_id = $servicesTransaction->requestStatus()->first()->id ?? '';
        $this->action = 'Update';
        $this->method = 'updateServiceTransaction';
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
    public function updateServiceTransaction(){
        $requestServiceTransaction = new RequestServiceTransaction();
        $values = $this->validate($requestServiceTransaction->rules($this->servicesTransaction));

        DB::beginTransaction();

        try {
            $servicesTransaction = ServicesTransaction::find($this->servicesTransaction->id);
            $servicesTransaction->request_status_id = $values['request_status_id'];
            $servicesTransaction->save();

            $serviceStatus = new ServiceStatus();
            $serviceStatus->services_transaction_id = $this->servicesTransaction->id;
            $serviceStatus->request_status_id = $values['request_status_id'];
            $serviceStatus->comment = $this->comment;
            $serviceStatus->save();

            event(new StatusServiceEvent($servicesTransaction));

            $this->dispatchBrowserEvent('swal:modal', [
                'type' =>'success',
                'title' => 'Service Transaction update successfully',
                'text' => '',
            ]);

            DB::commit();

        } catch (\Exception $e) {

            $this->dispatchBrowserEvent('swal:modal', [
                'type' =>'warning',
                'title' => 'Service Transaction error',
                'text' => '',
                ]);

            DB::rollback();

        }

        $this->emit('servicesTransactionListUpdated');
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();
    }

    //Validaciones en tiempo real
    public function updated($label){

        $requestServiceTransaction = new RequestServiceTransaction();
        $this->validateOnly($label, $requestServiceTransaction->rules($this->servicesTransaction));

    }

}