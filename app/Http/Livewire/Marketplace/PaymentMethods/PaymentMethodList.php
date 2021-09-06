<?php

namespace App\Http\Livewire\Marketplace\PaymentMethods;

use Livewire\Component;

class PaymentMethodList extends Component
{
    protected $listeners = ['render' => 'render']; //o también protected $listeners = ['render'];

    public function render()
    {
        $paymentMethods = auth()->user()->paymentMethods();

        return view('livewire.marketplace.payment-methods.payment-method-list', compact('paymentMethods'));

    }


    public function defaultPaymentMethod($paymentMethodId){

        auth()->user()->updateDefaultPaymentMethod($paymentMethodId);

        $this->dispatchBrowserEvent('swal:modal', [
            'type' =>'success',
            'title' => 'Method marked as default',
            'text' => '',
        ]);
        
    }

    public function deletePaymentMethod($paymentMethodId){

        $paymentMethod = auth()->user()->findPaymentMethod($paymentMethodId);

        $paymentMethod->delete();

        $this->dispatchBrowserEvent('swal:modal', [
            'type' =>'success',
            'title' => 'Method has been deleted',
            'text' => '',
        ]);

    }
}
