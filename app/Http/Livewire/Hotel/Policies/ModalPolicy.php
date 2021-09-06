<?php

namespace App\Http\Livewire\Hotel\Policies;

use App\Http\Requests\RequestPolicy;
use App\Models\Policy;
use App\Models\PolicyType;
use App\Models\Property;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ModalPolicy extends Component
{
    public $showModal = 'hidden';
    public $name = '';
    public $property_id = '';
    public $policy_type_id = '';
    public $properties = [];
    public $policyTypes = [];
    public $policy;
    public $action = '';
    public $method = '';

    protected $listeners = ['showModal', 'showModalNewPolicy'];

    public function hydrate(){

        $this->properties = Property::where('user_id', auth()->user()->id)->pluck('name', 'id')->toArray();
        $this->policyTypes = PolicyType::pluck('name', 'id')->toArray();

    }
    public function render()
    {
        return view('livewire.hotel.policies.modal-policy');
    }

    public function showModal(Policy $policy){

        //can('user update');
        $this->resetErrorBag();
        $this->resetValidation();
        $this->policy = $policy;
        $this->name = $policy->name;
        $this->property_id = $policy->property()->first()->id ?? '';
        $this->policy_type_id = $policy->policyType()->first()->id ?? '';
        $this->action = 'Update';
        $this->method = 'updatePolicy';
        $this->showModal = '';
    
    }

    public function closeModal()
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();
    }

    //Update Policy
    public function updatePolicy(){

        $requestPolicy= new RequestPolicy();
        $values = $this->validate($requestPolicy->rules($this->policy));

        DB::beginTransaction();

        try {

            $this->policy->update([
                'name' => $values['name'],
                'property_id' => $values['property_id'],
                'policy_type_id' => $values['policy_type_id']
            ]);

            $this->dispatchBrowserEvent('swal:modal', [
                'type' =>'success',
                'title' => 'Policy update successfully',
                'text' => '',
            ]);

            DB::commit();

        } catch (\Exception $e) {

            $this->dispatchBrowserEvent('swal:modal', [
                'type' =>'warning',
                'title' => 'Policy error',
                'text' => '',
            ]);
            
            DB::rollBack();
        }

        $this->emit('policyListUpdated');
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();
    }

    //Validaciones en tiempo real
    public function updated($label){

        $requestPolicy = new RequestPolicy();
        $this->validateOnly($label, $requestPolicy->rules($this->policy));

    }

    public function showModalNewPolicy(){
        //can('user create');

        $this->resetErrorBag();
        $this->resetValidation();
        $this->policy = null;
        $this->action = 'Create';
        $this->method = 'createPolicy';
        $this->showModal = '';

    }

    public function createPolicy(){

        $requestPolicy = new RequestPolicy();
        $values = $this->validate($requestPolicy->rules(''));

        DB::beginTransaction();
            
        try {

            $policy = new Policy();
            $policy->fill($values);
            $policy->save();

            $this->dispatchBrowserEvent('swal:modal', [
                'type' =>'success',
                'title' => 'Policy added successfully',
                'text' => '',
            ]);

            DB::commit();

        } catch (\Exception $e) {

            $this->dispatchBrowserEvent('swal:modal', [
                'type' =>'warning',
                'title' => 'Policy error',
                'text' => '',
                ]);

            DB::rollBack();
        }

        $this->emit('policyListUpdated');
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();
        $this->closeModal();
    }
}
