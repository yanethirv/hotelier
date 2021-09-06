<?php

namespace App\Http\Livewire\Marketplace\FeeInvoices;

use App\Models\FeeInvoice;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class FeeInvoiceTable extends Component
{
    use WithPagination;

    public $showModal = 'hidden';
    public $sortBy = "id";
    public $sortDirection = 'asc';
    public $perPage = 10;
    public $search = '';

    protected $listeners = ['feeInvoiceListUpdated' => 'render','deleteFeeInvoice' => 'deleteFeeInvoice'];

    public function render()
    {
        $invoices = FeeInvoice::where('user_id', auth()->user()->id)->pluck('id')->toArray();

        $callback = function ($q) {
            $q->where('name', 'like', "%{$this->search}%");
        };

        $amount = $this->search;
        
        $invoices = FeeInvoice::where(function ($query) use ($invoices) {
                        $query->whereIn('id',$invoices);
                    })
                    ->where(function ($query) use ($callback, $amount) {
                        $query->whereHas('user', $callback)
                            ->orWhere('amount', 'like', "%{$amount}%");
                    })
                    ->orderBy($this->sortBy, $this->sortDirection)
                    ->paginate($this->perPage);

        return view('livewire.marketplace.fee-invoices.fee-invoice-table', compact('invoices'));
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

    public function showModal(FeeInvoice $invoice){
        //Emitimos al modal edit resource
        if($invoice->amount) {
            //can('user update');
            $this->emit('showModal', $invoice);
        } else {
            //can('user create');
            $this->emit('showModalNewFeeInvoice');
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

    public function deleteFeeInvoice(FeeInvoice $invoice){

        $stripe = new \Stripe\StripeClient(env("STRIPE_SECRET"));

        DB::beginTransaction();
            
        try {

            $user = FeeInvoice::where('stripe_id',$invoice->id)
                            ->where('status','open')
                            ->first();

            $stripe->invoices->voidInvoice(
                $invoice->stripe_id,
                []
              );

            $invoice->delete();

            DB::commit();

        } catch (\Exception $e) {

            $this->dispatchBrowserEvent('swal:modal', [
                'type' =>'warning',
                'title' => 'Fee Invoice error',
                'text' => '',
                ]);

            DB::rollBack();
        }

        $this->render();
    }
}
