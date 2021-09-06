<?php

namespace App\Http\Livewire\Admin\RestaurantTypes;

use App\Models\RestaurantType;
use Livewire\Component;
use Livewire\WithPagination;

class RestaurantTypeTable extends Component
{
    use WithPagination;

    public $showModal = 'hidden';
    public $sortBy = "id";
    public $sortDirection = 'asc';
    public $perPage = 10;
    public $search = '';

    protected $listeners = [
        'restaurantTypeListUpdated' => 'render',
        'deleteRestaurantType' => 'deleteRestaurantType',
    ];

    public function render()
    {
        $restaurantTypes = RestaurantType::query()
            ->search($this->search)
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate($this->perPage);

        return view('livewire.admin.restaurant-types.restaurant-type-table', compact('restaurantTypes'));
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

    public function showModal(RestaurantType $restaurantType){
        //Emitimos al modal edit resource
        if($restaurantType->name) {
            //can('user update');
            $this->emit('showModal', $restaurantType);
        } else {
            //can('user create');
            $this->emit('showModalNewRestaurantType');
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

    public function deleteRestaurantType(RestaurantType $restaurantType){

        try {

            $restaurantType->delete();

            $this->render();

        } catch (\Exception $e) {

            $this->dispatchBrowserEvent('swal:modal', [
                'type' =>'warning',
                'title' => 'Type error',
                'text' => '',
                ]);
        }
    }
}
