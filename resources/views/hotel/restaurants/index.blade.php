<x-app-layout title="Restaurants">
    <div class="container grid px-6 mx-auto mb-6">
        @slot('header')
        Restaurants
        @endslot
        @livewire('hotel.restaurants.restaurant-table')
    </div>
    @push('modals')
        @livewire('hotel.restaurants.modal-restaurant')
    @endpush
</x-app-layout>