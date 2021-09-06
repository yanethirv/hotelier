<x-app-layout title="Services-Buy Now">
    <div class="container grid py-6 mx-auto">
        @slot('header')
            Services-Buy Now
        @endslot

        @livewire('marketplace.services.service-list')
    </div>
</x-app-layout>