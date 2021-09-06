<x-app-layout title="Payment Methods">
    <div class="container grid px-6 mx-auto">

        @slot('header')
            Payment Methods
        @endslot

        <div class="h-screen antialiased">

            @livewire('marketplace.payment-methods.payment-method-create')

            <div class="my-8">
                @livewire('marketplace.payment-methods.payment-method-list')
            </div>

        </div>

    </div>
</x-app-layout>
