<?php

namespace App\Http\Livewire\Hotel\Documents;

use App\Http\Requests\RequestDocument;
use App\Models\Document;
use App\Models\Property;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class ModalDocument extends Component
{
    use WithFileUploads;

    public $showModal = 'hidden';
    public $title = '';
    public $description = '';
    public $property_id = '';
    public $document;
    public $properties = [];
    public $action = '';
    public $method = '';
    public $attachment = '';
    public $iterator='';

    protected $listeners = [
        'showModal', 'showModalNewDocument', 'removeFile'
    ];

    public function mount(){
        $this->iterator = rand();
    }

    public function hydrate(){

        $this->properties = Property::where('user_id', auth()->user()->id)->pluck('name', 'id')->toArray();

    }

    public function render()
    {
        return view('livewire.hotel.documents.modal-document');
    }

    public function showModal(Document $document)
    {
        //can('user update');
        $this->resetErrorBag();
        $this->resetValidation();
        $this->document = $document;
        $this->title = $document->title;
        $this->description = $document->description;
        //$this->attachment = $document->attachment;
        $this->property_id = $document->property_id;
        $this->action = 'Update';
        $this->method = 'updateDocument';
        $this->showModal = '';
    
    }

    public function closeModal()
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();
    }

    //Update Document
    public function updateDocument(){

        $requestDocument = new RequestDocument();

        $values = $this->validate($requestDocument->rules());

        if ($values['attachment'] == '') {

            $this->document->update([
                'title' => $values['title'],
                'description' => $values['description'],
                'property_id' => $values['property_id'],
            ]);

        } else {

            $this->removeFile($this->document->attachment);

            $filePath = $values['attachment']->store('files/documents/'.$values['property_id']);

            $values['attachment'] = $filePath;

            $this->document->update([
                'title' => $values['title'],
                'description' => $values['description'],
                'attachment' =>$values['attachment'],
                'property_id' => $values['property_id'],
            ]);
            
        }

        $this->dispatchBrowserEvent('swal:modal', [
            'type' =>'success',
            'title' => 'Document update successfully',
            'text' => '',
        ]);

        $this->emit('documentListUpdated');

        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();
        $this->iterator = rand();
        
    }

    //Validaciones en tiempo real
    public function updated($label){

        $requestDocument = new RequestDocument();

        $this->validateOnly($label, $requestDocument->rules());

    }

    public function showModalNewDocument(){

        //can('user create');
        $this->resetErrorBag();
        $this->resetValidation();
        $this->document = null;
        $this->action = 'Create';
        $this->method = 'createDocument';
        $this->showModal = '';

    }

    //Create Document
    public function createDocument(){

        $requestDocument= new RequestDocument();
        $values = $this->validate($requestDocument->rules());
        $filePath = $values['attachment']->store('files/documents/'.$values['property_id']);
        $document = new Document();
        $document->fill($values);
        if ($values['attachment']) {
            $document->attachment = $filePath;
        }
        $document->save();

        $this->dispatchBrowserEvent('swal:modal', [
            'type' =>'success',
            'title' => 'Document added successfully',
            'text' => '',
        ]);

        $this->emit('documentListUpdated');

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
