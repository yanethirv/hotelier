<x-app-layout title="Services">
    <div class="container grid px-6 mx-auto mb-6">

        @slot('header')
        Services
        @endslot
        @livewire('admin.services.service-table')
    </div>
    @push('modals')
        @livewire('admin.services.modal-service')
    @endpush
</x-app-layout>