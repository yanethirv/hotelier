<x-app-layout title="Launch" header="Launch">
    <div class="container grid py-6 mx-auto">
        
        @slot('header')
            Launch
        @endslot

        @livewire('launch.launch')

    </div>
</x-app-layout>