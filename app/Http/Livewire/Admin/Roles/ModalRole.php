<?php

namespace App\Http\Livewire\Admin\Roles;

use App\Http\Requests\RequestRole;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class ModalRole extends Component
{
    public $role;
    public $showModal = false;
    public $target;
    public $action;
    public $actionTarget;

    protected $listeners = [
        'toggleModal',
    ];

    public function render()
    {
        return view('livewire.admin.roles.modal-role');
    }

    public function toggleModal($model_id = null, $model = null){

        $this->resetErrorBag();
        $this->resetValidation();
        $this->role = '';
        
        if ($model_id && $model) {
            $this->target = $model == 'Role' ? Role::find($model_id) : '';
            $this->role = $this->target->name;
            $this->action = 'Update';
            $this->actionTarget = 'updateTarget';
        }else{
            $this->action = 'Create';
            $this->actionTarget = 'createTarget';
        }
        
        $this->showModal = $this->showModal ? false : true;
    }


    public function updateTarget(){

        $request = new RequestRole();
        $values = $this->validate($request->rules($this->role), $request->messages());

        $this->target->update([
            'name' => $values['role'],
        ]);

        $this->dispatchBrowserEvent('swal:modal', [
            'type' =>'success',
            'title' => 'Role update successfully',
            'text' => '',
        ]);

        $this->reset();
        $this->emit('updateListRoles');
    }

    //Validaciones en tiempo real
    public function updated($label){

        $requestType = new RequestRole();
        $this->validateOnly($label, $requestType->rules($this->role));

    }

    public function createTarget(){

        $request = new RequestRole();
        $values = $this->validate($request->rules(''));

        Role::create(['guard_name' => 'web', 'name' => $values['role']]);

        $this->dispatchBrowserEvent('swal:modal', [
            'type' =>'success',
            'title' => 'Role added successfully',
            'text' => '',
        ]);

        $this->reset();
        $this->emit('updateListRoles');
    }
}
