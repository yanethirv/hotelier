<?php

namespace App\Http\Livewire\Admin\RestaurantThemes;

use App\Http\Requests\RequestRestaurantTheme;
use App\Models\RestaurantTheme;
use Livewire\Component;

class ModalRestaurantTheme extends Component
{
    public $showModal = 'hidden';
    public $name = '';
    public $description = '';
    public $restaurantTheme;
    public $action = '';
    public $method = '';

    protected $listeners = [
        'showModal', 'showModalNewRestaurantTheme',
    ];

    public function render()
    {
        return view('livewire.admin.restaurant-themes.modal-restaurant-theme');
    }

    public function showModal(RestaurantTheme $restaurantTheme)
    {
        //can('user update');
        $this->resetErrorBag();
        $this->resetValidation();

        $this->restaurantTheme = $restaurantTheme;
        $this->name = $restaurantTheme->name;
        $this->description = $restaurantTheme->description;
        $this->action = 'Update';
        $this->method = 'updateRestaurantTheme';

        $this->showModal = '';
    
    }

    public function closeModal()
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();
    }

    //Update RestaurantTheme
    public function updateRestaurantTheme(){

        $requestRestaurantTheme = new RequestRestaurantTheme();

        $values = $this->validate($requestRestaurantTheme->rules($this->restaurantTheme));

        $this->restaurantTheme->update([
            'name' => $values['name'],
            'description' => $values['description'],
        ]);

        $this->dispatchBrowserEvent('swal:modal', [
            'type' =>'success',
            'title' => 'Restaurant Theme update successfully',
            'text' => '',
        ]);

        $this->emit('restaurantThemeListUpdated');

        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();
    }

    //Validaciones en tiempo real
    public function updated($label){

        $requestRestaurantTheme = new RequestRestaurantTheme();

        $this->validateOnly($label, $requestRestaurantTheme->rules($this->restaurantTheme));

    }

    public function showModalNewRestaurantTheme(){
        can('user create');

        $this->resetErrorBag();
        $this->resetValidation();

        $this->restaurantTheme = null;
        $this->action = 'Create';
        $this->method = 'createRestaurantTheme';

        $this->showModal = '';

    }

    //Create RestaurantTheme
    public function createRestaurantTheme(){

        $requestRestaurantTheme = new RequestRestaurantTheme();

        $values = $this->validate($requestRestaurantTheme->rules(''));

        $restaurantTheme = new RestaurantTheme();

        $restaurantTheme->fill($values);

        $restaurantTheme->save();

        $this->dispatchBrowserEvent('swal:modal', [
            'type' =>'success',
            'title' => 'Restaurant Theme added successfully',
            'text' => '',
        ]);

        $this->emit('restaurantThemeListUpdated');

        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();

        $this->closeModal();
    }
}
