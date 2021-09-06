<x-app-layout title="Activation Services">
    <div class="container grid py-6 mx-auto">
        @slot('header')
            Activation Services
        @endslot

        @livewire('marketplace.activation-services.activation-service-list')
    </div>
</x-app-layout>