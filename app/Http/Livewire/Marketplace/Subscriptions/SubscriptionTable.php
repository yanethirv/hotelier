<?php

namespace App\Http\Livewire\Marketplace\Subscriptions;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class SubscriptionTable extends Component
{
    
    public function render()
    {
        $property = Auth::user()->properties->first();

        return view('livewire.marketplace.subscriptions.subscription-table', compact('property'));
    }
}
