<?php

namespace App\Http\Livewire\Hotel\Policies;

use App\Models\Policy;
use App\Models\Property;
use Livewire\Component;
use Livewire\WithPagination;

class PolicyTable extends Component
{
    use WithPagination;

    public $showModal = 'hidden';
    public $sortBy = "id";
    public $sortDirection = 'asc';
    public $perPage = 10;
    public $search = '';

    protected $listeners = [
        'policyListUpdated' => 'render', 'deletePolicy' => 'deletePolicy',
    ];

    public function render()
    {
        $properties = Property::where('user_id', auth()->user()->id)->pluck('id')->toArray();

        $callback = function ($q) {
            $q->where('name', 'like', "%{$this->search}%");
        };

        $name = $this->search;
        
        $policies = Policy::where(function ($query) use ($properties) {
                        $query->whereIn('property_id',$properties);
                    })
                    ->where(function ($query) use ($callback, $name) {
                        $query->whereHas('property', $callback)
                            ->orWhereHas('policyType', $callback)
                            ->orWhere('name', 'like', "%{$name}%");
                    })
                    ->orderBy($this->sortBy, $this->sortDirection)
                    ->paginate($this->perPage);

        return view('livewire.hotel.policies.policy-table', compact('policies'));
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

    public function showModal(Policy $policy){

        //Emitimos al modal edit resource
        if($policy->name) {
            //can('user update');
            $this->emit('showModal', $policy);
        } else {
            //can('user create');
            $this->emit('showModalNewPolicy');
        }
    }

    public function deleteConfirm($id){
        
        $this->dispatchBrowserEvent('swal:confirm', [
            'type' =>'warning',
            'title' => 'Are you sure?',
            'text' => '',
            'id' => $id,
        ]);
    }

    public function deletePolicy(Policy $policy){

        try {

            $policy->delete();

            $this->render();

        } catch (\Exception $e) {

            $this->dispatchBrowserEvent('swal:modal', [
                'type' =>'warning',
                'title' => 'Policy error',
                'text' => '',
                ]);

        }

    }
}
