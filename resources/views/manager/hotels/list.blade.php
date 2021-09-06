<x-app-layout title="Hotels">
    <div class="container grid px-6 mx-auto mb-6">
        @slot('header')
            Hotels
        @endslot
        @livewire('manager.hotels.hotel-list')
    </div>
    @push('modals')
        @livewire('manager.hotels.modal-hotel')
    @endpush
</x-app-layout>