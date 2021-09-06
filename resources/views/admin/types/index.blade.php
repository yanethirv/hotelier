<x-app-layout title="Types">
    <div class="container grid px-6 mx-auto mb-6">

        @slot('header')
        Types
        @endslot
        @livewire('admin.types.type-table')
    </div>
    @push('modals')
        @livewire('admin.types.modal-type')
    @endpush
</x-app-layout>