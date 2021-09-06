<?php

namespace App\Http\Livewire\Admin\ActivationServices;

use App\Http\Requests\RequestActivationService;
use App\Models\ActivationService;
use App\Models\Type;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class ModalActivationService extends Component
{
    use WithFileUploads;

    public $showModal = 'hidden';
    public $name = '';
    public $description = '';
    public $type_id = '';
    public $attachment;
    public $types = [];
    public $activationService;
    public $action = '';
    public $method = '';
    public $iterator='';

    protected $listeners = ['showModal', 'showModalNewActivationService', 'removeFile'];

    public function mount(){

        $this->iterator = rand();

    }

    public function hydrate(){

        $this->types = Type::pluck('name', 'id')->toArray();

    }

    public function render(){

        return view('livewire.admin.activation-services.modal-activation-service');

    }

    public function showModal(ActivationService $activationService){

        //can('user update');
        $this->resetErrorBag();
        $this->resetValidation();
        $this->activationService = $activationService;
        $this->name = $activationService->name;
        $this->description = $activationService->description;
        $this->type_id = $activationService->type()->first()->id ?? '';
        $this->attachment = $activationService->attachment;
        $this->action = 'Update';
        $this->method = 'updateActivationService';
        $this->showModal = '';
    
    }

    public function closeModal()
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();
    }

    //Update ActivationService
    public function updateActivationService(){

        $requestActivationService = new RequestActivationService();
        $values = $this->validate($requestActivationService->rules($this->activationService));

        try {

            if (!$values['attachment']) {

                $this->activationService->update([
                    'name' => $values['name'],
                    'description' => $values['description'],
                    'type_id' => $values['type_id'],
                ]);

            } else {

                $this->removeFile($this->activationService->attachment);
                $filePath = $values['attachment']->store('files/activation-services');
                $values['attachment'] = $filePath;

                $this->activationService->update([
                    'name' => $values['name'],
                    'description' => $values['description'],
                    'type_id' => $values['type_id'],
                    'attachment' => $values['attachment'],
                ]);
            }
            
            $this->dispatchBrowserEvent('swal:modal', [
                'type' =>'success',
                'title' => 'Activation Service update successfully',
                'text' => '',
            ]);

        } catch (\Exception $e) {

            $this->dispatchBrowserEvent('swal:modal', [
                'type' =>'warning',
                'title' => 'Activation Service error',
                'text' => '',
                ]);
        }

        $this->emit('activationServiceListUpdated');
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();
        $this->iterator = rand();
    }

    //Validaciones en tiempo real
    public function updated($label){

        $requestActivationService = new RequestActivationService();
        $this->validateOnly($label, $requestActivationService->rules($this->activationService));

    }

    public function showModalNewActivationService(){
        //can('user create');

        $this->resetErrorBag();
        $this->resetValidation();
        $this->activationService = null;
        $this->action = 'Create';
        $this->method = 'createActivationService';
        $this->showModal = '';

    }
    
    //Create ActivationService
    public function createActivationService(){

        $requestActivationService = new RequestActivationService();
        $values = $this->validate($requestActivationService->rules(''));

        try {

            if ($values['attachment']) {

                $filePath = $values['attachment']->store('files/activation-services');
                $values['attachment'] = $filePath;

            }

            $activationService = new activationService;
            $activationService->fill($values);
            $activationService->save();
            
            $this->dispatchBrowserEvent('swal:modal', [
            'type' =>'success',
            'title' => 'Activation Service added successfully',
            'text' => '',
            ]);

        } catch (\Exception $e) {

            $this->dispatchBrowserEvent('swal:modal', [
                'type' =>'warning',
                'title' => 'Activation Service error',
                'text' => '',
                ]);
        }

        $this->emit('activationServiceListUpdated');
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();
        $this->closeModal();
    }

    //Remove Attachment
    public function removeFile($attachment){
        if (!$attachment) {
            return;
        }

        if (Storage::disk('public')->exists($attachment)) {
            Storage::disk('public')->delete($attachment);
        }
    }

}

