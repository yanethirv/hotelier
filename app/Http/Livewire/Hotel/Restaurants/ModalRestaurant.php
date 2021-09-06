<?php

namespace App\Http\Livewire\Hotel\Restaurants;

use App\Http\Requests\RequestRestaurant;
use App\Http\Requests\RequestRestaurantType;
use App\Models\Property;
use App\Models\Restaurant;
use App\Models\RestaurantLocation;
use App\Models\RestaurantTheme;
use App\Models\RestaurantType;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ModalRestaurant extends Component
{
    public $showModal = 'hidden';
    public $name = '';
    public $property_id = '';
    public $restaurant_theme_id = '';
    public $restaurant_type_id = '';
    public $restaurant_location_id = '';
    public $how_many_pax = '';
    public $open_time = '';
    public $closing_time = '';
    public $included = '';
    public $properties = [];
    public $restaurantThemes = [];
    public $restaurantTypes = [];
    public $restaurantLocations = [];
    public $restaurant;
    public $action = '';
    public $method = '';

    protected $listeners = ['showModal', 'showModalNewRestaurant'];

    public function hydrate(){

        $this->properties = Property::where('user_id', auth()->user()->id)->pluck('name', 'id')->toArray();
        $this->restaurantThemes = RestaurantTheme::pluck('name', 'id')->toArray();
        $this->restaurantTypes = RestaurantType::pluck('name', 'id')->toArray();
        $this->restaurantLocations = RestaurantLocation::pluck('name', 'id')->toArray();

    }

    public function render()
    {
        return view('livewire.hotel.restaurants.modal-restaurant');
    }

    public function showModal(Restaurant $restaurant){

        //can('user update');
        $this->resetErrorBag();
        $this->resetValidation();
        $this->restaurant = $restaurant;
        $this->name = $restaurant->name;
        $this->property_id = $restaurant->property()->first()->id ?? '';
        $this->restaurant_theme_id = $restaurant->restaurantTheme()->first()->id ?? '';
        $this->restaurant_type_id = $restaurant->restaurantType()->first()->id ?? '';
        $this->restaurant_location_id = $restaurant->restaurantLocation()->first()->id ?? '';
        $this->how_many_pax = $restaurant->how_many_pax;
        $this->open_time = $restaurant->open_time;
        $this->closing_time = $restaurant->closing_time;
        $this->included = $restaurant->included;
        $this->action = 'Update';
        $this->method = 'updateRestaurant';
        $this->showModal = '';
    
    }

    public function closeModal()
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();
    }

    //Update Restaurant
    public function updateRestaurant(){

        $requestRestaurant= new RequestRestaurant();
        $values = $this->validate($requestRestaurant->rules($this->restaurant));

        DB::beginTransaction();

        try {

            $this->restaurant->update([
                'name' => $values['name'],
                'property_id' => $values['property_id'],
                'restaurant_theme_id' => $values['restaurant_theme_id'],
                'restaurant_type_id' => $values['restaurant_type_id'],
                'restaurant_location_id' => $values['restaurant_location_id'],
                'how_many_pax' => $values['how_many_pax'],
                'open_time' => $values['open_time'],
                'closing_time' => $values['closing_time'],
                'included' => $values['included']
            ]);

            $this->dispatchBrowserEvent('swal:modal', [
                'type' =>'success',
                'title' => 'Restaurant update successfully',
                'text' => '',
            ]);

            DB::commit();

        } catch (\Exception $e) {

            $this->dispatchBrowserEvent('swal:modal', [
                'type' =>'warning',
                'title' => 'Restaurant error',
                'text' => '',
            ]);
            
            DB::rollBack();
        }

        $this->emit('restaurantListUpdated');
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();
    }

    //Validaciones en tiempo real
    public function updated($label){

        $requestRestaurant = new RequestRestaurant();
        $this->validateOnly($label, $requestRestaurant->rules($this->restaurant));

    }

    public function showModalNewRestaurant(){
        //can('user create');

        $this->resetErrorBag();
        $this->resetValidation();
        $this->restaurant = null;
        $this->action = 'Create';
        $this->method = 'createRestaurant';
        $this->showModal = '';

    }

    public function createRestaurant(){

        $requestRestaurant = new RequestRestaurant();
        $values = $this->validate($requestRestaurant->rules(''));

        DB::beginTransaction();
            
        try {

            $restaurant = new Restaurant();
            $restaurant->fill($values);
            $restaurant->save();

            $this->dispatchBrowserEvent('swal:modal', [
                'type' =>'success',
                'title' => 'Restaurant added successfully',
                'text' => '',
            ]);

            DB::commit();

        } catch (\Exception $e) {

            $this->dispatchBrowserEvent('swal:modal', [
                'type' =>'warning',
                'title' => 'Restaurant error',
                'text' => '',
                ]);

            DB::rollBack();
        }

        $this->emit('restaurantListUpdated');
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();
        $this->closeModal();
    }

}
