<?php

namespace App\Http\Livewire\Hotel\MealPlans;

use App\Models\MealPlan;
use App\Models\Property;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class MealPlanTable extends Component
{
    use WithPagination;

    public $showModal = 'hidden';
    public $sortBy = "id";
    public $sortDirection = 'asc';
    public $perPage = 10;
    public $search = '';

    protected $listeners = [
        'mealPlanListUpdated' => 'render','deleteMealPlan' => 'deleteMealPlan'
    ];

    public function render()
    {
        $properties = Property::where('user_id', auth()->user()->id)->pluck('id')->toArray();

        $callback = function ($q) {
            $q->where('name', 'like', "%{$this->search}%");
        };

        $name = $this->search;

        $rate = $this->search;
        
        $mealPlans = MealPlan::where(function ($query) use ($properties) {
                        $query->whereIn('property_id',$properties);
                    })
                    ->where(function ($query) use ($callback, $name, $rate) {
                        $query->whereHas('property', $callback)
                            ->orWhere('name', 'like', "%{$name}%")
                            ->orWhere('rate', 'like', "%{$rate}%");
                    })
                    ->orderBy($this->sortBy, $this->sortDirection)
                    ->paginate($this->perPage);

        return view('livewire.hotel.meal-plans.meal-plan-table', compact('mealPlans'));
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

    public function showModal(MealPlan $mealPlan){
        //Emitimos al modal edit resource
        if($mealPlan->name) {
            //can('user update');
            $this->emit('showModal', $mealPlan);
        } else {
            //can('user create');
            $this->emit('showModalNewMealPlan');
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

    public function deleteMealPlan(MealPlan $mealPlan){

        DB::beginTransaction();

        try {

            $mealPlan->delete();

            DB::commit();

        } catch (\Exception $e) {

            $this->dispatchBrowserEvent('swal:modal', [
                'type' =>'warning',
                'title' => 'Meal Plan error',
                'text' => '',
                ]);

            DB::rollBack();

        }

        $this->render();
    }
}

