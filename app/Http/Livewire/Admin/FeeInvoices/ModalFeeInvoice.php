<?php

namespace App\Http\Livewire\Admin\FeeInvoices;

use App\Http\Requests\RequestFeeInvoice;
use App\Mail\Marketplace\FeeInvoiceCreatedMail;
use App\Mail\Marketplace\FeeInvoicePaidMail;
use App\Models\FeeInvoice;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Illuminate\Support\Str;

class ModalFeeInvoice extends Component
{
    public $showModal = 'hidden';
    public $amount = '';
    public $description = '';
    public $user_id = '';
    public $users = [];
    public $details = '';
    public $invoice;
    public $action = '';
    public $method = '';

    protected $listeners = ['showModal', 'showModalNewFeeInvoice'];

    public function render()
    {
        return view('livewire.admin.fee-invoices.modal-fee-invoice');
    }

    public function hydrate(){

        //$this->users = User::pluck('name', 'id')->toArray();
        $this->users = User::select(DB::raw("CONCAT(name, ' - ', email) AS full_name"),"id")->pluck("full_name","id")->toArray();

    }

    public function showModal(FeeInvoice $invoice)
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->invoice = $invoice;
        $this->amount = $invoice->amount;
        $this->description = $invoice->description;
        $this->details = $invoice->details;
        $this->user_id = $invoice->user()->first()->id ?? '';
        $this->action = 'Pay';
        $this->method = 'updateFeeInvoice';
        $this->showModal = '';
    
    }

    public function closeModal()
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();
    }

    //Update Product
    public function updateFeeInvoice(){

        $stripe = new \Stripe\StripeClient(env("STRIPE_SECRET"));
        $requestFeeInvoice = new RequestFeeInvoice();
        $values = $this->validate($requestFeeInvoice->rules($this->invoice));

        //dd($this->invoice['stripe_id']);
 
        DB::beginTransaction();
            
        try {

            $stripe->invoices->markUncollectible(
                $this->invoice['stripe_id'],
                []
              );
    
            $this->invoice->update([
                'details' => $values['details'],
                'status' => 'paid outside',
            ]);

            $receivers = $this->invoice['customer_email'];
            Mail::to($receivers)->send(new FeeInvoicePaidMail($this->invoice));

            $this->dispatchBrowserEvent('swal:modal', [
                'type' =>'success',
                'title' => 'Fee Invoice pay successfully',
                'text' => '',
            ]);
            DB::commit();

        } catch (\Exception $e) {

            $this->dispatchBrowserEvent('swal:modal', [
                'type' =>'warning',
                'title' => 'Fee Invoice error',
                'text' => '',
                ]);

            DB::rollBack();
        }



        $this->emit('feeInvoiceListUpdated');
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();
    }

    //Validaciones en tiempo real
    public function updated($label){

        $requestFeeInvoice = new RequestFeeInvoice();
        $this->validateOnly($label, $requestFeeInvoice->rules($this->invoice));

    }

    public function showModalNewFeeInvoice(){
        $this->resetErrorBag();
        $this->resetValidation();
        $this->invoice = null;
        $this->action = 'Create';
        $this->method = 'createFeeInvoice';
        $this->showModal = '';
    }

    //Create Fee Invoice
    public function createFeeInvoice(){

        $stripe = new \Stripe\StripeClient(env("STRIPE_SECRET"));
        $requestFeeInvoice = new RequestFeeInvoice();
        $values = $this->validate($requestFeeInvoice->rules(''));

        DB::beginTransaction();
            
        try {
            //Search user
            $codeCustomer = User::find($values['user_id']);
            $amount = Str::replace(',', '.',$values['amount']);

            $invoiceItem =  $stripe->invoiceItems->create([
                'customer' => $codeCustomer->stripe_id,
                'currency' => 'usd',
                //'amount' => 55.50 * 100,
                'amount' => $amount * 100,
                'description' => $values['description'],
            ]);

            $feeInvoiceStripe = $stripe->invoices->create([
                'customer' => $codeCustomer->stripe_id,
                    'auto_advance' => false, /* auto-finalize this draft after ~1 hour */
                    'collection_method' => 'send_invoice',
                    'days_until_due' => 30,
            ]);

            $stripe->invoices->finalizeInvoice(
                $feeInvoiceStripe->id,
                []
            );

            $stripe->invoices->sendInvoice(
                $feeInvoiceStripe->id,
                []
            );

            $invoiceDetail = $stripe->invoices->retrieve(
                $feeInvoiceStripe->id,
                []
            );

            //dd($feeInvoiceStripe);
            $values['stripe_id'] = $invoiceDetail->id;
            $values['customer'] = $invoiceDetail->customer;
            $values['customer_email'] = $invoiceDetail->customer_email;
            $values['hosted_invoice_url'] = $invoiceDetail->hosted_invoice_url;
            $values['invoice_pdf'] = $invoiceDetail->invoice_pdf;
            $values['total'] = $invoiceDetail->total;
            $values['status'] = $invoiceDetail->status;

            $invoice = new FeeInvoice();
            $invoice->fill($values);
            $invoice->save();

            $receivers = $codeCustomer->email;
            Mail::to($receivers)->send(new FeeInvoiceCreatedMail($invoice));

            $this->dispatchBrowserEvent('swal:modal', [
                'type' =>'success',
                'title' => 'Fee Invoice added successfully',
                'text' => '',
            ]);
            DB::commit();

        } catch (\Exception $e) {

            $this->dispatchBrowserEvent('swal:modal', [
                'type' =>'warning',
                'title' => 'Fee Invoice error',
                'text' => '',
                ]);

            DB::rollBack();
        }
   
        $this->emit('feeInvoiceListUpdated');
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();
        $this->closeModal();
    }
}
