<?php

namespace App\Http\Livewire\Marketplace\Services;

use App\Models\Service;
use Livewire\Component;

class ServiceList extends Component
{
    public function render()
    {
        $services = Service::orderBy('type_id', 'asc')->get();
        $userServices = auth()->user()->servicesTransactions;

        return view('livewire.marketplace.services.service-list', compact('services', 'userServices'));
    }
}
