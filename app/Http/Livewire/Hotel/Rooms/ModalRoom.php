<?php

namespace App\Http\Livewire\Hotel\Rooms;

use App\Http\Requests\RequestRoom;
use App\Models\Occupancy;
use App\Models\Property;
use App\Models\RatePlan;
use App\Models\Room;
use App\Models\RoomType;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ModalRoom extends Component
{
    public $showModal = 'hidden';
    public $code = '';
    public $property_id = '';
    public $room_type_id = '';
    public $occupancy_id = '';
    public $floor = '';
    public $number = '';
    public $description = '';
    public $rate_plan_id = '';
    public $rate = '';
    public $amount_extra_person = '';
    public $late_check_out = '';
    public $early_check_in = '';
    public $day_pass_fee = '';
    public $night_pass_fee = '';
    public $roll_away_bed = '';
    public $pet_fee = '';
    public $properties = [];
    public $roomTypes = [];
    public $occupancies = [];
    public $ratePlans = [];
    public $room;
    public $action = '';
    public $method = '';

    protected $listeners = ['showModal', 'showModalNewRoom'];

    public function hydrate(){

        $properties = Property::where('user_id', auth()->user()->id)->pluck('id')->toArray();

        $this->properties = Property::where('user_id', auth()->user()->id)->pluck('name', 'id')->toArray();

        $this->roomTypes = RoomType::pluck('name','id')->toArray();

        $this->occupancies = Occupancy::pluck('name', 'id')->toArray();
        
        $this->ratePlans = RatePlan::where(function ($query) use ($properties) {
            $query->whereIn('property_id',$properties);
        })->pluck('name', 'id')->toArray();

    }

    public function render()
    {
        return view('livewire.hotel.rooms.modal-room');
    }

    public function showModal(Room $room){

        //can('user update');
        $this->resetErrorBag();
        $this->resetValidation();
        $this->room = $room;
        $this->code = $room->code;
        $this->property_id = $room->property()->first()->id ?? '';
        $this->room_type_id = $room->roomType()->first()->id ?? '';
        $this->occupancy_id = $room->occupancy()->first()->id ?? '';
        $this->floor = $room->floor;
        $this->number = $room->number;
        $this->description = $room->description;
        $this->rate_plan_id = $room->ratePlan()->first()->id ?? '';
        $this->rate = $room->rate;
        $this->amount_extra_person = $room->amount_extra_person;
        $this->late_check_out = $room->late_check_out;
        $this->early_check_in = $room->early_check_in;
        $this->day_pass_fee = $room->day_pass_fee;
        $this->night_pass_fee = $room->night_pass_fee;
        $this->roll_away_bed = $room->roll_away_bed;
        $this->pet_fee = $room->pet_fee;
        $this->action = 'Update';
        $this->method = 'updateRoom';
        $this->showModal = '';
    
    }

    public function closeModal()
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();
    }

    //Update Room
    public function updateRoom(){

        $requestRoom= new RequestRoom();
        $values = $this->validate($requestRoom->rules($this->room));

        DB::beginTransaction();

        try {

            $this->room->update([
                'code' => $values['code'],
                'property_id' => $values['property_id'],
                'room_type_id' => $values['room_type_id'],
                'occupancy_id' => $values['occupancy_id'],
                'floor' => $values['floor'],
                'number' => $values['number'],
                'description' => $values['description'],
                'rate_plan_id' => $values['rate_plan_id'],
                'rate' => $values['rate'],
                'amount_extra_person' => $values['amount_extra_person'],
                'late_check_out' => $values['late_check_out'],
                'early_check_in' => $values['early_check_in'],
                'day_pass_fee' => $values['day_pass_fee'],
                'night_pass_fee' => $values['night_pass_fee'],
                'roll_away_bed' => $values['roll_away_bed'],
                'pet_fee' => $values['pet_fee']
            ]);

            $this->dispatchBrowserEvent('swal:modal', [
                'type' =>'success',
                'title' => 'Room update successfully',
                'text' => '',
            ]);

            DB::commit();

        } catch (\Exception $e) {

            $this->dispatchBrowserEvent('swal:modal', [
                'type' =>'warning',
                'title' => 'Room error',
                'text' => '',
            ]);
            
            DB::rollBack();
        }

        $this->emit('roomListUpdated');
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();
    }

    //Validaciones en tiempo real
    public function updated($label){

        $requestRoom = new RequestRoom();
        $this->validateOnly($label, $requestRoom->rules($this->room));

    }

    public function showModalNewRoom(){
        //can('user create');

        $this->resetErrorBag();
        $this->resetValidation();
        $this->room = null;
        $this->action = 'Create';
        $this->method = 'createRoom';
        $this->showModal = '';

    }

    public function createRoom(){

        $requestRoom = new RequestRoom();
        $values = $this->validate($requestRoom->rules(''));

        DB::beginTransaction();
            
        try {

            $room = new Room();
            $room->fill($values);
            $room->save();

            $this->dispatchBrowserEvent('swal:modal', [
                'type' =>'success',
                'title' => 'Room added successfully',
                'text' => '',
            ]);

            DB::commit();

        } catch (\Exception $e) {

            $this->dispatchBrowserEvent('swal:modal', [
                'type' =>'warning',
                'title' => 'Room error',
                'text' => '',
                ]);

            DB::rollBack();
        }

        $this->emit('roomListUpdated');
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();
        $this->closeModal();
    }

}
