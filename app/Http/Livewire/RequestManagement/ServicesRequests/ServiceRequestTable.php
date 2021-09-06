<?php

namespace App\Http\Livewire\RequestManagement\ServicesRequests;

use App\Models\ServicesTransaction;
use Livewire\Component;
use Livewire\WithPagination;

class ServiceRequestTable extends Component
{
    use WithPagination;

    public $showModal = 'hidden';
    public $sortBy = "id";
    public $sortDirection = 'asc';
    public $perPage = 10;
    public $search = '';

    protected $listeners = [
        'servicesTransactionListUpdated' => 'render',
    ];

    public function render(){
        
        $servicesTransactions = ServicesTransaction::whereHas('service', function($q){
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

        return view('livewire.request-management.services-requests.service-request-table', compact('servicesTransactions'));
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

    public function showModal(ServicesTransaction $servicesTransaction){
        //Emitimos al modal edit resource
        if($servicesTransaction->service_id) {
            //can('user update');
            $this->emit('showModal', $servicesTransaction);
        }
    }
}
