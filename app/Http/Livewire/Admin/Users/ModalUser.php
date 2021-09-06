<?php

namespace App\Http\Livewire\Admin\Users;

use App\Http\Requests\RequestUpdateUser;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\TemporaryUploadedFile;
use Livewire\WithFileUploads;
use Spatie\Permission\Models\Role;
use Intervention\Image\ImageManager;

class ModalUser extends Component
{
    use WithFileUploads;

    public $showModal = 'hidden';
    public $name = '';
    public $email = '';
    public $role = '';
    public $roles = [];
    public $user = null;
    public $action = '';
    public $method = '';
    public $password = '';
    public $password_confirmation = '';
    public $profile_photo_path = null;
    public $iterator='';

    protected $listeners = [
        'showModal', 'showModalNewUser', 'delete', 'removeImage'
    ];

    public function hydrate(){
        $this->roles = Role::pluck('name', 'name')->toArray();
    }

    public function mount(){
        $this->iterator = rand();
    }

    public function render()
    {
        return view('livewire.admin.users.modal-user');
    }

    public function showModal(User $user)
    {
        can('user update');
        $this->resetErrorBag();
        $this->resetValidation();
        $this->user = $user;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->profile_photo_path = '';
        $this->role = $user->roles()->first()->name ?? '';
        $this->action = 'Update';
        $this->method = 'updateUser';
        $this->showModal = '';
        
    }

    public function closeModal(){
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();
    }

    public function updateUser(){

        $requestUser = new RequestUpdateUser();
        $values = $this->validate($requestUser->rules($this->user));

        if ($values['profile_photo_path'] === '') {


            $this->user->update([
                'name' => $values['name'],
                'email' => $values['email'],
                'profile_photo_path' => NULL,
            ]);

        } else {

            $this->removeImage($this->user->profile_photo_path);
            $filePath = $values['profile_photo_path']->store('img/avatars');
            $values['profile_photo_path'] = $filePath;
        
            $this->user->update([
                'name' => $values['name'],
                'email' => $values['email'],
                'profile_photo_path' =>$values['profile_photo_path'],
            ]);
            
        }

        $this->user->syncRoles([$values['role']]);

        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();
        $this->iterator = rand();

        $this->dispatchBrowserEvent('swal:modal', [
            'type' =>'success',
            'title' => 'User update successfully',
            'text' => '',
        ]);

        $this->emit('userListUpdated');
    }

    public function updated($label){

        $requestUser = new RequestUpdateUser();
        $this->validateOnly($label, $requestUser->rules($this->user));

    }

    public function showModalNewUser(){
        can('user create');

        $this->resetErrorBag();
        $this->resetValidation();
        $this->user = null;
        $this->action = 'Create';
        $this->method = 'createUser';
        $this->showModal = '';

    }

    //CREAR USUARIO
    public function createUser(){

        $requestUser = new RequestUpdateUser();
        $values = $this->validate($requestUser->rules($this->user));
        $user = new User;

        if ($values['profile_photo_path']) {

            $filePath = $values['profile_photo_path']->store('img/avatars');
            $values['profile_photo_path'] = $filePath;
        }

        $user->fill($values);
        $user->assignRole($values['role']);
        $user->password = bcrypt($values['password']);
        $user->save();

        $this->dispatchBrowserEvent('swal:modal', [
            'type' =>'success',
            'title' => 'User added successfully',
            'text' => '',
        ]);

        $this->emit('userListUpdated');

        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();
        $this->iterator = rand();
        $this->closeModal();
    }

    public function removeImage($profile_photo_path){
        if (!$profile_photo_path) {
            return;
        }

        if (Storage::disk('public')->exists($profile_photo_path)) {
            Storage::disk('public')->delete($profile_photo_path);
        }
    }
}
