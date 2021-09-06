<?php

namespace App\Http\Livewire\Admin\Occupancies;

use App\Models\Occupancy;
use Livewire\Component;
use Livewire\WithPagination;

class OccupancyTable extends Component
{
    use WithPagination;

    public $showModal = 'hidden';
    public $sortBy = "id";
    public $sortDirection = 'asc';
    public $perPage = 10;
    public $search = '';

    protected $listeners = [
        'occupancyListUpdated' => 'render',
        'deleteOccupancy' => 'deleteOccupancy',
    ];

    public function render()
    {
        $occupancies = Occupancy::query()
            ->search($this->search)
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate($this->perPage);

        return view('livewire.admin.occupancies.occupancy-table', compact('occupancies'));
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

    public function showModal(Occupancy $occupancy){
        //Emitimos al modal edit resource
        if($occupancy->name) {
            //can('user update');
            $this->emit('showModal', $occupancy);
        } else {
            //can('user create');
            $this->emit('showModalNewOccupancy');
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

    public function deleteOccupancy(Occupancy $occupancy){

        try {

            $occupancy->delete();

            $this->render();

        } catch (\Exception $e) {

            $this->dispatchBrowserEvent('swal:modal', [
                'type' =>'warning',
                'title' => 'Occupancy error',
                'text' => '',
                ]);
        }
        
    }
}
