<?php

namespace App\Http\Livewire\Manager\Hotels;

use App\Models\Amenity;
use App\Models\Category;
use App\Models\Country;
use App\Models\Experience;
use App\Models\Property;
use App\Models\RoomRange;
use Livewire\Component;
use Livewire\WithFileUploads;

class ModalHotel extends Component
{
    use WithFileUploads;

    public $modalDetails = 'hidden';
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

    protected $listeners = ['modalDetails', 'delete', 'removeImage'];

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
        return view('livewire.manager.hotels.modal-hotel');
    }

    public function modalDetails(Property $property){

        $this->resetErrorBag();
        $this->resetValidation();
        $this->property = $property;
        $this->name = $property->name;
        $this->description = $property->description;
        $this->logo =  $property->logo;
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
        $this->action = 'Details';
        $this->method = 'viewHotel';
        $this->modalDetails = '';
        $this->experienceList = Property::find($this->property->id)->experiences()->orderBy('name')->get();
        $this->amenityList = Property::find($this->property->id)->amenities()->orderBy('name')->get();
    
    }

    public function closeModal()
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();
    }
}
