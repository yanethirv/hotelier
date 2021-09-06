<?php

namespace App\Http\Livewire\Admin\Categories;

use App\Http\Requests\RequestCategory;
use App\Models\Category;
use Livewire\Component;


class ModalCategory extends Component
{

    public $showModal = 'hidden';
    public $name = '';
    public $description = '';
    public $category;
    public $action = '';
    public $method = '';

    protected $listeners = [
        'showModal', 'showModalNewCategory',
    ];

    public function render()
    {
        return view('livewire.admin.categories.modal-category');
    }

    public function showModal(Category $category)
    {
        //can('user update');
        $this->resetErrorBag();
        $this->resetValidation();

        $this->category = $category;
        $this->name = $category->name;
        $this->description = $category->description;
        $this->action = 'Update';
        $this->method = 'updateCategory';

        $this->showModal = '';
    
    }

    public function closeModal()
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();
    }

    //Update Category
    public function updateCategory(){

        $requestCategory = new RequestCategory();

        $values = $this->validate($requestCategory->rules($this->category));

        $this->category->update([
            'name' => $values['name'],
            'description' => $values['description'],
        ]);

        $this->dispatchBrowserEvent('swal:modal', [
            'type' =>'success',
            'title' => 'Category update successfully',
            'text' => '',
        ]);

        $this->emit('categoryListUpdated');
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();
    }

    //Validaciones en tiempo real
    public function updated($label){

        $requestCategory = new RequestCategory();

        $this->validateOnly($label, $requestCategory->rules($this->category));

    }

    public function showModalNewCategory(){
        //can('user create');

        $this->resetErrorBag();
        $this->resetValidation();

        $this->category = null;
        $this->action = 'Create';
        $this->method = 'createCategory';
        $this->showModal = '';

    }
    
    //Create Category
    public function createCategory(){

        $requestCategory = new RequestCategory();

        $values = $this->validate($requestCategory->rules(''));

        $category = new Category;
        $category->fill($values);
        $category->save();

        $this->dispatchBrowserEvent('swal:modal', [
            'type' =>'success',
            'title' => 'Category added successfully',
            'text' => '',
        ]);

        $this->emit('CategoryListUpdated');

        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();

        $this->closeModal();
    }

}
