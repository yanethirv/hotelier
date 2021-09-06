<?php

namespace App\Http\Livewire\Hotel\Restaurants;

use App\Models\Property;
use App\Models\Restaurant;
use Livewire\Component;
use Livewire\WithPagination;

class RestaurantTable extends Component
{
    use WithPagination;

    public $showModal = 'hidden';
    public $sortBy = "id";
    public $sortDirection = 'asc';
    public $perPage = 10;
    public $search = '';

    protected $listeners = [
        'restaurantListUpdated' => 'render', 'deleteRestaurant' => 'deleteRestaurant',
    ];

    public function render()
    {
        $properties = Property::where('user_id', auth()->user()->id)->pluck('id')->toArray();

        $callback = function ($q) {
            $q->where('name', 'like', "%{$this->search}%");
        };

        $name = $this->search;
        
        $restaurants = Restaurant::where(function ($query) use ($properties) {
                        $query->whereIn('property_id',$properties);
                    })
                    ->where(function ($query) use ($callback, $name) {
                        $query->whereHas('property', $callback)
                            ->orWhereHas('restaurantTheme', $callback)
                            ->orWhereHas('restaurantType', $callback)
                            ->orWhereHas('restaurantLocation', $callback)
                            ->orWhere('name', 'like', "%{$name}%");
                    })
                    ->orderBy($this->sortBy, $this->sortDirection)
                    ->paginate($this->perPage);

        return view('livewire.hotel.restaurants.restaurant-table', compact('restaurants'));
    }

    public function sortBy($field){
        if($this->sortDirection == 'asc'){
            $this->sortDirection = 'desc';
        } else{
            $this->sortDirection = 'asc';
        }
        return $this->sortBy = $field;
    }

    public function updatingSearch(){
        $this->resetPage();
    }

    public function showModal(Restaurant $restaurant){

        //Emitimos al modal edit resource
        if($restaurant->property_id) {
            //can('user update');
            $this->emit('showModal', $restaurant);
        } else {
            //can('user create');
            $this->emit('showModalNewRestaurant');
        }
    }

    public function deleteConfirm($id){
        
        $this->dispatchBrowserEvent('swal:confirm', [
            'type' =>'warning',
            'title' => 'Are you sure?',
            'text' => '',
            'id' => $id,
        ]);
    }

    public function deleteRestaurant(Restaurant $restaurant){

        try {

            $restaurant->delete();

            $this->render();

        } catch (\Exception $e) {

            $this->dispatchBrowserEvent('swal:modal', [
                'type' =>'warning',
                'title' => 'Restaurant error',
                'text' => '',
                ]);

        }
        
    }
}
