<?php

namespace App\Http\Livewire\Manager\Hotels;

use App\Models\Country;
use App\Models\Property;
use App\Models\RoomRange;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use PDF;

class HotelList extends Component
{
    use WithPagination;

    public $showModal = 'hidden';
    public $sortBy = "id";
    public $sortDirection = 'asc';
    public $perPage = 10;
    public $search = '';

    protected $listeners = [
        'propertyListUpdated' => 'render'
    ];

    public function render()
    {
        $properties = Property::all()->pluck('id')->toArray();

        $callback = function ($q) {
            $q->where('name', 'like', "%{$this->search}%");
        };

        $name = $this->search;
        
        $properties = Property::where(function ($query) use ($properties) {
                        $query->whereIn('id',$properties);
                    })
                    ->where(function ($query) use ($callback, $name) {
                        $query->whereHas('roomRange', $callback)
                            ->orWhereHas('category', $callback)
                            ->orWhereHas('country', $callback)
                            ->orWhere('name', 'like', "%{$name}%");
                    })
                    ->orderBy($this->sortBy, $this->sortDirection)
                    ->paginate($this->perPage);

        return view('livewire.manager.hotels.hotel-list', compact('properties'));
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

    public function modalDetails(Property $property){

        //Emitimos al modal detail
        if($property->user_id) {
            //can('user update');
            $this->emit('modalDetails', $property);
        }
    }

    public function hotelPDF($id){
       
        $property = Property::find($id);


        //$category = $property->category->name;

        $pdf = PDF::loadView('livewire.manager.hotels.hotel-pdf', $property);
  
        // download PDF file with download method
        return $pdf->download($property->name.'.pdf');

    }

    public function downloadProfile($id)
    {
        $hotel = Property::find($id);

        $experiences = Property::find($hotel->id)->experiences()->orderBy('name')->get();

        $amenities = Property::find($hotel->id)->amenities()->orderBy('name')->get();

        //$rooms = Room::where('hotel_id', '=', $hotel->id)->paginate(10);

        //$restaurants = Restaurant::where('hotel_id', '=', $hotel->id)->paginate(10);

        //$mealplans = Mealplan::where('hotel_id', '=', $hotel->id)->paginate(10);

        //$policies = Policy::where('hotel_id', '=', $hotel->id)->paginate(10);

        //$rateplans = Rateplan::where('hotel_id', '=', $hotel->id)->paginate(10);

        //$photos = Photo::where('hotel_id', '=', $hotel->id)->paginate(10);

        //$rateplansrooms = Rateplans_room::where('hotel_id', '=', $hotel->id)->paginate(10);

        //$documents = Documenthotel::where('hotel_id', '=', $hotel->id)->paginate(10);

        //dd($hotelProfile);

        set_time_limit(300); // Extends to 5 minutes.
        
        $pdf = \PDF::loadView('manager.hotels.profile', ['hotel' => $hotel,'experiences' => $experiences,'amenities' => $amenities]);
        //return $pdf->download('hotel-profile.pdf');
        return $pdf->download($hotel->name.'.pdf');
    }

    public function hotelDetail($id)
    {
        $property = Property::find($id);

        $roomRanges = RoomRange::pluck('name', 'id')->toArray();

        $experienceList = Property::find($id)->experiences()->orderBy('name')->get();

        $amenityList = Property::find($id)->amenities()->orderBy('name')->get();
    

        //dd($experienceList);

        return view('livewire.manager.hotels.hotel-detail', compact('property', 'roomRanges', 'experienceList', 'amenityList'));
    }

    public function deleteConfirm($id){
        
        $this->dispatchBrowserEvent('swal:confirm', [
            'type' =>'warning',
            'title' => 'Are you sure?',
            'text' => '',
            'id' => $id,
        ]);
    }

    public function deleteHotel(Property $property){

        $property->delete();

        $this->render();
    }
}
