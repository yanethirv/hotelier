<x-app-layout title="Invoices">
    <div class="container grid py-6 mx-auto">

        @slot('header')
            Invoices
        @endslot

        <div class="h-screen antialiased">

            @livewire('marketplace.invoices.invoice-list')  
            
        </div>

    </div>
</x-app-layout>