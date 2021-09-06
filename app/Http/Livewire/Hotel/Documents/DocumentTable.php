<?php

namespace App\Http\Livewire\Hotel\Documents;

use App\Models\Document;
use App\Models\Property;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class DocumentTable extends Component
{
    use WithPagination;

    use WithFileUploads;

    public $showModal = 'hidden';
    public $sortBy = "id";
    public $sortDirection = 'asc';
    public $perPage = 10;
    public $search = '';

    protected $listeners = [
        'documentListUpdated' => 'render', 'deleteDocument' => 'deleteDocument',
    ];

    public function render()
    {
        $properties = Property::where('user_id', auth()->user()->id)->pluck('id')->toArray();

        $callback = function ($q) {
            $q->where('name', 'like', "%{$this->search}%");
        };

        $title = $this->search;
        
        $documents = Document::where(function ($query) use ($properties) {
                        $query->whereIn('property_id',$properties);
                    })
                    ->where(function ($query) use ($callback, $title) {
                        $query->whereHas('property', $callback)
                            ->orWhere('title', 'like', "%{$title}%");
                    })
                    ->orderBy($this->sortBy, $this->sortDirection)
                    ->paginate($this->perPage);

        return view('livewire.hotel.documents.document-table', compact('documents'));
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

    public function showModal(Document $document){
        //Emitimos al modal edit document
        if($document->title) {
            //can('user update');
            $this->emit('showModal', $document);
        } else {
            //can('user create');
            $this->emit('showModalNewDocument');
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

    public function deleteDocument(Document $document){

        DB::beginTransaction();

        try {

            $this->emit('removeFile', $document->attachment);

            $document->delete();

            DB::commit();

        } catch (\Exception $e) {

            $this->dispatchBrowserEvent('swal:modal', [
                'type' =>'warning',
                'title' => 'Document error',
                'text' => '',
                ]);

            DB::rollBack();

        }

        $this->render();
    }
}
