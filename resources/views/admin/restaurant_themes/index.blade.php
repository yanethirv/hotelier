<x-app-layout title="Restaurant Themes">
    <div class="container grid px-6 mx-auto mb-6">

        @slot('header')
        Restaurant Themes
        @endslot
        @livewire('admin.restaurant-themes.restaurant-theme-table')
    </div>
    @push('modals')
        @livewire('admin.restaurant-themes.modal-restaurant-theme')
    @endpush
</x-app-layout>