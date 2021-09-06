<?php

namespace App\Http\Livewire\Admin\Experiences;

use App\Models\Experience;
use Livewire\Component;
use Livewire\WithPagination;

class ExperienceTable extends Component
{
    use WithPagination;

    public $showModal = 'hidden';
    public $sortBy = "id";
    public $sortDirection = 'asc';
    public $perPage = 10;
    public $search = '';

    protected $listeners = [
        'experienceListUpdated' => 'render',
        'deleteExperience' => 'deleteExperience',
    ];

    public function render()
    {
        $experiences = Experience::query()
            ->search($this->search)
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate($this->perPage);

        return view('livewire.admin.experiences.experience-table', compact('experiences'));
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

    public function showModal(Experience $experience){
        //Emitimos al modal edit resource
        if($experience->name) {
            //can('user update');
            $this->emit('showModal', $experience);
        } else {
            //can('user create');
            $this->emit('showModalNewExperience');
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

    public function deleteExperience(Experience $experience){

        try {

            $experience->delete();

            $this->render();

        } catch (\Exception $e) {

            $this->dispatchBrowserEvent('swal:modal', [
                'type' =>'warning',
                'title' => 'Experience error',
                'text' => '',
                ]);
        }
    }
}
