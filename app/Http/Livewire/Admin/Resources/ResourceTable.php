<?php

namespace App\Http\Livewire\Admin\Resources;

use App\Models\Resource;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;

class ResourceTable extends Component
{
    use WithPagination;

    use WithFileUploads;

    public $showModal = 'hidden';
    public $sortBy = "id";
    public $sortDirection = 'asc';
    public $perPage = 10;
    public $search = '';

    protected $listeners = [
        'resourceListUpdated' => 'render',
        'deleteResource' => 'deleteResource',
    ];

    public function render()
    {
        $resources = Resource::query()
            ->search($this->search)
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate($this->perPage);

        return view('livewire.admin.resources.resource-table', compact('resources'));
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

    public function showModal(Resource $resource){
        //Emitimos al modal edit resource
        if($resource->title) {
            can('user update');
            $this->emit('showModal', $resource);
        } else {
            can('user create');
            $this->emit('showModalNewResource');
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

    public function deleteResource(Resource $resource){
        
        DB::beginTransaction();

        try {

            $this->emit('removeFile', $resource->attachment);

            $resource->delete();

            DB::commit();

        } catch (\Exception $e) {

            $this->dispatchBrowserEvent('swal:modal', [
                'type' =>'warning',
                'title' => 'Resource error',
                'text' => '',
                ]);

            DB::rollBack();

        }

        $this->render();

    }

}
