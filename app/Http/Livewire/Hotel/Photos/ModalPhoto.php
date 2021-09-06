<?php

namespace App\Http\Livewire\Hotel\Photos;

use App\Http\Requests\RequestPhoto;
use App\Models\Photo;
use App\Models\PhotoLocation;
use App\Models\Property;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class ModalPhoto extends Component
{
    use WithFileUploads;

    public $showModal = 'hidden';
    public $title = '';
    public $property_id = '';
    public $photo_location_id = '';
    public $properties = [];
    public $photoLocations = [];
    public $photo_path = '';
    public $photo;
    public $action = '';
    public $method = '';
    public $iterator='';

    protected $listeners = [
        'showModal', 'showModalNewPhoto', 'delete', 'removeImage'
    ];

    public function hydrate(){

        $this->properties = Property::where('user_id', auth()->user()->id)->pluck('name', 'id')->toArray();
        $this->photoLocations = PhotoLocation::pluck('name', 'id')->toArray();

    }

    public function mount(){
        $this->iterator = rand();
    }

    public function render()
    {
        return view('livewire.hotel.photos.modal-photo');
    }

    public function showModal(Photo $photo){

        //can('user update');
        $this->resetErrorBag();
        $this->resetValidation();
        $this->photo = $photo;
        $this->title = $photo->title;
        $this->property_id = $photo->property()->first()->id ?? '';
        $this->photo_location_id = $photo->photoLocation()->first()->id ?? '';
        $this->photo_path = $photo->photo_path;
        $this->action = 'Update';
        $this->method = 'updatePhoto';
        $this->showModal = '';
    
    }

    public function closeModal()
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();
    }

    //Update Photo
    public function updatePhoto(){

        $requestPhoto= new RequestPhoto();
        $values = $this->validate($requestPhoto->rules($this->photo));

        DB::beginTransaction();

        try {

            if ($values['photo_path'] === '') {

                $this->photo->update([
                    'title' => $values['title'],
                    'property_id' => $values['property_id'],
                    'photo_location_id' => $values['photo_location_id'],
                ]);
    
            } else {

                $this->removeImage($this->photo->photo_path);
                $filePath = $values['photo_path']->store('img/photos/'.$values['property_id']);
                $values['photo_path'] = $filePath;
            
                $this->photo->update([
                    'title' => $values['title'],
                    'property_id' => $values['property_id'],
                    'photo_location_id' => $values['photo_location_id'],
                    'photo_path' =>$values['photo_path'],
                ]);
                
            }

            $this->dispatchBrowserEvent('swal:modal', [
                'type' =>'success',
                'title' => 'Photo update successfully',
                'text' => '',
            ]);

            DB::commit();

        } catch (\Exception $e) {

            $this->dispatchBrowserEvent('swal:modal', [
                'type' =>'warning',
                'title' => 'Photo error',
                'text' => '',
            ]);
            
            DB::rollBack();
        }

        $this->dispatchBrowserEvent('pondReset');
        $this->emit('photoListUpdated');
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();
        $this->iterator = rand();
    }

    //Validaciones en tiempo real
    public function updated($label){

        $requestPhoto = new RequestPhoto();
        $this->validateOnly($label, $requestPhoto->rules($this->photo));

    }

    public function showModalNewPhoto(){
        //can('user create');

        $this->resetErrorBag();
        $this->resetValidation();
        $this->photo = null;
        $this->photo_path = '';
        $this->action = 'Create';
        $this->method = 'createPhoto';
        $this->showModal = '';

    }

    public function createPhoto(){

        $requestPhoto = new RequestPhoto();
        $values = $this->validate($requestPhoto->rules(''));

        //dd($values['image']);

        DB::beginTransaction();
            
        try {

            $photo = new Photo();

            if ($values['photo_path']) {

                $filePath = $values['photo_path']->store('img/photos/'.$values['property_id']);
                $values['photo_path'] = $filePath;
            }

            $photo->fill($values);
            $photo->save();


            $this->dispatchBrowserEvent('swal:modal', [
                'type' =>'success',
                'title' => 'Photo added successfully',
                'text' => '',
            ]);

            DB::commit();

        } catch (\Exception $e) {

            $this->dispatchBrowserEvent('swal:modal', [
                'type' =>'warning',
                'title' => 'Photo error',
                'text' => '',
                ]);

            DB::rollBack();
        }
        $this->dispatchBrowserEvent('pondReset');
        $this->emit('photoListUpdated');
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();
        $this->iterator = rand();
        $this->closeModal();
    }

    public function removeImage($photo_path){
        if (!$photo_path) {
            return;
        }

        if (Storage::disk('public')->exists($photo_path)) {
            Storage::disk('public')->delete($photo_path);
        }
    }
}
