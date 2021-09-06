<x-app-layout title="Documents">
    <div class="container grid px-6 mx-auto mb-6">

        @slot('header')
            Documents
        @endslot
        @livewire('hotel.documents.document-table')
    </div>
    @push('modals')
        @livewire('hotel.documents.modal-document')
    @endpush
</x-app-layout>