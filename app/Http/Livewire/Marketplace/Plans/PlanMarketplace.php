<?php

namespace App\Http\Livewire\Marketplace\Plans;

use App\Models\Plan;
use Livewire\Component;

class PlanMarketplace extends Component
{
    public function render()
    {
        $plans = Plan::all();

        return view('livewire.marketplace.plans.plan-marketplace', compact('plans'));
    }
}