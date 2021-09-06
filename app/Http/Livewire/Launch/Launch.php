<?php

namespace App\Http\Livewire\Launch;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Launch extends Component
{
    public function render()
    {

        $subscription = Auth::user()->subscriptionsTransactions->first();

        $property = Auth::user()->properties->first();

        return view('livewire.launch.launch', compact('property', 'subscription'));
    }
}
