<?php

namespace App\Http\Livewire\Marketplace\Services;

use App\Events\Marketplace\ServiceRequestEvent;
use App\Models\Service;
use App\Models\ServiceStatus;
use App\Models\ServicesTransaction;
use Livewire\Component;
use Exception;
use Illuminate\Support\Facades\DB;

class ServicePay extends Component
{

    public $service;

    protected $listeners = ['paymentMethodCreate'];

    public function mount(Service $service){

        $this->service = $service;
    }

    public function render()
    {
        return view('livewire.marketplace.services.service-pay');
    }

    public function paymentMethodCreate($paymentMethod){

        DB::beginTransaction();

        try{

            $test = auth()->user()->charge($this->service->price * 100, $paymentMethod, [
                'description' => $this->service->name]);

            auth()->user()->invoiceFor($this->service->name, $this->service->price * 100);

            $servicesTransaction = new ServicesTransaction();
            $servicesTransaction->user_id = auth()->user()->id;
            $servicesTransaction->service_id = $this->service->id;
            $servicesTransaction->save();


            $serviceStatus = new ServiceStatus();
            $serviceStatus->services_transaction_id = $servicesTransaction->id;
            $serviceStatus->save();

            $this->emit('resetStripe');

            event(new ServiceRequestEvent($servicesTransaction));

            $this->dispatchBrowserEvent('swal:modal', [
                    'type' =>'success',
                    'title' => 'Your payment was successfully processed',
                    'text' => '',
            ]);
                
            DB::commit();

        } catch (Exception $e){

            $this->dispatchBrowserEvent('swal:modal', [
                'type' =>'warning',
                'title' => 'Your payment failed',
                'text' => '',
            ]);
            
            DB::rollback();

        }

            // Here, complete the order, like, send a notification email
            //$user->notify(new OrderProcessed($product)); 
    }
}
