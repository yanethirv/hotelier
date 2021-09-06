<?php

namespace App\Http\Livewire\RequestManagement\ActivationServicesRequests;

use App\Models\ActivationServiceTransaction;
use Livewire\Component;
use Livewire\WithPagination;

class ActivationServiceRequestTable extends Component
{
    use WithPagination;

    public $showModal = 'hidden';
    public $sortBy = "id";
    public $sortDirection = 'asc';
    public $perPage = 10;
    public $search = '';

    protected $listeners = [
        'activationServiceTransactionListUpdated' => 'render'
    ];

    public function render(){
        
        $activationServicesTransactions = ActivationServiceTransaction::whereHas('activationService', function($q){
                                $q->where('name', 'like', "%{$this->search}%");
                            })
                            ->orWhereHas('user', function($q){
                                $q->where('name', 'like', "%{$this->search}%");
                            })
                            ->orWhereHas('requestStatus', function($q){
                                $q->where('name', 'like', "%{$this->search}%");
                            })
                            ->orderBy($this->sortBy, $this->sortDirection)
                            ->paginate($this->perPage);

        return view('livewire.request-management.activation-services-requests.activation-service-request-table', compact('activationServicesTransactions'));
    }

    public function sortBy($field){
        if($this->sortDirection == 'asc'){

            $this->sortDirection = 'desc';

        } else{

            $this->sortDirection = 'asc';

        }

        return $this->sortBy = $field;
    }

    public function updatingSearch(){
        $this->resetPage();
    }

    public function showModal(ActivationServiceTransaction $activationServiceTransaction){

        //Emitimos al modal edit resource
        if($activationServiceTransaction->activation_service_id) {
            //can('user update');
            $this->emit('showModal', $activationServiceTransaction);
        }
    }

}
