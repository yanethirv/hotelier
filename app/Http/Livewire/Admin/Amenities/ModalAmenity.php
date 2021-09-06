<?php

namespace App\Http\Livewire\Admin\Amenities;

use App\Http\Requests\RequestAmenity;
use App\Models\Amenity;
use Livewire\Component;

class ModalAmenity extends Component
{
    public $showModal = 'hidden';
    public $name = '';
    public $amenity;
    public $action = '';
    public $method = '';

    protected $listeners = [
        'showModal', 'showModalNewAmenity',
    ];

    public function render()
    {
        return view('livewire.admin.amenities.modal-amenity');
    }

    public function showModal(Amenity $amenity)
    {
        //can('user update');
        $this->resetErrorBag();
        $this->resetValidation();

        $this->amenity = $amenity;
        $this->name = $amenity->name;
        $this->action = 'Update';
        $this->method = 'updateAmenity';

        $this->showModal = '';
    
    }

    public function closeModal()
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();
    }

    //Update Amenity
    public function updateAmenity(){

        $requestAmenity = new RequestAmenity();

        $values = $this->validate($requestAmenity->rules($this->amenity));

        $this->amenity->update([
            'name' => $values['name'],
        ]);

        $this->dispatchBrowserEvent('swal:modal', [
            'type' =>'success',
            'title' => 'Amenity update successfully',
            'text' => '',
        ]);

        $this->emit('amenityListUpdated');
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();
    }

    //Validaciones en tiempo real
    public function updated($label){

        $requestAmenity = new RequestAmenity();

        $this->validateOnly($label, $requestAmenity->rules($this->amenity));

    }

    public function showModalNewAmenity(){
        //can('user create');

        $this->resetErrorBag();
        $this->resetValidation();

        $this->amenity = null;
        $this->action = 'Create';
        $this->method = 'createAmenity';
        $this->showModal = '';

    }

    //Create Amenity
    public function createAmenity(){

        $requestAmenity = new RequestAmenity();

        $values = $this->validate($requestAmenity->rules(''));

        $amenity = new Amenity();
        $amenity->fill($values);
        $amenity->save();

        $this->dispatchBrowserEvent('swal:modal', [
            'type' =>'success',
            'title' => 'Amenity added successfully',
            'text' => '',
        ]);

        $this->emit('amenityListUpdated');

        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();

        $this->closeModal();
    }
}
