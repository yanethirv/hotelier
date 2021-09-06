<?php

namespace App\Http\Livewire\Admin\Subscriptions;

use Livewire\Component;

class SubscriptionTable extends Component
{

    public function render()
    {
        $stripe = new \Stripe\StripeClient(env("STRIPE_SECRET"));

        //$this->info = $stripe->subscriptions->all();
        //$this->info = $stripe->products->all(['limit' => 30, 'active' => true]);
        $prices = $stripe->prices->all(['limit' => 30, 'active' => true]);

        $result = $stripe->plans->create([
            'amount' => 96600,
            'currency' => 'usd',
            'interval' => 'month',
            'product' => 'prod_Jbz9OypH73vKXT',
          ]);

        dd($result->id);

        return view('livewire.admin.subscriptions.subscription-table', compact('prices'));
    }

    
}
