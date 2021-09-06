<?php

namespace App\Http\Livewire\RequestManagement\PlansRequests;

use App\Events\RequestManagement\StatusPlanEvent;
use App\Http\Requests\RequestPlansTransaction;
use App\Models\ActivationStatus;
use App\Models\PlanStatus;
use App\Models\PlansTransaction;
use App\Models\RequestStatus;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ModalPlanRequest extends Component
{
    public $showModal = 'hidden';
    public $status = '';
    public $plan_id = '';
    public $request_status_id = '';
    public $comment = '';
    public $plansTransaction;
    public $requestStatus = [];
    public $action = '';
    public $method = '';

    protected $listeners = ['showModal'];

    public function hydrate(){

        $this->requestStatus = RequestStatus::pluck('name', 'id')->toArray();

    }

    public function render(){

        return view('livewire.request-management.plans-requests.modal-plan-request');

    }

    public function showModal(PlansTransaction $plansTransaction){

        $this->resetErrorBag();
        $this->resetValidation();
        $this->plansTransaction = $plansTransaction;
        $this->request_status_id = $plansTransaction->requestStatus()->first()->id ?? '';
        $this->action = 'Update';
        $this->method = 'updatePlansTransaction';
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
    public function updatePlansTransaction(){
        $requestPlansTransaction = new RequestPlansTransaction();
        $values = $this->validate($requestPlansTransaction->rules($this->plansTransaction));

        DB::beginTransaction();

        try {
            $plansTransaction = PlansTransaction::find($this->plansTransaction->id);
            $plansTransaction->request_status_id = $values['request_status_id'];
            $plansTransaction->save();

            $planStatus = new PlanStatus();
            $planStatus->plans_transaction_id = $this->plansTransaction->id;
            $planStatus->request_status_id = $values['request_status_id'];
            $planStatus->comment = $this->comment;
            $planStatus->save();

            event(new StatusPlanEvent($plansTransaction));

            $this->dispatchBrowserEvent('swal:modal', [
                'type' =>'success',
                'title' => 'Plan Transaction update successfully',
                'text' => '',
            ]);

            DB::commit();

        } catch (\Exception $e) {

            $this->dispatchBrowserEvent('swal:modal', [
                'type' =>'warning',
                'title' => 'Plan Transaction error',
                'text' => '',
                ]);

            DB::rollback();

        }

        $this->emit('plansTransactionListUpdated');
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();
    }

    //Validaciones en tiempo real
    public function updated($label){

        $requestPlansTransaction = new RequestPlansTransaction();
        $this->validateOnly($label, $requestPlansTransaction->rules($this->plansTransaction));

    }

}