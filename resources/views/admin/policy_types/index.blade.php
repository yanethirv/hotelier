<x-app-layout title="Policy Types">
    <div class="container grid px-6 mx-auto mb-6">

        @slot('header')
        Policy Types
        @endslot
        @livewire('admin.policy-types.policy-type-table')
    </div>
    @push('modals')
        @livewire('admin.policy-types.modal-policy-type')
    @endpush
</x-app-layout>