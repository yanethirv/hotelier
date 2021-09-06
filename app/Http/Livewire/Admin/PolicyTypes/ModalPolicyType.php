<?php

namespace App\Http\Livewire\Admin\PolicyTypes;

use App\Http\Requests\RequestPolicyType;
use App\Models\PolicyType;
use Livewire\Component;

class ModalPolicyType extends Component
{
    public $showModal = 'hidden';
    public $name = '';
    public $description = '';
    public $policyType;
    public $action = '';
    public $method = '';

    protected $listeners = [
        'showModal', 'showModalNewPolicyType',
    ];

    public function render()
    {
        return view('livewire.admin.policy-types.modal-policy-type');
    }

    public function showModal(PolicyType $policyType)
    {
        //can('user update');
        $this->resetErrorBag();
        $this->resetValidation();

        $this->policyType = $policyType;
        $this->name = $policyType->name;
        $this->description = $policyType->description;
        $this->action = 'Update';
        $this->method = 'updatePolicyType';

        $this->showModal = '';
    
    }

    public function closeModal()
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();
    }

    //Update PolicyType
    public function updatePolicyType(){

        $requestPolicyType = new RequestPolicyType();
        $values = $this->validate($requestPolicyType->rules($this->policyType));

        $this->policyType->update([
            'name' => $values['name'],
            'description' => $values['description'],
        ]);

        $this->dispatchBrowserEvent('swal:modal', [
            'type' =>'success',
            'title' => 'Policy Type update successfully',
            'text' => '',
        ]);

        $this->emit('policyTypeListUpdated');
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();
    }

    //Validaciones en tiempo real
    public function updated($label){

        $requestPolicyType = new RequestPolicyType();
        $this->validateOnly($label, $requestPolicyType->rules($this->policyType));

    }

    public function showModalNewPolicyType(){
        //can('user create');
        $this->resetErrorBag();
        $this->resetValidation();
        $this->policyType = null;
        $this->action = 'Create';
        $this->method = 'createPolicyType';
        $this->showModal = '';

    }

    //Create PolicyType
    public function createPolicyType(){

        $requestPolicyType = new RequestPolicyType();
        $values = $this->validate($requestPolicyType->rules(''));

        $policyType = new PolicyType();
        $policyType->fill($values);
        $policyType->save();

        $this->dispatchBrowserEvent('swal:modal', [
            'type' =>'success',
            'title' => 'Policy Type added successfully',
            'text' => '',
        ]);

        $this->emit('policyTypeListUpdated');
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();
        $this->closeModal();
    }
}