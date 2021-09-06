<x-app-layout title="Payment">
    <div class="container grid py-6 mx-auto">

        @slot('header')
            Payment
        @endslot

        <div class="grid mt-8  gap-8 grid-cols-1 lg:grid-cols-2">
                <div class="flex flex-col">
                    <div class="bg-white shadow-md  rounded-lg p-4 dark:bg-gray-800">
                        <div class="flex-none lg:flex">
                            <div class="flex-auto ml-3 justify-evenly py-2">
                                <div class="flex flex-wrap ">
                                    <div class="w-full flex-none text-sm text-indigo-600 font-semibold dark:text-indigo-400 uppercase">
                                        {{$service->type->name}}
                                    </div>
                                    <h3 class="text-2xl leading-8 font-extrabold text-gray-700 sm:text-3xl sm:leading-9 dark:text-gray-400">
                                        {{$service->name}}
                                    </h3>
                                    <p class="dark:text-gray-400 py-4"></p>
                                </div>
                                
                                <div class="mt-4">
                                    <div class="flex items-center">
                                        <h4 class="flex-shrink-0 pr-4 bg-white dark:bg-gray-800 text-sm leading-5 tracking-wider font-semibold uppercase text-gray-500">
                                            Description
                                        </h4>
                                        <div class="flex-1 border-t-2 border-gray-200">
                                        </div>
                                    </div>
                                    <p class="ml-3 py-4 text-medium leading-5 text-gray-700 dark:text-gray-200">
                                        {{$service->description}}
                                    </p>
                                    <p class="text-indigo-700 dark:text-purple-500 text-2xl font-bold">{{$service->price}} USD</p>
                                </div>
                                <div class="flex space-x-3 text-sm font-medium pt-4">
                                    <div class="flex-auto flex space-x-3">
                                    </div>
                                    <a href="{{ route('services') }}" class="cursor-pointer mb-2 md:mb-0 bg-teal-100 px-5 py-2 shadow-sm tracking-wider text-teal-600 rounded-lg hover:bg-teal-200">
                                        Return to Services
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col">
                    @livewire('marketplace.services.service-pay', ['service' => $service])
                </div>
        </div>
    </div>
</x-app-layout> 