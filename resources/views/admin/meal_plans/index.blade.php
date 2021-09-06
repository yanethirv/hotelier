<x-app-layout title="Meal Plans">
    <div class="container grid px-6 mx-auto mb-6">

        @slot('header')
        Meal Plans
        @endslot
        @livewire('admin.meal-plans.meal-plan-table')
    </div>
    @push('modals')
        @livewire('admin.meal-plans.modal-meal-plan')
    @endpush
</x-app-layout>