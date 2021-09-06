<?php

namespace App\Http\Livewire\Hotel\Rooms;

use App\Models\Property;
use App\Models\Room;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class RoomTable extends Component
{
    use WithPagination;

    public $showModal = 'hidden';
    public $sortBy = "id";
    public $sortDirection = 'asc';
    public $perPage = 10;
    public $search = '';

    protected $listeners = [
        'roomListUpdated' => 'render', 'deleteRoom' => 'deleteRoom',
    ];


    public function render()
    {
        $properties = Property::where('user_id', auth()->user()->id)->pluck('id')->toArray();

        $callback = function ($q) {
            $q->where('name', 'like', "%{$this->search}%");
        };

        $code = $this->search;
        
        $rooms = Room::where(function ($query) use ($properties) {
                        $query->whereIn('property_id',$properties);
                    })
                    ->where(function ($query) use ($callback, $code) {
                        $query->whereHas('property', $callback)
                            ->orWhereHas('roomType', $callback)
                            ->orWhereHas('occupancy', $callback)
                            ->orWhere('code', 'like', "%{$code}%");
                    })
                    ->orderBy($this->sortBy, $this->sortDirection)
                    ->paginate($this->perPage);

        return view('livewire.hotel.rooms.room-table', compact('rooms'));
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

    public function showModal(Room $room){

        //Emitimos al modal edit resource
        if($room->property_id) {
            //can('user update');
            $this->emit('showModal', $room);
        } else {
            //can('user create');
            $this->emit('showModalNewRoom');
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

    public function deleteRoom(Room $room){

        try {

            $room->delete();

            $this->render();

        } catch (\Exception $e) {

            $this->dispatchBrowserEvent('swal:modal', [
                'type' =>'warning',
                'title' => 'Room error',
                'text' => '',
                ]);

        }
    }
}
