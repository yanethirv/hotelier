<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class UserTable extends Component
{
    use WithPagination;
    
    public $sortBy = "id";
    public $sortDirection = 'asc';
    public $perPage = 10;
    public $search = '';
    public $user_role = '';
    public $showModal = 'hidden';
    public $roles = [];

    protected $listeners = [
        'userListUpdated' => 'render',
        'deleteUser' => 'deleteUser',
    ];
    
    
    public function hydrate(){
        $this->roles = Role::pluck('name', 'name')->toArray();
    }
    
    public function render()
    {
        $users = User::filter($this->search)
            ->orderBy($this->sortBy, $this->sortDirection)
            ->when($this->user_role != '', function($query){
                return $query->role($this->user_role);
            })
            ->paginate($this->perPage);

        return view('livewire.admin.users.user-table', compact('users'));

        $this->emit('fileUploaded');
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

    public function showModal(User $user){
        
        if($user->name) {
            can('user update');
            $this->emit('showModal', $user);
        } else {
            can('user create');
            $this->emit('showModalNewUser');
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

    public function deleteUser(User $user){

        //can('user delete');
        //$this->emit('deleteUser', $user);
        DB::beginTransaction();

        try {

            $this->emit('removeImage',$user->profile_photo_path);

            $user->delete();

            DB::commit();

        } catch (\Exception $e) {

            $this->dispatchBrowserEvent('swal:modal', [
                'type' =>'warning',
                'title' => 'User error',
                'text' => '',
                ]);

            DB::rollBack();

        }

        $this->render();

    }

    
}
