<?php

namespace App\Http\Livewire\Admin\RestaurantLocations;

use App\Http\Requests\RequestRestaurantLocation;
use App\Models\RestaurantLocation;
use Livewire\Component;

class ModalRestaurantLocation extends Component
{
    public $showModal = 'hidden';
    public $name = '';
    public $description = '';
    public $restaurantLocation;
    public $action = '';
    public $method = '';

    protected $listeners = [
        'showModal', 'showModalNewRestaurantLocation',
    ];

    public function render()
    {
        return view('livewire.admin.restaurant-locations.modal-restaurant-location');
    }

    public function showModal(RestaurantLocation $restaurantLocation)
    {
        //can('user update');
        $this->resetErrorBag();
        $this->resetValidation();

        $this->restaurantLocation = $restaurantLocation;
        $this->name = $restaurantLocation->name;
        $this->description = $restaurantLocation->description;
        $this->action = 'Update';
        $this->method = 'updateRestaurantLocation';

        $this->showModal = '';
    
    }

    public function closeModal()
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();
    }

    //Update RestaurantLocation
    public function updateRestaurantLocation(){

        $requestRestaurantLocation = new RequestRestaurantLocation();

        $values = $this->validate($requestRestaurantLocation->rules($this->restaurantLocation));

        $this->restaurantLocation->update([
            'name' => $values['name'],
            'description' => $values['description'],
        ]);

        $this->dispatchBrowserEvent('swal:modal', [
            'type' =>'success',
            'title' => 'Restaurant Location update successfully',
            'text' => '',
        ]);

        $this->emit('restaurantLocationListUpdated');

        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();
    }

    //Validaciones en tiempo real
    public function updated($label){

        $requestRestaurantLocation = new RequestRestaurantLocation();

        $this->validateOnly($label, $requestRestaurantLocation->rules($this->restaurantLocation));

    }

    public function showModalNewRestaurantLocation(){
        can('user create');

        $this->resetErrorBag();
        $this->resetValidation();

        $this->restaurantLocation = null;
        $this->action = 'Create';
        $this->method = 'createRestaurantLocation';

        $this->showModal = '';

    }

    //Create RestaurantLocation
    public function createRestaurantLocation(){

        $requestRestaurantLocation = new RequestRestaurantLocation();

        $values = $this->validate($requestRestaurantLocation->rules(''));

        $restaurantLocation = new RestaurantLocation();

        $restaurantLocation->fill($values);

        $restaurantLocation->save();

        $this->dispatchBrowserEvent('swal:modal', [
            'type' =>'success',
            'title' => 'Restaurant Location added successfully',
            'text' => '',
        ]);

        $this->emit('restaurantLocationListUpdated');

        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();

        $this->closeModal();
    }
}
