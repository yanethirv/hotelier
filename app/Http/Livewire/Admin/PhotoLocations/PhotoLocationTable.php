<?php

namespace App\Http\Livewire\Admin\PhotoLocations;

use App\Models\PhotoLocation;
use Livewire\Component;
use Livewire\WithPagination;

class PhotoLocationTable extends Component
{
    use WithPagination;

    public $showModal = 'hidden';
    public $sortBy = "id";
    public $sortDirection = 'asc';
    public $perPage = 10;
    public $search = '';

    protected $listeners = [
        'photoLocationListUpdated' => 'render', 'deletePhotoLocation' => 'deletePhotoLocation',
    ];

    public function render()
    {
        $photoLocations = PhotoLocation::query()
            ->search($this->search)
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate($this->perPage);

        return view('livewire.admin.photo-locations.photo-location-table', compact('photoLocations'));
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

    public function showModal(PhotoLocation $photoLocation){
        //Emitimos al modal edit resource
        if($photoLocation->name) {
            //can('user update');
            $this->emit('showModal', $photoLocation);
        } else {
            //can('user create');
            $this->emit('showModalNewPhotoLocation');
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

    public function deletePhotoLocation(PhotoLocation $photoLocation){

        try {

            $photoLocation->delete();

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
