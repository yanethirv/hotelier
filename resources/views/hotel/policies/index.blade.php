<x-app-layout title="Policies">
    <div class="container grid px-6 mx-auto mb-6">

        @slot('header')
            Policies
        @endslot
        @livewire('hotel.policies.policy-table')
    </div>
    @push('modals')
        @livewire('hotel.policies.modal-policy')
    @endpush
</x-app-layout>