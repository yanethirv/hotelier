<x-app-layout title="Plans Requests">
    <div class="container grid py-6 mx-auto">
        @slot('header')
            Plans Requests
        @endslot

        @livewire('request-management.plans-requests.plan-request-table')
    </div>
    @push('modals')
        @livewire('request-management.plans-requests.modal-plan-request')
    @endpush
</x-app-layout>