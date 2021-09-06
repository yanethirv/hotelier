<?php

namespace App\Http\Livewire\Admin\PhotoLocations;

use App\Http\Requests\RequestPhotoLocation;
use App\Models\PhotoLocation;
use Livewire\Component;

class ModalPhotoLocation extends Component
{
    public $showModal = 'hidden';
    public $name = '';
    public $photoLocation;
    public $action = '';
    public $method = '';

    protected $listeners = [
        'showModal', 'showModalNewPhotoLocation',
    ];

    public function render()
    {
        return view('livewire.admin.photo-locations.modal-photo-location');
    }

    public function showModal(PhotoLocation $photoLocation)
    {
        //can('user update');
        $this->resetErrorBag();
        $this->resetValidation();

        $this->photoLocation = $photoLocation;
        $this->name = $photoLocation->name;
        $this->action = 'Update';
        $this->method = 'updatePhotoLocation';

        $this->showModal = '';
    
    }

    public function closeModal()
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();
    }

    //Update PhotoLocation
    public function updatePhotoLocation(){

        $requestPhotoLocation = new RequestPhotoLocation();

        $values = $this->validate($requestPhotoLocation->rules($this->photoLocation));

        $this->photoLocation->update([
            'name' => $values['name'],
        ]);

        $this->dispatchBrowserEvent('swal:modal', [
            'type' =>'success',
            'title' => 'Photo Location update successfully',
            'text' => '',
        ]);

        $this->emit('photoLocationListUpdated');

        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();
    }

    //Validaciones en tiempo real
    public function updated($label){

        $requestPhotoLocation = new RequestPhotoLocation();

        $this->validateOnly($label, $requestPhotoLocation->rules($this->photoLocation));

    }

    public function showModalNewPhotoLocation(){
        can('user create');

        $this->resetErrorBag();
        $this->resetValidation();

        $this->photoLocation = null;
        $this->action = 'Create';
        $this->method = 'createPhotoLocation';

        $this->showModal = '';

    }

    //Create PhotoLocation
    public function createPhotoLocation(){

        $requestPhotoLocation = new RequestPhotoLocation();

        $values = $this->validate($requestPhotoLocation->rules(''));

        $photoLocation = new PhotoLocation();

        $photoLocation->fill($values);

        $photoLocation->save();

        $this->dispatchBrowserEvent('swal:modal', [
            'type' =>'success',
            'title' => 'Photo Location added successfully',
            'text' => '',
        ]);

        $this->emit('photoLocationListUpdated');

        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();

        $this->closeModal();
    }
}
