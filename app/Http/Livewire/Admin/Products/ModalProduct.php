<?php

namespace App\Http\Livewire\Admin\Products;

use App\Http\Requests\RequestProduct;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ModalProduct extends Component
{
    public $showModal = 'hidden';
    public $name = '';
    public $description = '';
    public $stripe_id = '';
    public $product;
    public $action = '';
    public $method = '';

    protected $listeners = ['showModal', 'showModalNewProduct'];

    public function render()
    {
        return view('livewire.admin.products.modal-product');
    }

    public function showModal(Product $product)
    {
        //can('user update');
        $this->resetErrorBag();
        $this->resetValidation();
        $this->product = $product;
        $this->name = $product->name;
        $this->description = $product->description;
        $this->stripe_id = $product->stripe_id;
        $this->action = 'Update';
        $this->method = 'updateProduct';
        $this->showModal = '';
    
    }

    public function closeModal()
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();
    }

    //Update Product
    public function updateProduct(){

        $stripe = new \Stripe\StripeClient(env("STRIPE_SECRET"));
        $requestProduct = new RequestProduct();
        $values = $this->validate($requestProduct->rules($this->product));


        //dd($values);
        DB::beginTransaction();
            
        try {

            $pl = $stripe->products->update(
                $values['stripe_id'],
                ['name' => $values['name'], 'description' => $values['description']]
            );

            $this->product->update([
                'name' => $values['name'],
                'description' => $values['description'],
            ]);

            $this->dispatchBrowserEvent('swal:modal', [
                'type' =>'success',
                'title' => 'Product update successfully',
                'text' => '',
            ]);

            DB::commit();

        } catch (\Exception $e) {

            $this->dispatchBrowserEvent('swal:modal', [
                'type' =>'warning',
                'title' => 'Product error',
                'text' => '',
                ]);

            DB::rollBack();
        }

        $this->emit('productListUpdated');
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();
    }

    //Validaciones en tiempo real
    public function updated($label){

        $requestProduct = new RequestProduct();
        $this->validateOnly($label, $requestProduct->rules($this->product));

    }

    public function showModalNewProduct(){
        //can('user create');

        $this->resetErrorBag();
        $this->resetValidation();
        $this->product = null;
        $this->action = 'Create';
        $this->method = 'createProduct';
        $this->showModal = '';

    }

    //Create Product
    public function createProduct(){

        $stripe = new \Stripe\StripeClient(env("STRIPE_SECRET"));
        $requestProduct = new RequestProduct();
        $values = $this->validate($requestProduct->rules(''));
        
        DB::beginTransaction();
            
        try {

            $productStripe = $stripe->products->create([
                'name' => $values['name'],
                'description' => $values['description'],
            ]);

            $values['stripe_id'] = $productStripe->id;

            $product = new Product;
            $product->fill($values);
            $product->save();

            $this->dispatchBrowserEvent('swal:modal', [
                'type' =>'success',
                'title' => 'Product added successfully',
                'text' => '',
            ]);

            DB::commit();

        } catch (\Exception $e) {

            $this->dispatchBrowserEvent('swal:modal', [
                'type' =>'warning',
                'title' => 'Product error',
                'text' => '',
                ]);

            DB::rollBack();
        }

        $this->emit('productListUpdated');
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();
        $this->closeModal();
    }
}
