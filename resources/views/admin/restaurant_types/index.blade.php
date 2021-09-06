<x-app-layout title="Restaurant Types">
    <div class="container grid px-6 mx-auto mb-6">

        @slot('header')
        Restaurant Types
        @endslot
        @livewire('admin.restaurant-types.restaurant-type-table')
    </div>
    @push('modals')
        @livewire('admin.restaurant-types.modal-restaurant-type')
    @endpush
</x-app-layout>