<?php

namespace App\Http\Livewire\Admin\Types;

use App\Http\Requests\RequestType;
use App\Models\Type;
use Livewire\Component;

class ModalType extends Component
{
    public $showModal = 'hidden';
    public $name = '';
    public $type;
    public $action = '';
    public $method = '';

    protected $listeners = [
        'showModal', 'showModalNewType',
    ];

    public function render()
    {
        return view('livewire.admin.types.modal-type');
    }

    public function showModal(Type $type)
    {
        //can('user update');
        $this->resetErrorBag();
        $this->resetValidation();

        $this->type = $type;
        $this->name = $type->name;
        $this->action = 'Update';
        $this->method = 'updateType';

        $this->showModal = '';
    
    }

    public function closeModal()
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();
    }

    //Update Type
    public function updateType(){

        $requestType = new RequestType();
        $values = $this->validate($requestType->rules($this->type));

        $this->type->update([
            'name' => $values['name'],
        ]);

        $this->dispatchBrowserEvent('swal:modal', [
            'type' =>'success',
            'title' => 'Type update successfully',
            'text' => '',
        ]);

        $this->emit('typeListUpdated');
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();
    }

    //Validaciones en tiempo real
    public function updated($label){

        $requestType = new RequestType();
        $this->validateOnly($label, $requestType->rules($this->type));

    }

    public function showModalNewType(){
        //can('user create');

        $this->resetErrorBag();
        $this->resetValidation();
        $this->type = null;
        $this->action = 'Create';
        $this->method = 'createType';
        $this->showModal = '';

    }

    //Create Type
    public function createType(){

        $requestType = new RequestType();
        $values = $this->validate($requestType->rules(''));
        $type = new Type();
        $type->fill($values);
        $type->save();

        $this->dispatchBrowserEvent('swal:modal', [
            'type' =>'success',
            'title' => 'Type added successfully',
            'text' => '',
        ]);

        $this->emit('typeListUpdated');

        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();

        $this->closeModal();
    }
}
