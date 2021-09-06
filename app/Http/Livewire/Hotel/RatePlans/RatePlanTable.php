<?php

namespace App\Http\Livewire\Hotel\RatePlans;

use App\Models\Property;
use App\Models\RatePlan;
use Livewire\Component;
use Livewire\WithPagination;

class RatePlanTable extends Component
{
    use WithPagination;

    public $showModal = 'hidden';
    public $sortBy = "id";
    public $sortDirection = 'asc';
    public $perPage = 10;
    public $search = '';

    protected $listeners = [
        'ratePlanListUpdated' => 'render', 'deleteRatePlan' => 'deleteRatePlan',
    ];

    public function render()
    {
        $properties = Property::where('user_id', auth()->user()->id)->pluck('id')->toArray();

        $callback = function ($q) {
            $q->where('name', 'like', "%{$this->search}%");
        };

        $name = $this->search;

        $suggestion = $this->search;
        
        $ratePlans = RatePlan::where(function ($query) use ($properties) {
                        $query->whereIn('property_id',$properties);
                    })
                    ->where(function ($query) use ($callback, $name, $suggestion) {
                        $query->whereHas('property', $callback)
                            ->orWhere('name', 'like', "%{$name}%")
                            ->orWhere('suggestion', 'like', "%{$suggestion}%");
                    })
                    ->orderBy($this->sortBy, $this->sortDirection)
                    ->paginate($this->perPage);

        return view('livewire.hotel.rate-plans.rate-plan-table', compact('ratePlans'));
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

    public function showModal(RatePlan $ratePlan){
        //Emitimos al modal edit resource
        if($ratePlan->name) {
            //can('user update');
            $this->emit('showModal', $ratePlan);
        } else {
            //can('user create');
            $this->emit('showModalNewRatePlan');
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

    public function deleteRatePlan(RatePlan $ratePlan){

        try {

            $ratePlan->delete();

            $this->render();

        } catch (\Exception $e) {

            $this->dispatchBrowserEvent('swal:modal', [
                'type' =>'warning',
                'title' => 'Rate Plan error',
                'text' => '',
                ]);

        }
    }
}
