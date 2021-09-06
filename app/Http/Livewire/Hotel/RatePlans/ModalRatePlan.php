<?php

namespace App\Http\Livewire\Hotel\RatePlans;

use App\Http\Requests\RequestRatePlan;
use App\Models\Property;
use App\Models\RatePlan;
use Livewire\Component;

class ModalRatePlan extends Component
{
    public $showModal = 'hidden';
    public $name = '';
    public $suggestion = '';
    public $description = '';
    public $property_id = '';
    public $properties = [];
    public $ratePlan;
    public $action = '';
    public $method = '';

    protected $listeners = [
        'showModal', 'showModalNewRatePlan',
    ];

    public function hydrate(){

        $this->properties = Property::where('user_id', auth()->user()->id)->pluck('name', 'id')->toArray();

    }

    public function render()
    {
        return view('livewire.hotel.rate-plans.modal-rate-plan');
    }

    public function showModal(RatePlan $ratePlan)
    {
        //can('user update');
        $this->resetErrorBag();
        $this->resetValidation();

        $this->ratePlan = $ratePlan;
        $this->name = $ratePlan->name;
        $this->suggestion = $ratePlan->suggestion;
        $this->description = $ratePlan->description;
        $this->property_id = $ratePlan->property()->first()->id ?? '';
        $this->action = 'Update';
        $this->method = 'updateRatePlan';

        $this->showModal = '';
    
    }

    public function closeModal()
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();
    }

    //Update RatePlan
    public function updateRatePlan(){

        $requestRatePlan = new RequestRatePlan();

        $values = $this->validate($requestRatePlan->rules($this->ratePlan));

        $this->ratePlan->update([
            'name' => $values['name'],
            'suggestion' => $values['suggestion'],
            'description' => $values['description'],
            'property_id' => $values['property_id'],
        ]);

        $this->dispatchBrowserEvent('swal:modal', [
            'type' =>'success',
            'title' => 'Rate Plan update successfully',
            'text' => '',
        ]);

        $this->emit('ratePlanListUpdated');

        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();
    }

    //Validaciones en tiempo real
    public function updated($label){

        $requestRatePlan = new RequestRatePlan();

        $this->validateOnly($label, $requestRatePlan->rules($this->ratePlan));

    }

    public function showModalNewRatePlan(){
        //can('user create');

        $this->resetErrorBag();
        $this->resetValidation();

        $this->ratePlan = null;
        $this->action = 'Create';
        $this->method = 'createRatePlan';

        $this->showModal = '';

    }

    //Create RatePlan
    public function createRatePlan(){

        $requestRatePlan = new RequestRatePlan();

        $values = $this->validate($requestRatePlan->rules(''));

        $ratePlan = new RatePlan;
        $ratePlan->fill($values);
        $ratePlan->save();

        $this->dispatchBrowserEvent('swal:modal', [
            'type' =>'success',
            'title' => 'Rate Plan added successfully',
            'text' => '',
        ]);

        $this->emit('ratePlanListUpdated');
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();
        $this->closeModal();
    }
}
