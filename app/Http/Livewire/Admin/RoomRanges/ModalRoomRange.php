<?php

namespace App\Http\Livewire\Admin\RoomRanges;

use App\Http\Requests\RequestRoomRange;
use App\Models\RoomRange;
use Livewire\Component;

class ModalRoomRange extends Component
{
    public $showModal = 'hidden';
    public $name = '';
    public $description = '';
    public $roomRange;
    public $action = '';
    public $method = '';

    protected $listeners = [
        'showModal', 'showModalNewRoomRange',
    ];

    public function render()
    {
        return view('livewire.admin.room-ranges.modal-room-range');
    }

    public function showModal(RoomRange $roomRange)
    {
        //can('user update');
        $this->resetErrorBag();
        $this->resetValidation();
        $this->roomRange = $roomRange;
        $this->name = $roomRange->name;
        $this->description = $roomRange->description;
        $this->action = 'Update';
        $this->method = 'updateRoomRange';
        $this->showModal = '';
    
    }

    public function closeModal()
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();
    }

    //Update RoomRange
    public function updateRoomRange(){

        $requestRoomRange = new RequestRoomRange();
        $values = $this->validate($requestRoomRange->rules($this->roomRange));

        $this->roomRange->update([
            'name' => $values['name'],
            'description' => $values['description'],
        ]);

        $this->dispatchBrowserEvent('swal:modal', [
            'type' =>'success',
            'title' => 'Room Type update successfully',
            'text' => '',
        ]);

        $this->emit('roomRangeListUpdated');
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();
    }

    //Validaciones en tiempo real
    public function updated($label){

        $requestRoomRange = new RequestRoomRange();
        $this->validateOnly($label, $requestRoomRange->rules($this->roomRange));

    }

    public function showModalNewRoomRange(){

        //can('user create');
        $this->resetErrorBag();
        $this->resetValidation();
        $this->roomRange = null;
        $this->action = 'Create';
        $this->method = 'createRoomRange';
        $this->showModal = '';

    }

    //Create RoomRange
    public function createRoomRange(){

        $requestRoomRange = new RequestRoomRange();
        $values = $this->validate($requestRoomRange->rules(''));
        $roomRange = new RoomRange();
        $roomRange->fill($values);
        $roomRange->save();

        $this->dispatchBrowserEvent('swal:modal', [
            'type' =>'success',
            'title' => 'Room Range added successfully',
            'text' => '',
        ]);

        $this->emit('roomRangeListUpdated');
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();
        $this->closeModal();
    }
}
