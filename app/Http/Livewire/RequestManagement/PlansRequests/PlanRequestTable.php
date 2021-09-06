<?php

namespace App\Http\Livewire\RequestManagement\PlansRequests;

use App\Models\PlansTransaction;
use Livewire\Component;
use Livewire\WithPagination;

class PlanRequestTable extends Component
{
    use WithPagination;

    public $showModal = 'hidden';
    public $sortBy = "id";
    public $sortDirection = 'asc';
    public $perPage = 10;
    public $search = '';

    protected $listeners = [
        'plansTransactionListUpdated' => 'render',
    ];

    public function render(){
        
        $plansTransactions = PlansTransaction::whereHas('user', function($q){
                                $q->where('name', 'like', "%{$this->search}%");
                            })
                            ->orWhereHas('plan', function($q){
                                $q->where('nickname', 'like', "%{$this->search}%");
                            })
                            ->orWhereHas('requestStatus', function($q){
                                $q->where('name', 'like', "%{$this->search}%");
                            })
                            ->orderBy($this->sortBy, $this->sortDirection)
                            ->paginate($this->perPage);

        return view('livewire.request-management.plans-requests.plan-request-table', compact('plansTransactions'));
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

    public function showModal(PlansTransaction $plansTransaction){

        //dd($plansTransaction->plan_id);

        if($plansTransaction->plan_id) {
            //can('user update');
            $this->emit('showModal', $plansTransaction);
        }
    }

}
