<?php

namespace App\Http\Livewire\Marketplace\PaymentMethods;

use Livewire\Component;

class PaymentMethodCreate extends Component
{
    
    protected $listeners = ['paymentMethodCreate' => 'paymentMethodCreate'];

    public function render()
    {
        $this->emit('resetStripe');
        
        return view('livewire.marketplace.payment-methods.payment-method-create', [
            'intent' => auth()->user()->createSetupIntent()
        ]);
    }

    public function paymentMethodCreate($paymentMethod){

        try{

            if (auth()->user()->hasPaymentMethod()) {

                auth()->user()->addPaymentMethod($paymentMethod);

            }else{

                auth()->user()->updateDefaultPaymentMethod($paymentMethod);
                
            }

            $this->dispatchBrowserEvent('swal:modal', [
                'type' =>'success',
                'title' => 'Method add successfully',
                'text' => '',
            ]);

        } catch (Exception $e){

            $this->dispatchBrowserEvent('swal:modal', [
                'type' =>'warning',
                'title' => 'Method failed',
                'text' => '',
                ]);

        }

        $this->emitTo('marketplace.payment-methods.payment-method-list', 'render');

        $this->emitTo('subscription-pay', 'render');
    }
}
