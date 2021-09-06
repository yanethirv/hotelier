<x-app-layout title="Fee Invoices">
    <div class="container grid px-6 mx-auto mb-6">

        @slot('header')
            Fee Invoices
        @endslot

        @livewire('admin.fee-invoices.fee-invoice-table')

    </div>
    @push('modals')

        @livewire('admin.fee-invoices.modal-fee-invoice')

    @endpush
</x-app-layout>