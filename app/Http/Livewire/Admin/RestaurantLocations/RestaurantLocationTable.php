<?php

namespace App\Http\Livewire\Admin\RestaurantLocations;

use App\Models\RestaurantLocation;
use Livewire\Component;
use Livewire\WithPagination;

class RestaurantLocationTable extends Component
{
    use WithPagination;

    public $showModal = 'hidden';

    public $sortBy = "id";

    public $sortDirection = 'asc';

    public $perPage = 10;

    public $search = '';

    protected $listeners = [
        'restaurantLocationListUpdated' => 'render',
        'deleteRestaurantLocation' => 'deleteRestaurantLocation',
    ];

    public function render()
    {
        $restaurantLocations = RestaurantLocation::query()
            ->search($this->search)
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate($this->perPage);

        return view('livewire.admin.restaurant-locations.restaurant-location-table', compact('restaurantLocations'));
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

    public function showModal(RestaurantLocation $restaurantLocation){
        //Emitimos al modal edit resource
        if($restaurantLocation->name) {
            //can('user update');
            $this->emit('showModal', $restaurantLocation);
        } else {
            //can('user create');
            $this->emit('showModalNewRestaurantLocation');
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

    public function deleteRestaurantLocation(RestaurantLocation $restaurantLocation){
        
        try {

            $restaurantLocation->delete();

            $this->render();

        } catch (\Exception $e) {

            $this->dispatchBrowserEvent('swal:modal', [
                'type' =>'warning',
                'title' => 'Location error',
                'text' => '',
                ]);
        }
    }
}
