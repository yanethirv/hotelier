<x-app-layout title="Categories">
    <div class="container grid px-6 mx-auto mb-6">

        @slot('header')
        Categories
        @endslot
        @livewire('admin.categories.category-table')
    </div>
    @push('modals')
        @livewire('admin.categories.modal-category')
    @endpush
</x-app-layout>