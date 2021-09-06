<?php

namespace App\Http\Livewire\Admin\PolicyTypes;

use App\Models\PolicyType;
use Livewire\Component;
use Livewire\WithPagination;

class PolicyTypeTable extends Component
{
    use WithPagination;

    public $showModal = 'hidden';
    public $sortBy = "id";
    public $sortDirection = 'asc';
    public $perPage = 10;
    public $search = '';

    protected $listeners = [
        'policyTypeListUpdated' => 'render', 'deletePolicyType' => 'deletePolicyType',
    ];

    public function render()
    {
        $policyTypes = PolicyType::query()
            ->search($this->search)
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate($this->perPage);

        return view('livewire.admin.policy-types.policy-type-table', compact('policyTypes'));
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

    public function showModal(PolicyType $policyType){
        //Emitimos al modal edit resource
        if($policyType->name) {
            //can('user update');
            $this->emit('showModal', $policyType);
        } else {
            //can('user create');
            $this->emit('showModalNewPolicyType');
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

    public function deletePolicyType(PolicyType $policyType){

        try {

            $policyType->delete();

            $this->render();

        } catch (\Exception $e) {

            $this->dispatchBrowserEvent('swal:modal', [
                'type' =>'warning',
                'title' => 'Type error',
                'text' => '',
                ]);
        }
    }
}
