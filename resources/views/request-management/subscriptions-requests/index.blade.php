<x-app-layout title="Subscriptions Requests">
    <div class="container grid py-6 mx-auto">
        @slot('header')
            Subscriptions Requests
        @endslot

        @livewire('request-management.subscriptions-requests.subscription-request-table')
    </div>
    @push('modals')
        @livewire('request-management.subscriptions-requests.modal-subscription-request')
    @endpush
</x-app-layout>