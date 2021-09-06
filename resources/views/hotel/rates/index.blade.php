<x-app-layout title="Rates">
    <div class="container grid px-6 mx-auto mb-6">

        @slot('header')
        Rates
        @endslot
        @livewire('hotel.rates.rate-table')
    </div>
    @push('modals')
        @livewire('hotel.rates.modal-rate')
    @endpush
</x-app-layout>