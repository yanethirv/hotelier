<?php

namespace App\Http\Livewire\Admin\Resources;

use App\Http\Requests\RequestResource;
use App\Models\Resource;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class ModalResource extends Component
{
    use WithFileUploads;

    public $showModal = 'hidden';
    public $title = '';
    public $description = '';
    public $resource;
    public $action = '';
    public $method = '';
    public $attachment = '';
    public $iterator='';

    protected $listeners = [
        'showModal', 'showModalNewResource',
        'removeFile'
    ];

    public function mount(){
        $this->iterator = rand();
    }

    public function render()
    {
        return view('livewire.admin.resources.modal-resource');
    }

    public function showModal(Resource $resource)
    {
        //can('user update');
        $this->resetErrorBag();
        $this->resetValidation();
        $this->resource = $resource;
        $this->title = $resource->title;
        $this->description = $resource->description;
        $this->attachment = '';
        $this->action = 'Update';
        $this->method = 'updateResource';
        $this->showModal = '';
    
    }

    public function closeModal()
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();
    }

    //Update Resource
    public function updateResource(){

        $requestResource = new RequestResource();
        $values = $this->validate($requestResource->rules());

        if ($values['attachment'] == '') {

            $this->resource->update([
                'title' => $values['title'],
                'description' => $values['description'],
            ]);

        } else {

            $this->removeFile($this->resource->attachment);

            $filePath = $values['attachment']->store('files/resources');

            $values['attachment'] = $filePath;

            $this->resource->update([
                'title' => $values['title'],
                'description' => $values['description'],
                'attachment' =>$values['attachment'] ,
            ]);
            
        }

        $this->dispatchBrowserEvent('swal:modal', [
            'type' =>'success',
            'title' => 'Resource update successfully',
            'text' => '',
        ]);

        $this->emit('resourceListUpdated');

        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();
        $this->iterator = rand();
    }

    //Validaciones en tiempo real
    public function updated($label){

        $requestResource = new RequestResource();

        $this->validateOnly($label, $requestResource->rules());

    }

    public function showModalNewResource(){

        //can('user create');
        $this->resetErrorBag();
        $this->resetValidation();
        $this->resource = null;
        $this->action = 'Create';
        $this->method = 'createResource';
        $this->showModal = '';

    }

    //Create Resource
    public function createResource(){

        $requestResource = new RequestResource();
        $values = $this->validate($requestResource->rules());
        $filePath = $values['attachment']->store('files/resources');
        $resource = new resource;
        $resource->fill($values);
        if ($values['attachment']) {
            $resource->attachment = $filePath;
        }
        $resource->save();

        $this->dispatchBrowserEvent('swal:modal', [
            'type' =>'success',
            'title' => 'Resource added successfully',
            'text' => '',
        ]);

        $this->emit('resourceListUpdated');

        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();
        $this->iterator = rand();
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
