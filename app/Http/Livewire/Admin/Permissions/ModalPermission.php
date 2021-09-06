<?php

namespace App\Http\Livewire\Admin\Permissions;

use App\Http\Requests\RequestPermission;
use Livewire\Component;
use Spatie\Permission\Models\Permission;

class ModalPermission extends Component
{
    public $permission;
    public $showModal = false;
    public $target;
    public $action;
    public $actionTarget;

    protected $listeners = [
        'toggleModalPermission'
    ];

    public function render()
    {
        return view('livewire.admin.permissions.modal-permission');
    }

    public function toggleModalPermission($model_id = null, $model = null){

        $this->resetErrorBag();
        $this->resetValidation();
        $this->permission = '';

        if ($model_id && $model) {
            $this->target = $model == 'Permission' ? Permission::find($model_id) : '';
            $this->permission = $this->target->name;
            $this->action = 'Update';
            $this->actionTarget = 'updateTarget';
        }else{
            $this->action = 'Create';
            $this->actionTarget = 'createTarget';
        }
        
        $this->showModal = $this->showModal ? false : true;
    }

    public function updateTarget(){

        $request = new RequestPermission();

        $values = $this->validate($request->rules($this->permission), $request->messages());

        $this->target->update([
            'name' => $values['permission'],
        ]);

        $this->dispatchBrowserEvent('swal:modal', [
            'type' =>'success',
            'title' => 'Permission update successfully',
            'text' => '',
        ]);

        $this->reset();
        $this->emit('updateListPermissions');
    }

    //Validaciones en tiempo real
    public function updated($label){

        $requestType = new RequestPermission();
        $this->validateOnly($label, $requestType->rules($this->permission));

    }

    public function createTarget(){

        $request = new RequestPermission();
        $values = $this->validate($request->rules(''));

        Permission::create(['guard_name' => 'web', 'name' => $values['permission']]);

        $this->dispatchBrowserEvent('swal:modal', [
            'type' =>'success',
            'title' => 'Permission add successfully',
            'text' => '',
        ]);

        $this->reset();
        $this->emit('updateListPermissions');
    }
}
