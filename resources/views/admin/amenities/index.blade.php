<x-app-layout title="Amenities">
    <div class="container grid px-6 mx-auto mb-6">

        @slot('header')
            Amenities
        @endslot

        @livewire('admin.amenities.amenity-table')

    </div>
    @push('modals')
        @livewire('admin.amenities.modal-amenity')
    @endpush
</x-app-layout>