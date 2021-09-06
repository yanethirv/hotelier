<?php

namespace App\Http\Livewire\Hotel\Hotels;

use App\Models\Property;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use PDF;

class HotelTable extends Component
{
    use WithPagination;

    public $showModal = 'hidden';
    public $modalDetails = 'hidden';
    public $sortBy = "id";
    public $sortDirection = 'asc';
    public $perPage = 10;
    public $search = '';

    protected $listeners = [
        'propertyListUpdated' => 'render'
    ];

    public function render(){
        
        $properties = Property::where('user_id', auth()->user()->id)->pluck('id')->toArray();

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

        //dd($properties);

        return view('livewire.hotel.hotels.hotel-table', compact('properties'));

        $this->emit('fileUploaded');
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

    public function showModal(Property $property){

        //Emitimos al modal edit
        if($property->user_id) {
            //can('user update');
            $this->emit('showModal', $property);
        } else {
            //can('user create');
            $this->emit('showModalNewHotel');
        }
    }

    public function modalDetails(Property $property){
        //Emitimos al modal details
        if($property->user_id) {
            //can('user update');
            $this->emit('modalDetails', $property);
        }
    }

    public function hotelPDF($id){
       
        $property = Property::find($id);

        $pdf = PDF::loadView('livewire.hotel.hotels.hotel-pdf', $property);
  
        // download PDF file with download method
        return $pdf->download($property->name.'.pdf');

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

        DB::beginTransaction();

        try {

            //$this->emit('removeFile', $document->attachment);

            $property->delete();

            DB::commit();

        } catch (\Exception $e) {

            $this->dispatchBrowserEvent('swal:modal', [
                'type' =>'warning',
                'title' => 'Hotel error',
                'text' => '',
                ]);

            DB::rollBack();

        }

        $this->render();
    }

}
