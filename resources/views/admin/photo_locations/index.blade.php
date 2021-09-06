<x-app-layout title="Photo Locations">
    <div class="container grid px-6 mx-auto mb-6">

        @slot('header')
        Photo Locations
        @endslot
        @livewire('admin.photo-locations.photo-location-table')
    </div>
    @push('modals')
        @livewire('admin.photo-locations.modal-photo-location')
    @endpush
</x-app-layout>