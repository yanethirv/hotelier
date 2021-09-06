<div class="grid mt-8 gap-8 grid-cols-1 lg:grid-cols-2">
  
    @foreach ($plans as $plan)
        <div class="flex flex-col">
            <div class="bg-white shadow-md  rounded-lg p-4 dark:bg-gray-800">
                <div class="flex-none lg:flex">
                    <div class="flex-auto ml-3 justify-evenly py-2">
                        
                        <div class="flex flex-wrap ">
                            <h3 class="text-xl leading-8 font-semibold text-gray-700 sm:text-3xl sm:leading-9 dark:text-gray-400">
                                {{$plan->nickname}}
                            </h3>
                            {{--<p class="dark:text-gray-400 py-4"></p>--}}
                        </div>
                        
                        <div class="mt-4">
                            <div class="flex items-center">
                                <h4 class="flex-shrink-0 pr-4 bg-white dark:bg-gray-800 text-sm leading-5 tracking-wider font-semibold uppercase text-blue-600">
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
                                       {{$plan->description}}
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
                                    ${{$plan->amount}}/mo
                                </span>
                            </div>
                            <div class="mt-6">
                            {{-- boton --}}
                            @livewire('plan-pay', ['price' => $plan->stripe_id, 'name' => $plan->nickname, 'amount' => $plan->amount], key($plan->stripe_id))
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

</div>