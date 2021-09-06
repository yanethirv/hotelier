<x-app-layout title="Plans">
    <div class="container grid px-6 mx-auto">

        @slot('header')
            Plans
        @endslot

        <div class="grid mt-8 gap-8 grid-cols-1 lg:grid-cols-2">

            <div class="flex flex-col">
                <div class="bg-white shadow-md  rounded-lg p-4 dark:bg-gray-800">
                    <div class="flex-none lg:flex">
                        <div class="flex-auto ml-3 justify-evenly py-2">
                            
                            <div class="flex flex-wrap ">
                                <h3 class="text-xl leading-8 font-semibold text-gray-700 sm:text-3xl sm:leading-9 dark:text-gray-400">
                                    REVENUE MANAGEMENT AND SALES EXPERT
                                </h3>
                                {{--<p class="dark:text-gray-400 py-4"></p>--}}
                            </div>
                            
                            <div class="mt-4">
                                <div class="flex items-center">
                                    <h4 class="flex-shrink-0 pr-4 bg-white dark:bg-gray-800 text-sm leading-5 tracking-wider font-semibold uppercase text-indigo-600">
                                        DESCRIPTION
                                    </h4>
                                    <div class="flex-1 border-t-2 border-gray-200">
                                    </div>
                                </div>
                                <ul class="mt-4">
                                    <li class="flex items-start lg:col-span-1 mt-2">
                                        <div class="flex-shrink-0">
                                            <x-icon-check />
                                        </div>
                                        <p class="ml-3 text-sm leading-5 text-gray-700 dark:text-gray-200">
                                            8 sessions of 1 hours with a hotel revenue manager expert per month.
                                        </p>
                                    </li>
                                </ul>
                            </div>

                            <div class="px-6 text-center lg:flex-shrink-0 lg:flex lg:flex-col lg:justify-center lg:p-12">
                                <p class="text-lg leading-6 font-bold text-gray-700 dark:text-white">
                                    PRICE
                                </p>
                                <div class="mt-4 flex items-center justify-center text-4xl leading-none font-extrabold text-gray-700 dark:text-white">
                                    <span>
                                        $500/mo
                                    </span>
                                </div>
                                <div class="mt-6">
                                   {{-- boton --}}
                                   @livewire('marketplace.subscriptions', ['price' => "price_1Iz8OXHURPMCL8WR25b79CC3", 'name' => "REVENUE MANAGEMENT AND SALES EXPERT", 'amount' => "500"], key("price_1Iz8OXHURPMCL8WR25b79CC3"))
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex flex-col">
                <div class="bg-white shadow-md  rounded-lg p-4 dark:bg-gray-800">
                    <div class="flex-none lg:flex">
                        <div class="flex-auto ml-3 justify-evenly py-2">
                            
                            <div class="flex flex-wrap ">
                                <h3 class="text-xl leading-8 font-semibold text-gray-700 sm:text-3xl sm:leading-9 dark:text-gray-400">
                                    PAYMENT PROCESSOR VIRTUAL TERMINAL
                                </h3>
                                {{--<p class="dark:text-gray-400 py-4"></p>--}}
                            </div>
                            
                            <div class="mt-4">
                                <div class="flex items-center">
                                    <h4 class="flex-shrink-0 pr-4 bg-white dark:bg-gray-800 text-sm leading-5 tracking-wider font-semibold uppercase text-indigo-600">
                                        DESCRIPTION
                                    </h4>
                                    <div class="flex-1 border-t-2 border-gray-200">
                                    </div>
                                </div>
                                <ul class="mt-4">
                                    <li class="flex items-start lg:col-span-1 mt-2">
                                        <div class="flex-shrink-0">
                                            <x-icon-check />
                                        </div>
                                        <p class="ml-3 text-sm leading-5 text-gray-700 dark:text-gray-200">
                                            Request access to the payment processor virtual terminal plus 5% credit card transaction fee.
                                        </p>
                                    </li>
                                    <li class="flex items-start lg:col-span-1 mt-2">
                                        <p class="ml-3 text-sm leading-5 text-gray-700 dark:text-gray-200">
                                            *International transfer to bank account applied please ask your account manager.
                                        </p>
                                    </li>
                                </ul>
                            </div>

                            <div class="px-6 text-center lg:flex-shrink-0 lg:flex lg:flex-col lg:justify-center lg:p-12">
                                <p class="text-lg leading-6 font-bold text-gray-700 dark:text-white">
                                    PRICE
                                </p>
                                <div class="mt-4 flex items-center justify-center text-4xl leading-none font-extrabold text-gray-700 dark:text-white">
                                    <span>
                                        $50/month
                                    </span>
                                </div>
                                <div class="mt-6">
                                   {{-- boton --}}
                                   @livewire('marketplace.subscriptions', ['price' => "price_1Iz8bEHURPMCL8WRjABNwWNM", 'name' => "PAYMENT PROCESSOR VIRTUAL TERMINAL", 'amount' => "50"], key("price_1Iz8bEHURPMCL8WRjABNwWNM"))
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex flex-col">
                <div class="bg-white shadow-md  rounded-lg p-4 dark:bg-gray-800">
                    <div class="flex-none lg:flex">
                        <div class="flex-auto ml-3 justify-evenly py-2">
                            
                            <div class="flex flex-wrap ">
                                <h3 class="text-xl leading-8 font-semibold text-gray-700 sm:text-3xl sm:leading-9 dark:text-gray-400">
                                    REVENUE MANAGEMENT SYSTEM
                                </h3>
                                {{--<p class="dark:text-gray-400 py-4"></p>--}}
                            </div>
                            
                            <div class="mt-4">
                                <div class="flex items-center">
                                    <h4 class="flex-shrink-0 pr-4 bg-white dark:bg-gray-800 text-sm leading-5 tracking-wider font-semibold uppercase text-indigo-600">
                                        DESCRIPTION
                                    </h4>
                                    <div class="flex-1 border-t-2 border-gray-200">
                                    </div>
                                </div>
                                <ul class="mt-4">
                                    <li class="flex items-start lg:col-span-1 mt-2">
                                        <div class="flex-shrink-0">
                                            <x-icon-check />
                                        </div>
                                        <p class="ml-3 text-sm leading-5 text-gray-700 dark:text-gray-200">
                                            Have you ever wondered if there’s a smart solution to choose the best rates for your rooms? Octorate’s Revenue Management System was designed in collaboration with HotelPro360 to help increase your revenue in a simple and accessible way.
                                        </p>
                                    </li>
                                </ul>
                            </div>

                            <div class="px-6 text-center lg:flex-shrink-0 lg:flex lg:flex-col lg:justify-center lg:p-12">
                                <p class="text-lg leading-6 font-bold text-gray-700 dark:text-white">
                                    PRICE
                                </p>
                                <div class="mt-4 flex items-center justify-center text-4xl leading-none font-extrabold text-gray-700 dark:text-white">
                                    <span>
                                        $79/month
                                    </span>
                                </div>
                                <div class="mt-6">
                                   {{-- boton --}}
                                   @livewire('marketplace.subscriptions', ['price' => "price_1Iz8bhHURPMCL8WRQyOMotXB", 'name' => "REVENUE MANAGEMENT SYSTEM", 'amount' => "79"], key("price_1Iz8bhHURPMCL8WRQyOMotXB"))
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex flex-col">
                <div class="bg-white shadow-md  rounded-lg p-4 dark:bg-gray-800">
                    <div class="flex-none lg:flex">
                        <div class="flex-auto ml-3 justify-evenly py-2">
                            
                            <div class="flex flex-wrap ">
                                <h3 class="text-xl leading-8 font-semibold text-gray-700 sm:text-3xl sm:leading-9 dark:text-gray-400">
                                    CHAT
                                </h3>
                                {{--<p class="dark:text-gray-400 py-4"></p>--}}
                            </div>
                            
                            <div class="mt-4">
                                <div class="flex items-center">
                                    <h4 class="flex-shrink-0 pr-4 bg-white dark:bg-gray-800 text-sm leading-5 tracking-wider font-semibold uppercase text-indigo-600">
                                        DESCRIPTION
                                    </h4>
                                    <div class="flex-1 border-t-2 border-gray-200">
                                    </div>
                                </div>
                                <ul class="mt-4">
                                    <li class="flex items-start lg:col-span-1 mt-2">
                                        <div class="flex-shrink-0">
                                            <x-icon-check />
                                        </div>
                                        <p class="ml-3 text-sm leading-5 text-gray-700 dark:text-gray-200">
                                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis, deleniti quidem? Excepturi fuga.
                                    </li>
                                </ul>
                            </div>

                            <div class="px-6 text-center lg:flex-shrink-0 lg:flex lg:flex-col lg:justify-center lg:p-12">
                                <p class="text-lg leading-6 font-bold text-gray-700 dark:text-white">
                                    PRICE
                                </p>
                                <div class="mt-4 flex items-center justify-center text-4xl leading-none font-extrabold text-gray-700 dark:text-white">
                                    <span>
                                        $15/month
                                    </span>
                                </div>
                                <div class="mt-6">
                                   {{-- boton --}}
                                   @livewire('marketplace.subscriptions', ['price' => "price_1Iz99EHURPMCL8WRi4wxtIYu", 'name' => "CHAT", 'amount' => "15"], key("price_1Iz99EHURPMCL8WRi4wxtIYu"))
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        
</x-app-layout>