<?php

namespace App\Http\Livewire\Admin\Services;

use App\Http\Requests\RequestService;
use App\Models\Service;
use App\Models\Type;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class ModalService extends Component
{
    use WithFileUploads;

    public $showModal = 'hidden';
    public $name = '';
    public $description = '';
    public $price = '';
    public $cost = '';
    public $type_id = '';
    public $cod_product = '';
    public $cod_price = '';
    public $attachment;
    public $types = [];
    public $service;
    public $action = '';
    public $method = '';
    public $iterator='';

    protected $listeners = ['showModal', 'showModalNewService', 'removeFile'];

    public function mount(){

        $this->iterator = rand();

    }

    public function hydrate(){

        $this->types = Type::pluck('name', 'id')->toArray();

    }

    public function render(){

        return view('livewire.admin.services.modal-service');

    }

    public function showModal(Service $service){

        //can('user update');
        $this->resetErrorBag();
        $this->resetValidation();
        $this->service = $service;
        $this->name = $service->name;
        $this->description = $service->description;
        $this->price = $service->price;
        $this->cost = $service->cost;
        $this->cod_product = $service->cod_product;
        $this->cod_price = $service->cod_price;
        $this->type_id = $service->type()->first()->id ?? '';
        $this->attachment = $service->attachment;
        $this->action = 'Update';
        $this->method = 'updateService';
        $this->showModal = '';
    
    }

    public function closeModal()
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();
    }

    //Update Service
    public function updateService(){

        $requestService = new RequestService();
        $values = $this->validate($requestService->rules($this->service));

        try {

            if (!$values['attachment']) {

                $this->service->update([
                    'name' => $values['name'],
                    'description' => $values['description'],
                    'price' => $values['price'],
                    'cost' => $values['cost'],
                    'type_id' => $values['type_id'],
                ]);

            } else {

                $this->removeFile($this->service->attachment);
                $filePath = $values['attachment']->store('files/services');
                $values['attachment'] = $filePath;

                $this->service->update([
                    'name' => $values['name'],
                    'description' => $values['description'],
                    'price' => $values['price'],
                    'cost' => $values['cost'],
                    'type_id' => $values['type_id'],
                    'attachment' => $values['attachment'],
                ]);
            }
            
            $this->dispatchBrowserEvent('swal:modal', [
                'type' =>'success',
                'title' => 'Service update successfully',
                'text' => '',
            ]);

        } catch (\Exception $e) {

            $this->dispatchBrowserEvent('swal:modal', [
                'type' =>'warning',
                'title' => 'Service error',
                'text' => '',
                ]);
        }

        $this->emit('serviceListUpdated');
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();
        $this->iterator = rand();
    }

    //Validaciones en tiempo real
    public function updated($label){

        $requestService = new RequestService();
        $this->validateOnly($label, $requestService->rules($this->service));

    }

    public function showModalNewService(){
        //can('user create');

        $this->resetErrorBag();
        $this->resetValidation();
        $this->service = null;
        $this->action = 'Create';
        $this->method = 'createService';
        $this->showModal = '';

    }
    
    //Create Service
    public function createService(){

        $requestService = new RequestService();
        $values = $this->validate($requestService->rules(''));

        try {

            if ($values['attachment']) {

                $filePath = $values['attachment']->store('files/services');
                $values['attachment'] = $filePath;

            }

            $service = new service;
            $service->fill($values);
            $service->save();
            
            $this->dispatchBrowserEvent('swal:modal', [
            'type' =>'success',
            'title' => 'Service added successfully',
            'text' => '',
            ]);

        } catch (\Exception $e) {

            $this->dispatchBrowserEvent('swal:modal', [
                'type' =>'warning',
                'title' => 'Service error',
                'text' => '',
                ]);
        }

        $this->emit('serviceListUpdated');
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
