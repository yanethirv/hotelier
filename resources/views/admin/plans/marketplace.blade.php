<x-app-layout title="Plans">
    <div class="container grid px-6 mx-auto mb-6">

        @slot('header')
            Plans
        @endslot

        @livewire('admin.plans.plan-marketplace')

    </div>

</x-app-layout>