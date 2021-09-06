<?php

namespace App\Http\Livewire\Admin\RoomTypes;

use App\Models\RoomType;
use Livewire\Component;
use Livewire\WithPagination;

class RoomTypeTable extends Component
{
    use WithPagination;

    public $showModal = 'hidden';

    public $sortBy = "id";

    public $sortDirection = 'asc';

    public $perPage = 10;

    public $search = '';

    protected $listeners = [
        'roomTypeListUpdated' => 'render',
        'deleteRoomType' => 'deleteRoomType',
    ];

    public function render()
    {
        $roomTypes = RoomType::query()
            ->search($this->search)
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate($this->perPage);

        return view('livewire.admin.room-types.room-type-table', compact('roomTypes'));
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

    public function showModal(RoomType $roomType){
        //Emitimos al modal edit resource
        if($roomType->name) {
            //can('user update');
            $this->emit('showModal', $roomType);
        } else {
            //can('user create');
            $this->emit('showModalNewRoomType');
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

    public function deleteRoomType(RoomType $roomType){

        try {

            $roomType->delete();

            $this->render();

        } catch (\Exception $e) {

            $this->dispatchBrowserEvent('swal:modal', [
                'type' =>'warning',
                'title' => 'Room Type error',
                'text' => '',
                ]);
        }
    }
}
