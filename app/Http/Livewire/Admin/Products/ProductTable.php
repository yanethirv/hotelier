<?php

namespace App\Http\Livewire\Admin\Products;

use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class ProductTable extends Component
{
    use WithPagination;

    public $showModal = 'hidden';
    public $sortBy = "id";
    public $sortDirection = 'asc';
    public $perPage = 10;
    public $search = '';

    protected $listeners = ['productListUpdated' => 'render','deleteProduct' => 'deleteProduct'];

    public function render()
    {
        $products = Product::query()
            ->search($this->search)
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate($this->perPage);

        return view('livewire.admin.products.product-table', compact('products'));
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

    public function showModal(Product $product){
        //Emitimos al modal edit resource
        if($product->name) {
            //can('user update');
            $this->emit('showModal', $product);
        } else {
            //can('user create');
            $this->emit('showModalNewProduct');
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

    public function deleteProduct(Product $product){

        $stripe = new \Stripe\StripeClient(env("STRIPE_SECRET"));

        DB::beginTransaction();
            
        try {

            $stripe->products->update(
                $product->stripe_id,
                ['active' => false]
            );

            $product->delete();

            DB::commit();

        } catch (\Exception $e) {

            $this->dispatchBrowserEvent('swal:modal', [
                'type' =>'warning',
                'title' => 'Product error',
                'text' => '',
                ]);

            DB::rollBack();
        }

        $this->render();
    }
}
