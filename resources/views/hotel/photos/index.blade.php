<x-app-layout title="Photos">
    <div class="container grid px-6 mx-auto mb-6">
        @slot('header')
        Photos
        @endslot
        @livewire('hotel.photos.photo-table')
    </div>
    @push('modals')
        @livewire('hotel.photos.modal-photo')
    @endpush
</x-app-layout>