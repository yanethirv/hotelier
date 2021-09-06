<?php

namespace App\Http\Livewire\Admin\Roles;

use App\Models\User;
use Livewire\Component;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Livewire\WithPagination;

class RoleTable extends Component
{
    use WithPagination;

    public $sortBy = "id";
    public $sortDirection = 'asc';
    public $perPage = 10;
    public $search = '';

    protected $listeners = [
        'updateListRoles' => 'render','deleteRole' => 'deleteRole',
    ];

    public function render()
    {
        $roles = Role::query()
            ->where('name','like','%'.$this->search.'%')
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate($this->perPage);

        //ROLES
        $roles = $roles->each(function($role){
            $role->count_user = User::role($role->name)->count();
        });

        //PERMISSIONS
        $permissions = Permission::all();
        $permissions = $permissions->each(function($p){
            $p->count_user = User::permission($p->name)->count();
        });

        return view('livewire.admin.roles.role-table', compact('roles', 'permissions'));
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

    public function deletePermission(Permission $permission){
        
        $permission->delete();

        $this->render();

    }

    public function deleteConfirm($id){

        $this->dispatchBrowserEvent('swal:confirm', [
            'type' =>'warning',
            'title' => 'Are you sure?',
            'text' => '',
            'id' => $id,
        ]);
    }

    public function deleteRole(Role $rol){
        
        try {

            $rol->delete();

            $this->render();

        } catch (\Exception $e) {

            $this->dispatchBrowserEvent('swal:modal', [
                'type' =>'warning',
                'title' => 'Role error',
                'text' => '',
                ]);
        }
    }
}
