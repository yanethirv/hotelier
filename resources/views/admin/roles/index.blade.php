<x-app-layout title="Roles">
    <div class="container grid py-6 mx-auto">

        @slot('header')
            Roles
        @endslot

        @livewire('admin.roles.role-table')

    </div>
    @push('modals')

        @livewire('admin.roles.modal-role')

        @livewire('admin.roles.add-permission')

    @endpush

</x-app-layout>