<?php

namespace App\Http\Livewire\Hotel\MealPlans;

use App\Http\Requests\RequestMealPlan;
use App\Models\MealPlan;
use App\Models\Property;
use Livewire\Component;


class ModalMealPlan extends Component
{
    public $showModal = 'hidden';
    public $name = '';
    public $rate = '';
    public $property_id = '';
    public $mealPlan;
    public $properties = [];
    public $action = '';
    public $method = '';

    protected $listeners = [
        'showModal', 'showModalNewMealPlan',
    ];

    public function hydrate(){

        $this->properties = Property::where('user_id', auth()->user()->id)->pluck('name', 'id')->toArray();

    }

    public function render()
    {
        return view('livewire.hotel.meal-plans.modal-meal-plan');
    }

    public function showModal(MealPlan $mealPlan)
    {
        //can('user update');
        $this->resetErrorBag();
        $this->resetValidation();

        $this->mealPlan = $mealPlan;
        $this->name = $mealPlan->name;
        $this->rate = $mealPlan->rate;
        $this->property_id = $mealPlan->property()->first()->id ?? '';
        $this->action = 'Update';
        $this->method = 'updateMealPlan';

        $this->showModal = '';
    
    }

    public function closeModal()
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();
    }

    //Update MealPlan
    public function updateMealPlan(){

        $requestMealPlan = new RequestMealPlan();

        $values = $this->validate($requestMealPlan->rules($this->mealPlan));

        $this->mealPlan->update([
            'name' => $values['name'],
            'rate' => $values['rate'],
            'property_id' => $values['property_id'],
        ]);

        $this->dispatchBrowserEvent('swal:modal', [
            'type' =>'success',
            'title' => 'Meal Plan update successfully',
            'text' => '',
        ]);

        $this->emit('mealPlanListUpdated');
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();
    }

    //Validaciones en tiempo real
    public function updated($label){

        $requestMealPlan = new RequestMealPlan();

        $this->validateOnly($label, $requestMealPlan->rules($this->mealPlan));

    }

    public function showModalNewMealPlan(){
        //can('user create');

        $this->resetErrorBag();
        $this->resetValidation();

        $this->mealPlan = null;
        $this->action = 'Create';
        $this->method = 'createMealPlan';

        $this->showModal = '';

    }
    

    //Create MealPlan
    public function createMealPlan(){

        $requestMealPlan = new RequestMealPlan();

        $values = $this->validate($requestMealPlan->rules(''));

        $mealPlan = new MealPlan();
        $mealPlan->fill($values);
        $mealPlan->save();

        $this->dispatchBrowserEvent('swal:modal', [
            'type' =>'success',
            'title' => 'Meal Plan added successfully',
            'text' => '',
        ]);

        $this->emit('mealPlanListUpdated');

        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();

        $this->closeModal();
    }
}


