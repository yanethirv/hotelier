<x-app-layout title="Services Requests">
    <div class="container grid py-6 mx-auto">
        @slot('header')
            Services Requests
        @endslot

        @livewire('request-management.services-requests.service-request-table')
    </div>
    @push('modals')
        @livewire('request-management.services-requests.modal-service-request')
    @endpush
</x-app-layout>