<?php

namespace App\Http\Livewire\Hotel\Hotels;

use App\Http\Requests\RequestProperty;
use App\Models\Amenity;
use App\Models\Category;
use App\Models\Country;
use App\Models\Experience;
use App\Models\Property;
use App\Models\RoomRange;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use Livewire\Component;

class ModalHotel extends Component
{
    use WithFileUploads;

    public $showModal = 'hidden';
    public $name = '';
    public $room_range_id = '';
    public $category_id = '';
    public $description = '';
    public $logo = '';
    public $address = '';
    public $country_id = '';
    public $stars = '';
    public $opening_date = '';
    public $floor_number = '';
    public $instagram = '';
    public $facebook = '';
    public $linkedin = '';
    public $youtube = '';
    public $twitter = '';
    public $frontdesk_phone = '';
    public $frontdesk_email = '';
    public $reservation_phone = '';
    public $reservation_email = '';
    public $billing_email = '';
    public $state = '';
    public $city = '';
    public $experiences_check = [];
    public $amenities_check = [];
    public $property;
    public $roomRanges = [];
    public $categories = [];
    public $countries = [];
    public $experiences = [];
    public $amenities = [];
    public $action = '';
    public $method = '';
    public $iterator='';
    public $experienceList=[];
    public $amenityList=[];

    protected $listeners = ['showModal', 'showModalNewHotel', 'delete', 'removeImage'];

    public function hydrate(){

        $this->roomRanges = RoomRange::pluck('name', 'id')->toArray();
        $this->categories = Category::pluck('name', 'id')->toArray();
        $this->countries = Country::pluck('name', 'id')->toArray();
        $this->experiences = Experience::pluck('name', 'id')->toArray();
        $this->amenities = Amenity::pluck('name', 'id')->toArray();

    }

    public function mount(){
        $this->iterator = rand();
    }

    public function render()
    {
        return view('livewire.hotel.hotels.modal-hotel');
    }

    public function showModal(Property $property){

        $this->resetErrorBag();
        $this->resetValidation();
        $this->property = $property;
        $this->name = $property->name;
        $this->description = $property->description;
        $this->logo = '';
        $this->address = $property->address;
        $this->category_id = $property->category()->first()->id ?? '';
        $this->room_range_id = $property->roomRange()->first()->id ?? '';
        $this->country_id = $property->country()->first()->id ?? '';
        $this->stars = $property->stars;
        $this->opening_date = $property->opening_date;
        $this->floor_number = $property->floor_number;
        $this->instagram = $property->instagram;
        $this->facebook = $property->facebook;
        $this->linkedin = $property->linkedin;
        $this->youtube = $property->youtube;
        $this->twitter = $property->twitter;
        $this->frontdesk_phone = $property->frontdesk_phone;
        $this->frontdesk_email = $property->frontdesk_email;
        $this->reservation_phone = $property->reservation_phone;
        $this->reservation_email = $property->reservation_email;
        $this->billing_email = $property->billing_email;
        $this->state = $property->state;
        $this->city = $property->city;
        $this->action = 'Update';
        $this->method = 'updateHotel';
        $this->showModal = '';
        $this->experienceList = Property::find($this->property->id)->experiences()->orderBy('name')->get();
        $this->amenityList = Property::find($this->property->id)->amenities()->orderBy('name')->get();
    
    }

    public function closeModal()
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();
    }

    //Update Property
    public function updateHotel(){
        $requestProperty = new RequestProperty();
        $values = $this->validate($requestProperty->rules($this->property));

        DB::beginTransaction();

       try {
            if ($values['logo'] === '') {

                $this->property->update([
                    'name' => $values['name'],
                    'room_range_id' => $values['room_range_id'],
                    'category_id' => $values['category_id'],
                    'description' => $values['description'],
                    'address' => $values['address'],
                    'country_id' => $values['country_id'],
                    'stars' => $values['stars'],
                    'opening_date' => $values['opening_date'],
                    'floor_number' => $values['floor_number'],
                    'instagram' => $values['instagram'],
                    'facebook' => $values['facebook'],
                    'linkedin' => $values['linkedin'],
                    'youtube' => $values['youtube'],
                    'twitter' => $values['twitter'],
                    'frontdesk_phone' => $values['frontdesk_phone'],
                    'frontdesk_email' => $values['frontdesk_email'],
                    'reservation_phone' => $values['reservation_phone'],
                    'reservation_email' => $values['reservation_email'],
                    'billing_email' => $values['billing_email'],
                    'state' => $values['state'],
                    'city' => $values['city']
                ]);
            } 
            else {

                $this->removeImage($this->property->logo);

                $filePath = $values['logo']->store('img/properties/logos');
                $values['logo'] = $filePath;

                $this->property->update([
                    'name' => $values['name'],
                    'room_range_id' => $values['room_range_id'],
                    'category_id' => $values['category_id'],
                    'description' => $values['description'],
                    'logo' =>  $values['logo'],
                    'address' => $values['address'],
                    'country_id' => $values['country_id'],
                    'stars' => $values['stars'],
                    'opening_date' => $values['opening_date'],
                    'floor_number' => $values['floor_number'],
                    'instagram' => $values['instagram'],
                    'facebook' => $values['facebook'],
                    'linkedin' => $values['linkedin'],
                    'youtube' => $values['youtube'],
                    'twitter' => $values['twitter'],
                    'frontdesk_phone' => $values['frontdesk_phone'],
                    'frontdesk_email' => $values['frontdesk_email'],
                    'reservation_phone' => $values['reservation_phone'],
                    'reservation_email' => $values['reservation_email'],
                    'billing_email' => $values['billing_email'],
                    'state' => $values['state'],
                    'city' => $values['city']
                ]);
            }


            if(!empty($this->experiences_check))
            {
                $this->property->experiences()->sync($this->experiences_check);
            }
            
            if(!empty($this->amenities_check))
            {
                $this->property->amenities()->sync($this->amenities_check);
            }
        

            //event(new StatusActivationServiceEvent($activationServiceTransaction));

            $this->dispatchBrowserEvent('swal:modal', [
                'type' =>'success',
                'title' => 'Hotel update successfully',
                'text' => '',
            ]);

            DB::commit();

        } catch (\Exception $e) {

            $this->dispatchBrowserEvent('swal:modal', [
                'type' =>'warning',
                'title' => 'Hotel error',
               'text' => '',
           ]);

            DB::rollback();
        }

        $this->emit('propertyListUpdated');
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();
        $this->iterator = rand();
        $this->closeModal();

    }

    //Validaciones en tiempo real
    public function updated($label){

        $requestProperty = new RequestProperty();

        $this->validateOnly($label, $requestProperty->rules($this->property));

    }

    public function showModalNewHotel(){
        //can('user create');

        $this->resetErrorBag();
        $this->resetValidation();
        $this->property = null;
        $this->action = 'Create';
        $this->method = 'createHotel';
        $this->showModal = '';

    }

    //Create Hotel
    public function createHotel(){

        //dd($this->experiences_check);
        $requestProperty = new RequestProperty();
        $values = $this->validate($requestProperty->rules(''));

        DB::beginTransaction();

        try {

            $property = new Property();

            if ($values['logo']) {
                $filePath = $values['logo']->store('img/properties/logos');
                $values['logo'] = $filePath;
            }

            $property->name = $values['name'];
            $property->room_range_id = $values['room_range_id'];
            $property->category_id = $values['category_id'];
            $property->description = $values['description'];
            $property->logo = $values['logo'];
            $property->address = $values['address'];
            $property->country_id = $values['country_id'];
            $property->user_id = auth()->user()->id;
            $property->stars = $values['stars'];
            $property->opening_date = $values['opening_date'];
            $property->floor_number = $values['floor_number'];
            $property->instagram = $values['instagram'];
            $property->facebook = $values['facebook'];
            $property->linkedin = $values['linkedin'];
            $property->youtube = $values['youtube'];
            $property->twitter = $values['twitter'];
            $property->frontdesk_phone = $values['frontdesk_phone'];
            $property->frontdesk_email = $values['frontdesk_email'];
            $property->reservation_phone = $values['reservation_phone'];
            $property->reservation_email = $values['reservation_email'];
            $property->billing_email = $values['billing_email'];
            $property->state = $values['state'];
            $property->city = $values['city'];
            $property->save();

            $property->experiences()->sync($this->experiences_check);

            $property->amenities()->sync($this->amenities_check);

            $this->dispatchBrowserEvent('swal:modal', [
            'type' =>'success',
            'title' => 'Hotel added successfully',
            'text' => '',
            ]);

            DB::commit();

        } catch (\Exception $e) {

            $this->dispatchBrowserEvent('swal:modal', [
                'type' =>'warning',
                'title' => 'Hotel error',
               'text' => '',
           ]);

            DB::rollback();
        }

        $this->emit('propertyListUpdated');
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();
        $this->iterator = rand();
        $this->closeModal();
        
    }

    public function removeImage($logo){
        if (!$logo) {
            return;
        }

        if (Storage::disk('public')->exists($logo)) {
            Storage::disk('public')->delete($logo);
        }
    }
}
