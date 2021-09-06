<?php

namespace App\Http\Livewire\Admin\ActivationServices;

use App\Models\ActivationService;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class ActivationServiceTable extends Component
{
    use WithPagination;

    public $showModal = 'hidden';
    public $sortBy = "id";
    public $sortDirection = 'asc';
    public $perPage = 10;
    public $search = '';

    protected $listeners = [
        'activationServiceListUpdated' => 'render',
        'deleteActivationService' => 'deleteActivationService',
    ];

    public function render()
    {
        $activationServices = ActivationService::query()
            ->search($this->search)
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate($this->perPage);

        return view('livewire.admin.activation-services.activation-service-table', compact('activationServices'));
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

    public function showModal(ActivationService $activationActivationService){
        //Emitimos al modal edit resource
        if($activationActivationService->name) {
            //can('user update');
            $this->emit('showModal', $activationActivationService);
        } else {
            //can('user create');
            $this->emit('showModalNewActivationService');
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

    public function deleteActivationService(ActivationService $activationService){

        DB::beginTransaction();

        try {

            $this->emit('removeFile', $activationService->attachment);

            $activationService->delete();

            DB::commit();

        } catch (\Exception $e) {

            $this->dispatchBrowserEvent('swal:modal', [
                'type' =>'warning',
                'title' => 'Activation Service error',
                'text' => '',
                ]);

            DB::rollBack();

        }

        $this->render();

    }
}
