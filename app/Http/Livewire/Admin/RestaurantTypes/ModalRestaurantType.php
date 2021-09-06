<?php

namespace App\Http\Livewire\Admin\RestaurantTypes;

use App\Http\Requests\RequestRestaurantType;
use App\Models\RestaurantType;
use Livewire\Component;

class ModalRestaurantType extends Component
{
    public $showModal = 'hidden';
    public $name = '';
    public $description = '';
    public $restaurantType;
    public $action = '';
    public $method = '';

    protected $listeners = [
        'showModal', 'showModalNewRestaurantType',
    ];

    public function render()
    {
        return view('livewire.admin.restaurant-types.modal-restaurant-type');
    }

    public function showModal(RestaurantType $restaurantType)
    {
        //can('user update');
        $this->resetErrorBag();
        $this->resetValidation();

        $this->restaurantType = $restaurantType;
        $this->name = $restaurantType->name;
        $this->description = $restaurantType->description;
        $this->action = 'Update';
        $this->method = 'updateRestaurantType';

        $this->showModal = '';
    
    }

    public function closeModal()
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();
    }

    //Update RestaurantType
    public function updateRestaurantType(){

        $requestRestaurantType = new RequestRestaurantType();
        $values = $this->validate($requestRestaurantType->rules($this->restaurantType));

        $this->restaurantType->update([
            'name' => $values['name'],
            'description' => $values['description'],
        ]);

        $this->dispatchBrowserEvent('swal:modal', [
            'type' =>'success',
            'title' => 'Restaurant Type update successfully',
            'text' => '',
        ]);

        $this->emit('restaurantTypeListUpdated');
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();
    }

    //Validaciones en tiempo real
    public function updated($label){

        $requestRestaurantType = new RequestRestaurantType();
        $this->validateOnly($label, $requestRestaurantType->rules($this->restaurantType));

    }

    public function showModalNewRestaurantType(){
        //can('user create');
        $this->resetErrorBag();
        $this->resetValidation();
        $this->restaurantType = null;
        $this->action = 'Create';
        $this->method = 'createRestaurantType';
        $this->showModal = '';

    }

    //Create RestaurantType
    public function createRestaurantType(){

        $requestRestaurantType = new RequestRestaurantType();
        $values = $this->validate($requestRestaurantType->rules(''));

        $restaurantType = new RestaurantType();
        $restaurantType->fill($values);
        $restaurantType->save();

        $this->dispatchBrowserEvent('swal:modal', [
            'type' =>'success',
            'title' => 'Restaurant Type added successfully',
            'text' => '',
        ]);

        $this->emit('restaurantTypeListUpdated');
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();
        $this->closeModal();
    }
}
