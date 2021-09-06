<?php

namespace App\Http\Livewire\Admin\Roles;

use App\Models\User;
use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AddPermission extends Component
{
    public $showModal = 'hidden';
    public $action;
    public $model;
    public $permission_check = [];

    protected $listeners = [
        'addPermission'
    ];

    public function render()
    {
        return view('livewire.admin.roles.add-permission');
    }

    public function addPermission($model_id, $model = null){
        
        $permissions = Permission::all();

        if (!$model) {
        
            $rol = Role::find($model_id);

            $this->model = $rol;

            $havePermission = $rol->permissions()->get();

            foreach($permissions as $permission){
                if($havePermission->contains($permission)){
                    $this->permission_check[$permission->name]['check'] = true;
                } else {
                    $this->permission_check[$permission->name]['check'] = false;
                }
                $this->permission_check[$permission->name]['id'] = $permission->id;
            }
        } else {

            $user = User::find($model_id);

            $this->model = $user;

            $havePermission = $user->getPermissionsViaRoles();

            foreach ($permissions as $p){
                if ($user->hasPermissionTo($p)) {
                    $this->permission_check[$p->name]['check'] = true;
                } else {
                    $this->permission_check[$p->name]['check'] = false;
                }
                $this->permission_check[$p->name]['id'] = $p->id;
            }
            //dd($this->permission_check);
        }

        $this->showModal = '';

    }

    public function closeModal(){
        
        $this->showModal = 'hidden';

    }

    public function addPermissionCheck($permission){
        
        if(!$this->model->hasPermissionTo($permission)){
            $this->model->givePermissionTo($permission);
        } else{
            $this->model->revokePermissionTo($permission);
        }

        $this->emit('updateListRoles');

    }
}
