<x-app-layout title="Resources">
    <div class="container grid px-6 mx-auto mb-6">

        @slot('header')
            Resources
        @endslot

        @livewire('admin.resources.resource-table')

    </div>
    @push('modals')
        @livewire('admin.resources.modal-resource')
    @endpush
</x-app-layout>