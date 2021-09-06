<?php

namespace App\Http\Livewire\Admin\Plans;

use App\Models\Plan;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class PlanTable extends Component
{
    use WithPagination;

    public $showModal = 'hidden';
    public $sortBy = "id";
    public $sortDirection = 'asc';
    public $perPage = 10;
    public $search = '';

    protected $listeners = ['planListUpdated' => 'render','deletePlan' => 'deletePlan'];

    public function render()
    {
        $plans = Plan::query()
            ->search($this->search)
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate($this->perPage);

        return view('livewire.admin.plans.plan-table', compact('plans'));
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

    public function showModal(Plan $plan){
        //Emitimos al modal edit resource
        if($plan->nickname) {
            //can('user update');
            $this->emit('showModal', $plan);
        } else {
            //can('user create');
            $this->emit('showModalNewPlan');
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


    public function deletePlan(Plan $plan){

        $stripe = new \Stripe\StripeClient(env("STRIPE_SECRET"));

        DB::beginTransaction();
            
        try {

            $stripe->prices->update(
                $plan->stripe_id,
                ['active' => false]
            );

            $plan->delete();

            DB::commit();

        } catch (\Exception $e) {

            $this->dispatchBrowserEvent('swal:modal', [
                'type' =>'warning',
                'title' => 'Plan error',
                'text' => '',
                ]);

            DB::rollBack();
        }

        $this->render();
    }
}
