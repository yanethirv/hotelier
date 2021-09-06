<?php

namespace App\Http\Livewire\RequestManagement\SubscriptionsRequests;

use App\Models\SubscriptionsTransaction;
use Livewire\Component;
use Livewire\WithPagination;

class SubscriptionRequestTable extends Component
{
    use WithPagination;

    public $showModal = 'hidden';
    public $sortBy = "id";
    public $sortDirection = 'asc';
    public $perPage = 10;
    public $search = '';

    protected $listeners = [
        'subscriptionTransactionListUpdated' => 'render',
    ];

    public function render(){
        
        $subscriptionsTransactions = SubscriptionsTransaction::whereHas('user', function($q){
                                $q->where('name', 'like', "%{$this->search}%");
                            })
                            ->orWhereHas('marketplacesubscription', function($q){
                                $q->where('subscription_name', 'like', "%{$this->search}%");
                            })
                            ->orWhereHas('requestStatus', function($q){
                                $q->where('name', 'like', "%{$this->search}%");
                            })
                            ->orderBy($this->sortBy, $this->sortDirection)
                            ->paginate($this->perPage);

        return view('livewire.request-management.subscriptions-requests.subscription-request-table', compact('subscriptionsTransactions'));
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

    public function showModal(SubscriptionsTransaction $subscriptionsTransaction){
        //Emitimos al modal edit resource
        if($subscriptionsTransaction->marketplace_subscription_id) {
            //can('user update');
            $this->emit('showModal', $subscriptionsTransaction);
        }
    }

}
