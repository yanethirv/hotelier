<x-app-layout title="Billing">
    <div class="container grid px-6 mx-auto">

        @slot('header')
            Billing
        @endslot

        <div class="h-screen antialiased">

            @livewire('marketplace.payment-method-create')

            <div class="my-8">
                @livewire('marketplace.payment-method-list')
            </div>

            <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                Invoices
            </h2>

            @livewire('marketplace.invoices')  
            
        </div>

    </div>
</x-app-layout>
