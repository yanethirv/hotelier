<x-app-layout title="Rooms">
    <div class="container grid px-6 mx-auto mb-6">
        @slot('header')
            Rooms
        @endslot
        @livewire('hotel.rooms.room-table')
    </div>
    @push('modals')
        @livewire('hotel.rooms.modal-room')
    @endpush
</x-app-layout>