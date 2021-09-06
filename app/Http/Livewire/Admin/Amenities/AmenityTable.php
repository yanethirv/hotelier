<?php

namespace App\Http\Livewire\Admin\Amenities;

use App\Models\Amenity;
use Livewire\Component;
use Livewire\WithPagination;

class AmenityTable extends Component
{
    use WithPagination;

    public $showModal = 'hidden';
    public $sortBy = "id";
    public $sortDirection = 'asc';
    public $perPage = 10;
    public $search = '';

    protected $listeners = [
        'amenityListUpdated' => 'render', 'deleteAmenity' => 'deleteAmenity',
    ];

    public function render()
    {
        $amenities = Amenity::query()
            ->search($this->search)
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate($this->perPage);
            
        return view('livewire.admin.amenities.amenity-table', compact('amenities'));
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

    public function showModal(Amenity $amenity){
        //Emitimos al modal edit resource
        if($amenity->name) {
            //can('user update');
            $this->emit('showModal', $amenity);
        } else {
            //can('user create');
            $this->emit('showModalNewAmenity');
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

    public function deleteAmenity(Amenity $amenity){

        try {

            $amenity->delete();

            $this->render();

        } catch (\Exception $e) {

            $this->dispatchBrowserEvent('swal:modal', [
                'type' =>'warning',
                'title' => 'Amenity error',
                'text' => '',
                ]);
        }
    }
}
