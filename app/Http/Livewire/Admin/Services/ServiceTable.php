<?php

namespace App\Http\Livewire\Admin\Services;

use App\Models\Service;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class ServiceTable extends Component
{
    use WithPagination;

    public $showModal = 'hidden';

    public $sortBy = "id";

    public $sortDirection = 'asc';

    public $perPage = 10;

    public $search = '';

    protected $listeners = [
        'serviceListUpdated' => 'render',
        'deleteService' => 'deleteService',
    ];

    public function render()
    {
        $services = Service::query()
            ->search($this->search)
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate($this->perPage);

        return view('livewire.admin.services.service-table', compact('services'));
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

    public function showModal(Service $service){
        //Emitimos al modal edit resource
        if($service->name) {
            //can('user update');
            $this->emit('showModal', $service);
        } else {
            //can('user create');
            $this->emit('showModalNewService');
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

    public function deleteService(Service $service){

        DB::beginTransaction();

        try {

            $this->emit('removeFile', $service->attachment);

            $service->delete();

            DB::commit();

        } catch (\Exception $e) {

            $this->dispatchBrowserEvent('swal:modal', [
                'type' =>'warning',
                'title' => 'Service error',
                'text' => '',
                ]);

            DB::rollBack();

        }

        $this->render();
        
    }
}
