<?php

namespace App\Http\Livewire\Admin\RoomRanges;

use App\Models\RoomRange;
use Livewire\Component;
use Livewire\WithPagination;

class RoomRangeTable extends Component
{
    use WithPagination;

    public $showModal = 'hidden';
    public $sortBy = "id";
    public $sortDirection = 'asc';
    public $perPage = 10;
    public $search = '';

    protected $listeners = [
        'roomRangeListUpdated' => 'render',
        'deleteRoomRange' => 'deleteRoomRange',
    ];

    public function render()
    {
        $roomRanges = RoomRange::query()
            ->search($this->search)
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate($this->perPage);

        return view('livewire.admin.room-ranges.room-range-table', compact('roomRanges'));
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

    public function showModal(RoomRange $roomRange){
        //Emitimos al modal edit resource
        if($roomRange->name) {
            //can('user update');
            $this->emit('showModal', $roomRange);
        } else {
            //can('user create');
            $this->emit('showModalNewRoomRange');
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

    public function deleteRoomRange(RoomRange $roomRange){

        try {

            $roomRange->delete();

            $this->render();

        } catch (\Exception $e) {

            $this->dispatchBrowserEvent('swal:modal', [
                'type' =>'warning',
                'title' => 'Room Range error',
                'text' => '',
                ]);
        }
    }
}
