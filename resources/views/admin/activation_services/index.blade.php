<x-app-layout title="Activation Services">
    <div class="container grid px-6 mx-auto mb-6">

        @slot('header')
            Activation Services
        @endslot

        @livewire('admin.activation-services.activation-service-table')

    </div>
    @push('modals')

        @livewire('admin.activation-services.modal-activation-service')
        
    @endpush
</x-app-layout>