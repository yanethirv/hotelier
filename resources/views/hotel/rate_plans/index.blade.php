<x-app-layout title="Rate Plans">
    <div class="container grid px-6 mx-auto mb-6">

        @slot('header')
        Rate Plans
        @endslot
        @livewire('hotel.rate-plans.rate-plan-table')
    </div>
    @push('modals')
        @livewire('hotel.rate-plans.modal-rate-plan')
    @endpush
</x-app-layout>