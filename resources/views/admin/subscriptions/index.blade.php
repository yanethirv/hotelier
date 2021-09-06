<x-app-layout title="Subscriptions">
    <div class="container grid px-6 mx-auto mb-6">

        @slot('header')
            Subscriptions
        @endslot

        @livewire('admin.subscriptions.subscription-table')

    </div>
    @push('modals')

        @livewire('admin.subscriptions.modal-subscription')

    @endpush
</x-app-layout>