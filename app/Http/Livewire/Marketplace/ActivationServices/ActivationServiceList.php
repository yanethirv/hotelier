<?php

namespace App\Http\Livewire\Marketplace\ActivationServices;

use App\Events\Marketplace\ActivationServiceRequestEvent;
use App\Mail\Marketplace\ActivationServiceRequestAdminMail;
use App\Mail\Marketplace\ActivationServiceRequestMail;
use App\Models\ActivationService;
use App\Models\ActivationServiceTransaction;
use App\Models\ActivationStatus;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class ActivationServiceList extends Component
{
    public function render()
    {
        $activationServices = ActivationService::orderBy('type_id', 'asc')->get();

        $userActivationServices = auth()->user()->activationServiceTransactions;

        return view('livewire.marketplace.activation-services.activation-service-list', compact('activationServices', 'userActivationServices'));
    }

    public function sendActivation(ActivationService $activationService){

       DB::beginTransaction();

        try{
            $activationServiceTransaction = new ActivationServiceTransaction();
            $activationServiceTransaction->user_id = auth()->user()->id;
            $activationServiceTransaction->activation_service_id = $activationService->id;
            $activationServiceTransaction->save();

            $activationStatus = new ActivationStatus();
            $activationStatus->activation_service_transaction_id = $activationServiceTransaction->id;
            $activationStatus->save();

            //Mail::to(auth()->user()->email)
            //->queue(new ActivationServiceRequestMail($activationServiceTransaction));

            //Mail::to('admin@hotelierhub.test')
            //        ->queue(new ActivationServiceRequestAdminMail($activationServiceTransaction));

            event(new ActivationServiceRequestEvent($activationServiceTransaction));
            
            $this->dispatchBrowserEvent('swal:modal', [
                'type' =>'success',
                'title' => 'Request send successfully',
                'text' => '',
            ]);

            $this->reset();

            DB::commit();

        } catch (Exception $e){

            $this->dispatchBrowserEvent('swal:modal', [
                'type' =>'warning',
                'title' => 'Request failed',
                'text' => '',
                ]);
            
            DB::rollback();
        }
    }
}
