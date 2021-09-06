<?php

namespace App\Http\Livewire\Admin\RoomTypes;

use App\Http\Requests\RequestRoomType;
use App\Models\RoomType;
use Livewire\Component;

class ModalRoomType extends Component
{
    public $showModal = 'hidden';
    public $name = '';
    public $description = '';
    public $roomType;
    public $action = '';
    public $method = '';

    protected $listeners = [
        'showModal', 'showModalNewRoomType',
    ];

    public function render()
    {
        return view('livewire.admin.room-types.modal-room-type');
    }

    public function showModal(RoomType $roomType)
    {
        //can('user update');
        $this->resetErrorBag();
        $this->resetValidation();
        $this->roomType = $roomType;
        $this->name = $roomType->name;
        $this->description = $roomType->description;
        $this->action = 'Update';
        $this->method = 'updateRoomType';
        $this->showModal = '';
    }

    public function closeModal()
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();
    }

    //Update RoomType
    public function updateRoomType(){
        $requestRoomType = new RequestRoomType();
        $values = $this->validate($requestRoomType->rules($this->roomType));

        $this->roomType->update([
            'name' => $values['name'],
            'description' => $values['description'],
        ]);

        $this->dispatchBrowserEvent('swal:modal', [
            'type' =>'success',
            'title' => 'Room Type update successfully',
            'text' => '',
        ]);

        $this->emit('roomTypeListUpdated');
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();
    }

    //Validaciones en tiempo real
    public function updated($label){
        $requestRoomType = new RequestRoomType();
        $this->validateOnly($label, $requestRoomType->rules($this->roomType));
    }

    public function showModalNewRoomType(){
        //can('user create');
        $this->resetErrorBag();
        $this->resetValidation();
        $this->roomType = null;
        $this->action = 'Create';
        $this->method = 'createRoomType';
        $this->showModal = '';
    }

    //Create RoomType
    public function createRoomType(){
        $requestRoomType = new RequestRoomType();
        $values = $this->validate($requestRoomType->rules(''));
        $roomType = new RoomType();
        $roomType->fill($values);
        $roomType->save();

        $this->dispatchBrowserEvent('swal:modal', [
            'type' =>'success',
            'title' => 'Room Type added successfully',
            'text' => '',
        ]);

        $this->emit('roomTypeListUpdated');
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();
        $this->closeModal();
    }
}
