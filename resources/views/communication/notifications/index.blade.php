<x-app-layout title="Notifications">
    <div class="container grid px-6 mx-auto mb-6">

        @slot('header')
            Notifications
        @endslot

        @livewire('communication.notifications.notification-table')

    </div>
</x-app-layout>