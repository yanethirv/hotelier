<x-app-layout title="Room Ranges">
    <div class="container grid px-6 mx-auto mb-6">

        @slot('header')
            Room Ranges
        @endslot

        @livewire('admin.room-ranges.room-range-table')

    </div>
    @push('modals')

        @livewire('admin.room-ranges.modal-room-range')

    @endpush
</x-app-layout>