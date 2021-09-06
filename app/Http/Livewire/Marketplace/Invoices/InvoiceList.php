<?php

namespace App\Http\Livewire\Marketplace\Invoices;

use Livewire\Component;

class InvoiceList extends Component
{
    protected $listeners = ['render'];

    public function render()
    {
        $invoices = auth()->user()->invoices();

        return view('livewire.marketplace.invoices.invoice-list', compact('invoices'));
    }
}