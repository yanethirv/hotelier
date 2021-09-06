<?php

namespace App\Http\Livewire\Admin\Occupancies;

use App\Http\Requests\RequestOccupancy;
use App\Models\Occupancy;
use Livewire\Component;

class ModalOccupancy extends Component
{
    public $showModal = 'hidden';
    public $name = '';
    public $description = '';
    public $occupancy;
    public $action = '';
    public $method = '';

    protected $listeners = [
        'showModal', 'showModalNewOccupancy',
    ];

    public function render()
    {
        return view('livewire.admin.occupancies.modal-occupancy');
    }

    public function showModal(Occupancy $occupancy)
    {
        //can('user update');
        $this->resetErrorBag();
        $this->resetValidation();

        $this->occupancy = $occupancy;
        $this->name = $occupancy->name;
        $this->description = $occupancy->description;
        $this->action = 'Update';
        $this->method = 'updateOccupancy';

        $this->showModal = '';
    
    }

    public function closeModal()
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();
    }

    //Update Occupancy
    public function updateOccupancy(){

        $requestOccupancy = new RequestOccupancy();

        $values = $this->validate($requestOccupancy->rules($this->occupancy));

        $this->occupancy->update([
            'name' => $values['name'],
            'description' => $values['description'],
        ]);

        $this->dispatchBrowserEvent('swal:modal', [
            'type' =>'success',
            'title' => 'Occupancy update successfully',
            'text' => '',
        ]);

        $this->emit('occupancyListUpdated');

        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();
    }

    //Validaciones en tiempo real
    public function updated($label){

        $requestOccupancy = new RequestOccupancy();

        $this->validateOnly($label, $requestOccupancy->rules($this->occupancy));

    }

    public function showModalNewOccupancy(){
        //can('user create');

        $this->resetErrorBag();
        $this->resetValidation();

        $this->occupancy = null;
        $this->action = 'Create';
        $this->method = 'createOccupancy';

        $this->showModal = '';

    }

    //Create Occupancy
    public function createOccupancy(){

        $requestOccupancy = new RequestOccupancy();

        $values = $this->validate($requestOccupancy->rules(''));

        $occupancy = new Occupancy;
        $occupancy->fill($values);
        $occupancy->save();

        $this->dispatchBrowserEvent('swal:modal', [
            'type' =>'success',
            'title' => 'Occupancy added successfully',
            'text' => '',
        ]);

        $this->emit('occupancyListUpdated');
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();
        $this->closeModal();
    }
}
