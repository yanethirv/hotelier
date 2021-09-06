<?php

namespace App\Http\Livewire\Admin\Experiences;

use App\Http\Requests\RequestExperience;
use App\Models\Experience;
use Livewire\Component;


class ModalExperience extends Component
{

    public $showModal = 'hidden';
    public $name = '';
    public $description = '';
    public $experience;
    public $action = '';
    public $method = '';

    protected $listeners = [
        'showModal', 'showModalNewExperience',
    ];

    public function render()
    {
        return view('livewire.admin.experiences.modal-experience');
    }

    public function showModal(Experience $experience)
    {
        //can('user update');
        $this->resetErrorBag();
        $this->resetValidation();

        $this->experience = $experience;
        $this->name = $experience->name;
        $this->description = $experience->description;
        $this->action = 'Update';
        $this->method = 'updateExperience';

        $this->showModal = '';
    
    }

    public function closeModal()
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();
    }

    //Update Experience
    public function updateExperience(){

        $requestExperience = new RequestExperience();

        $values = $this->validate($requestExperience->rules($this->experience));

        $this->experience->update([
            'name' => $values['name'],
            'description' => $values['description'],
        ]);

        $this->dispatchBrowserEvent('swal:modal', [
            'type' =>'success',
            'title' => 'Experience update successfully',
            'text' => '',
        ]);

        $this->emit('experienceListUpdated');

        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();
    }

    //Validaciones en tiempo real
    public function updated($label){

        $requestExperience = new RequestExperience();

        $this->validateOnly($label, $requestExperience->rules($this->experience));

    }

    public function showModalNewExperience(){
        //can('user create');

        $this->resetErrorBag();
        $this->resetValidation();

        $this->experience = null;
        $this->action = 'Create';
        $this->method = 'createExperience';

        $this->showModal = '';

    }
    

    //Create Experience
    public function createExperience(){

        $requestExperience = new RequestExperience();

        $values = $this->validate($requestExperience->rules(''));

        $experience = new experience;
        $experience->fill($values);
        $experience->save();

        $this->dispatchBrowserEvent('swal:modal', [
            'type' =>'success',
            'title' => 'Experience added successfully',
            'text' => '',
        ]);

        $this->emit('experienceListUpdated');
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();
        $this->closeModal();
    }

}
