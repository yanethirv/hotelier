<x-app-layout title="Payment">

    <div class="container grid px-6 mx-auto">

        @slot('header')
            Payment
        @endslot

        <div class="grid mt-8  gap-8 grid-cols-1 lg:grid-cols-2">
                <div class="flex flex-col">
                    <div class="bg-white shadow-md  rounded-lg p-4 dark:bg-gray-800">
                        <div class="flex-none lg:flex">
                            <div class="flex-auto ml-3 justify-evenly py-2">
                                <div class="flex flex-wrap ">
                                    <h2 class="flex-auto text-xl font-bold dark:text-gray-400 uppercase">{{$service->name}}</h2>
                                    <p class="dark:text-gray-400 py-4">{{Str::limit($service->description, 300)}}</p>
                                </div>
                                <div class="flex py-2  text-sm text-gray-600">
                                    <div class="flex-1 inline-flex items-center">
                                        <p class="text-indigo-700 dark:text-purple-500 text-2xl font-bold">{{$service->price}} USD</p>
                                    </div>
                                    <div class="flex-1 inline-flex items-center">
                                        <span class="dark:text-purple-500">
                                       
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col">
                    @livewire('service-pay', ['service' => $service])
                </div>
        </div>
    </div>
</x-app-layout>