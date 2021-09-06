<?php

namespace App\Http\Livewire\Hotel\Photos;

use App\Models\Photo;
use App\Models\Property;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class PhotoTable extends Component
{
    use WithPagination;

    public $showModal = 'hidden';
    public $sortBy = "id";
    public $sortDirection = 'asc';
    public $perPage = 10;
    public $search = '';

    protected $listeners = [
        'photoListUpdated' => 'render', 'deletePhoto' => 'deletePhoto',
    ];

    public function render()
    {
        $properties = Property::where('user_id', auth()->user()->id)->pluck('id')->toArray();

        $callback = function ($q) {
            $q->where('name', 'like', "%{$this->search}%");
        };

        $title = $this->search;
        
        $photos = Photo::where(function ($query) use ($properties) {
                        $query->whereIn('property_id',$properties);
                    })
                    ->where(function ($query) use ($callback, $title) {
                        $query->whereHas('property', $callback)
                            ->orWhereHas('photoLocation', $callback)
                            ->orWhere('title', 'like', "%{$title}%");
                    })
                    ->orderBy($this->sortBy, $this->sortDirection)
                    ->paginate($this->perPage);

        return view('livewire.hotel.photos.photo-table', compact('photos'));
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

    public function showModal(Photo $photo){

        //Emitimos al modal edit resource
        if($photo->property_id) {
            //can('user update');
            $this->emit('showModal', $photo);
        } else {
            //can('user create');
            $this->emit('showModalNewPhoto');
        }
    }

    public function deleteConfirm($id){
        
        $this->dispatchBrowserEvent('swal:confirm', [
            'type' =>'warning',
            'title' => 'Are you sure?',
            'text' => '',
            'id' => $id,
        ]);
    }

    public function deletePhoto(Photo $photo){

        DB::beginTransaction();

        try {

            $this->emit('removeImage',$photo->photo_path);

            $photo->delete();

            DB::commit();

        } catch (\Exception $e) {

            $this->dispatchBrowserEvent('swal:modal', [
                'type' =>'warning',
                'title' => 'Photos error',
                'text' => '',
                ]);

            DB::rollBack();

        }

        $this->render();

    }

}
