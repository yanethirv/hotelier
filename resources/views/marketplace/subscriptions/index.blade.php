<x-app-layout title="Subscriptions">
    <div class="container grid px-6 mx-auto">

        @slot('header')
            Subscriptions
        @endslot
        
        @livewire('marketplace.subscriptions.subscription-table')
    
    </div>
        
</x-app-layout>