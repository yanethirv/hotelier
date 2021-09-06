<?php

namespace App\Http\Livewire\Admin\RestaurantThemes;

use App\Models\RestaurantTheme;
use Livewire\Component;
use Livewire\WithPagination;

class RestaurantThemeTable extends Component
{
    use WithPagination;

    public $showModal = 'hidden';
    public $sortBy = "id";
    public $sortDirection = 'asc';
    public $perPage = 10;
    public $search = '';

    protected $listeners = [
        'restaurantThemeListUpdated' => 'render',
        'deleteRestaurantTheme' => 'deleteRestaurantTheme',
    ];

    public function render()
    {
        $restaurantThemes = RestaurantTheme::query()
            ->search($this->search)
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate($this->perPage);

        return view('livewire.admin.restaurant-themes.restaurant-theme-table', compact('restaurantThemes'));
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

    public function showModal(RestaurantTheme $restaurantTheme){
        //Emitimos al modal edit resource
        if($restaurantTheme->name) {
            //can('user update');
            $this->emit('showModal', $restaurantTheme);
        } else {
            //can('user create');
            $this->emit('showModalNewRestaurantTheme');
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

    public function deleteRestaurantTheme(RestaurantTheme $restaurantTheme){

        try {

            $restaurantTheme->delete();

            $this->render();

        } catch (\Exception $e) {

            $this->dispatchBrowserEvent('swal:modal', [
                'type' =>'warning',
                'title' => 'Theme error',
                'text' => '',
                ]);
        }
    }
}
