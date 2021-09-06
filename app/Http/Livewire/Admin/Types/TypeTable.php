<?php

namespace App\Http\Livewire\Admin\Types;

use App\Models\Type;
use Livewire\Component;
use Livewire\WithPagination;

class TypeTable extends Component
{
    use WithPagination;

    public $showModal = 'hidden';

    public $sortBy = "id";

    public $sortDirection = 'asc';

    public $perPage = 10;

    public $search = '';

    protected $listeners = [
        'typeListUpdated' => 'render',
        'deleteType' => 'deleteType',
    ];

    public function render()
    {
        $types = Type::query()
            ->search($this->search)
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate($this->perPage);

        return view('livewire.admin.types.type-table', compact('types'));
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

    public function showModal(Type $type){
        //Emitimos al modal edit resource
        if($type->name) {
            //can('user update');
            $this->emit('showModal', $type);
        } else {
            //can('user create');
            $this->emit('showModalNewType');
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

    public function deleteType(Type $type){

        try {

            $type->delete();

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
