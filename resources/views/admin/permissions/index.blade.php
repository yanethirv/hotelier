<x-app-layout title="Permissions">
    <div class="container grid py-6 mx-auto">

        @slot('header')
            Permissions
        @endslot

        @livewire('admin.permissions.permission-table')

    </div>
    @push('modals')

        @livewire('admin.permissions.modal-permission')

    @endpush
</x-app-layout>