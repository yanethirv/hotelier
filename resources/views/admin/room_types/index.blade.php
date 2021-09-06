<x-app-layout title="Room Types">
    <div class="container grid px-6 mx-auto mb-6">

        @slot('header')
        Room Types
        @endslot
        @livewire('admin.room-types.room-type-table')
    </div>
    @push('modals')
        @livewire('admin.room-types.modal-room-type')
    @endpush
</x-app-layout>