<x-app-layout title="Products">
    <div class="container grid px-6 mx-auto mb-6">

        @slot('header')
            Products
        @endslot

        @livewire('admin.products.product-table')

    </div>
    @push('modals')

        @livewire('admin.products.modal-product')

    @endpush
</x-app-layout>