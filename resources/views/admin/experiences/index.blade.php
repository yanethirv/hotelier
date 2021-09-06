<x-app-layout title="Experiences">
    <div class="container grid px-6 mx-auto mb-6">

        @slot('header')
        Experiences
        @endslot
        @livewire('admin.experiences.experience-table')
    </div>
    @push('modals')
        @livewire('admin.experiences.modal-experience')
    @endpush
</x-app-layout>