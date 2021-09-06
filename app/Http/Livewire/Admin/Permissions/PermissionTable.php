<?php

namespace App\Http\Livewire\Admin\Permissions;

use App\Models\User;
use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Livewire\WithPagination;

class PermissionTable extends Component
{

    use WithPagination;

    public $sortBy = "id";

    public $sortDirection = 'asc';

    public $perPage = 100;

    public $search = '';


    protected $listeners = [
        'updateListPermissions' => 'render',
        'deletePermission' => 'deletePermission',
    ];

    public function render()
    {
        //$permissions = Permission::all();

        $permissions = Permission::query()
            ->where('name','like','%'.$this->search.'%')
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate($this->perPage);

        $permissions = $permissions->each(function($p){
            $p->count_user = User::permission($p->name)->count();
        });

    
        return view('livewire.admin.permissions.permission-table', compact('permissions'));
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

    public function deleteConfirm($id){

        $this->dispatchBrowserEvent('swal:confirm', [
            'type' =>'warning',
            'title' => 'Are you sure?',
            'text' => '',
            'id' => $id,
        ]);
    }

    public function deletePermission(Permission $permission){

        try {

            $permission->delete();

            $this->render();

        } catch (\Exception $e) {

            $this->dispatchBrowserEvent('swal:modal', [
                'type' =>'warning',
                'title' => 'Permission error',
                'text' => '',
                ]);
        }

    }
}
