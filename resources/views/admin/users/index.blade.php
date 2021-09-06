<x-app-layout title="Users">
    <div class="container grid px-6 mx-auto">

        @slot('header')
            Users
        @endslot

        @livewire('admin.users.user-table')

    </div>
    @push('modals')

        @livewire('admin.users.modal-user')
        @livewire('admin.roles.add-permission')
        
    @endpush
</x-app-layout>