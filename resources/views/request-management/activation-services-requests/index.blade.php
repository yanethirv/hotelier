<x-app-layout title="Activation Services Requests">
    <div class="container grid py-6 mx-auto">
        @slot('header')
            Activation Services Requests
        @endslot

        @livewire('request-management.activation-services-requests.activation-service-request-table')
    </div>
    @push('modals')
    
        @livewire('request-management.activation-services-requests.modal-activation-service-request')
     
    @endpush
</x-app-layout>