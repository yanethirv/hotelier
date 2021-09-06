<x-app-layout title="Restaurant Locations">
    <div class="container grid px-6 mx-auto mb-6">

        @slot('header')
        Restaurant Locations
        @endslot
        @livewire('admin.restaurant-locations.restaurant-location-table')
    </div>
    @push('modals')
        @livewire('admin.restaurant-locations.modal-restaurant-location')
    @endpush
</x-app-layout>