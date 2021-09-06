<x-app-layout title="Occupancies">
    <div class="container grid px-6 mx-auto mb-6">

        @slot('header')
        Occupancies
        @endslot
        @livewire('admin.occupancies.occupancy-table')
    </div>
    @push('modals')
        @livewire('admin.occupancies.modal-occupancy')
    @endpush
</x-app-layout>