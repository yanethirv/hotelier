<x-app-layout title="Hotels">
    <div class="container grid px-6 mx-auto mb-6">
        @slot('header')
            Hotels
        @endslot
        @livewire('hotel.hotels.hotel-table')
    </div>
    @push('modals')
        @livewire('hotel.hotels.modal-hotel')
        @livewire('hotel.hotels.modal-hotel-details')
    @endpush
</x-app-layout>