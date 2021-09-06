<div class="grid my-8 gap-8 grid-cols-1 lg:grid-cols-2">

    @if ($property == NULL)
        <div class="self-center">
            <span class="text-red-500 text-lg"><i class="fas fa-exclamation-circle"></i> Add a Hotel</span>
        </div>
        <div class="flex-shrink-0 ml-2">
          <a href="{{route('hotels.index')}}" class="flex items-center font-medium text-blue-500 hover:text-blue-600 dark:text-blue-400 dark:hover:text-blue-500" style="outline: none;">
            Go to Hotel<span><svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor" class="transform transition-transform duration-500 ease-in-out"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg></span>
          </a>
        </div>
    @endif

    @if (!$property == NULL)
        @if ($property->room_range_id == 1)
            {{-- BASIC --}}
            <div class="flex flex-col">
                <div class="bg-white shadow-md  rounded-lg p-4 dark:bg-gray-800">
                    <div class="flex-none lg:flex">
                        <div class="flex-auto ml-3 justify-evenly py-2">
                            <x-card-basic-plan />
                            <div class="py-6 px-6 text-center lg:flex-shrink-0 lg:flex lg:flex-col lg:justify-center lg:p-12">
                                <p class="text-lg leading-6 font-bold text-gray-700 dark:text-white">
                                    PRICE
                                </p>
                                <div class="mt-4 flex items-center justify-center text-5xl leading-none font-extrabold text-gray-700 dark:text-white">
                                    <span>
                                        $99/mo
                                    </span>
                                </div>
                                <div class="mt-6">
                                    @livewire('subscription-pay', ['price' => "price_1IyPjxHURPMCL8WRynNtDqa0", 'name' => "Rooms 1-30", 'amount' => "99"], key("price_1IyPjxHURPMCL8WRynNtDqa0"))
                                    {{--@livewire('subscription-pay', ['price' => "price_1JLF4uBtsoHKHDBCMEejhkyA", 'name' => "Rooms 1-30"], key("price_1JLF4uBtsoHKHDBCMEejhkyA"))--}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- EXPERT --}}
            <div class="flex flex-col">
                <div class="bg-white shadow-md  rounded-lg p-4 dark:bg-gray-800">
                    <div class="flex-none lg:flex">
                        <div class="flex-auto ml-3 justify-evenly py-2">
                            <x-card-expert-plan />
                            <div class="py-6 px-6 text-center lg:flex-shrink-0 lg:flex lg:flex-col lg:justify-center lg:p-12">
                                <p class="text-lg leading-6 font-bold text-gray-700 dark:text-white">
                                    PRICE
                                </p>
                                <div class="mt-4 flex items-center justify-center text-5xl leading-none font-extrabold text-gray-700 dark:text-white">
                                    <span>
                                        $125/mo
                                    </span>
                                </div>
                                <div class="mt-6">
                                    @livewire('subscription-pay', ['price' => "price_1IyPjxHURPMCL8WR821o09mW", 'name' => "Rooms 1-30", 'amount' => "125"], key("price_1IyPjxHURPMCL8WR821o09mW"))
                                    {{--@livewire('subscription-pay', ['price' => "price_1JLF4uBtsoHKHDBCgqc8m8dB", 'name' => "Rooms 1-30"], key("price_1JLF4uBtsoHKHDBCgqc8m8dB"))--}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- PRO --}}
            <div class="flex flex-col">
                <div class="bg-white shadow-md  rounded-lg p-4 dark:bg-gray-800">
                    <div class="flex-none lg:flex">
                        <div class="flex-auto ml-3 justify-evenly py-2">
                            <x-card-pro-plan />
                            <div class="py-6 px-6 text-center lg:flex-shrink-0 lg:flex lg:flex-col lg:justify-center lg:p-12">
                                <p class="text-lg leading-6 font-bold text-gray-700 dark:text-white">
                                    PRICE
                                </p>
                                <div class="mt-4 flex items-center justify-center text-5xl leading-none font-extrabold text-gray-700 dark:text-white">
                                    <span>
                                        $198/mo
                                    </span>
                                </div>
                                <div class="mt-6">
                                    @livewire('subscription-pay', ['price' => "price_1IyPjyHURPMCL8WR1B0UUmU1", 'name' => "Rooms 1-30", 'amount' => "198"], key("price_1IyPjyHURPMCL8WR1B0UUmU1"))
                                    {{--@livewire('subscription-pay', ['price' => "price_1JLF4uBtsoHKHDBCxBKlLVTt", 'name' => "Rooms 1-30"], key("price_1JLF4uBtsoHKHDBCxBKlLVTt"))--}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if ($property->room_range_id == 2)
            {{-- BASIC --}}
            <div class="flex flex-col">
                <div class="bg-white shadow-md  rounded-lg p-4 dark:bg-gray-800">
                    <div class="flex-none lg:flex">
                        <div class="flex-auto ml-3 justify-evenly py-2">
                            <x-card-basic-plan />
                            <div class="py-6 px-6 text-center lg:flex-shrink-0 lg:flex lg:flex-col lg:justify-center lg:p-12">
                                <p class="text-lg leading-6 font-bold text-gray-700 dark:text-white">
                                    PRICE
                                </p>
                                <div class="mt-4 flex items-center justify-center text-5xl leading-none font-extrabold text-gray-700 dark:text-white">
                                    <span>
                                        $115/mo
                                    </span>
                                </div>
                                <div class="mt-6">
                                    @livewire('subscription-pay', ['price' => "price_1IyPlHHURPMCL8WRUPmfEgOh", 'name' => "Rooms 31-51", 'amount' => "115"], key("price_1IyPlHHURPMCL8WRUPmfEgOh"))
                                    {{--@livewire('subscription-pay', ['price' => "price_1JLFDJBtsoHKHDBC2wHQcaMa", 'name' => "Rooms 31-51"], key("price_1JLFDJBtsoHKHDBC2wHQcaMa"))--}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- EXPERT --}}
            <div class="flex flex-col">
                <div class="bg-white shadow-md  rounded-lg p-4 dark:bg-gray-800">
                    <div class="flex-none lg:flex">
                        <div class="flex-auto ml-3 justify-evenly py-2">
                            <x-card-expert-plan />
                            <div class="py-6 px-6 text-center lg:flex-shrink-0 lg:flex lg:flex-col lg:justify-center lg:p-12">
                                <p class="text-lg leading-6 font-bold text-gray-700 dark:text-white">
                                    PRICE
                                </p>
                                <div class="mt-4 flex items-center justify-center text-5xl leading-none font-extrabold text-gray-700 dark:text-white">
                                    <span>
                                        $140/mo
                                    </span>
                                </div>
                                <div class="mt-6">
                                    @livewire('subscription-pay', ['price' => "price_1IyPlHHURPMCL8WRjQpvLABD", 'name' => "Rooms 31-51", 'amount' => "140"], key("price_1IyPlHHURPMCL8WRjQpvLABD"))
                                    {{--@livewire('subscription-pay', ['price' => "price_1JLFDJBtsoHKHDBC6ZLaxKiv", 'name' => "Rooms 31-51"], key("price_1JLFDJBtsoHKHDBC6ZLaxKiv"))--}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- PRO --}}
            <div class="flex flex-col">
                <div class="bg-white shadow-md  rounded-lg p-4 dark:bg-gray-800">
                    <div class="flex-none lg:flex">
                        <div class="flex-auto ml-3 justify-evenly py-2">
                            <x-card-pro-plan />
                            <div class="py-6 px-6 text-center lg:flex-shrink-0 lg:flex lg:flex-col lg:justify-center lg:p-12">
                                <p class="text-lg leading-6 font-bold text-gray-700 dark:text-white">
                                    PRICE
                                </p>
                                <div class="mt-4 flex items-center justify-center text-5xl leading-none font-extrabold text-gray-700 dark:text-white">
                                    <span>
                                        $210/mo
                                    </span>
                                </div>
                                <div class="mt-6">
                                    @livewire('subscription-pay', ['price' => "price_1IyPlHHURPMCL8WR7Yj9g95r", 'name' => "Rooms 31-51", 'amount' => "210"], key("price_1IyPlHHURPMCL8WR7Yj9g95r"))
                                    {{--@livewire('subscription-pay', ['price' => "price_1JLFDJBtsoHKHDBCbyTfXH6T", 'name' => "Rooms 31-51"], key("price_1JLFDJBtsoHKHDBCbyTfXH6T"))--}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if ($property->room_range_id == 3)
            {{-- BASIC --}}
            <div class="flex flex-col">
                <div class="bg-white shadow-md  rounded-lg p-4 dark:bg-gray-800">
                    <div class="flex-none lg:flex">
                        <div class="flex-auto ml-3 justify-evenly py-2">
                            <x-card-basic-plan />
                            <div class="py-6 px-6 text-center lg:flex-shrink-0 lg:flex lg:flex-col lg:justify-center lg:p-12">
                                <p class="text-lg leading-6 font-bold text-gray-700 dark:text-white">
                                    PRICE
                                </p>
                                <div class="mt-4 flex items-center justify-center text-5xl leading-none font-extrabold text-gray-700 dark:text-white">
                                    <span>
                                        $120/mo
                                    </span>
                                </div>
                                <div class="mt-6">
                                    @livewire('subscription-pay', ['price' => "price_1IyPmBHURPMCL8WRdS81Y52l", 'name' => "Rooms 52-74", 'amount' => "120"], key("price_1IyPmBHURPMCL8WRdS81Y52l"))
                                    {{--@livewire('subscription-pay', ['price' => "price_1JLFGSBtsoHKHDBCRoVLlEKm", 'name' => "Rooms 52-74"], key("price_1JLFGSBtsoHKHDBCRoVLlEKm"))--}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- EXPERT --}}
            <div class="flex flex-col">
                <div class="bg-white shadow-md  rounded-lg p-4 dark:bg-gray-800">
                    <div class="flex-none lg:flex">
                        <div class="flex-auto ml-3 justify-evenly py-2">
                            <x-card-expert-plan />
                            <div class="py-6 px-6 text-center lg:flex-shrink-0 lg:flex lg:flex-col lg:justify-center lg:p-12">
                                <p class="text-lg leading-6 font-bold text-gray-700 dark:text-white">
                                    PRICE
                                </p>
                                <div class="mt-4 flex items-center justify-center text-5xl leading-none font-extrabold text-gray-700 dark:text-white">
                                    <span>
                                        $150/mo
                                    </span>
                                </div>
                                <div class="mt-6">
                                    @livewire('subscription-pay', ['price' => "price_1IyPmBHURPMCL8WRjPGgItKA", 'name' => "Rooms 52-74", 'amount' => "150"], key("price_1IyPmBHURPMCL8WRjPGgItKA"))
                                    {{--@livewire('subscription-pay', ['price' => "price_1JLFGSBtsoHKHDBCz1w63oTe", 'name' => "Rooms 52-74"], key("price_1JLFGSBtsoHKHDBCz1w63oTe"))--}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- PRO --}}
            <div class="flex flex-col">
                <div class="bg-white shadow-md  rounded-lg p-4 dark:bg-gray-800">
                    <div class="flex-none lg:flex">
                        <div class="flex-auto ml-3 justify-evenly py-2">
                            <x-card-pro-plan />
                            <div class="py-6 px-6 text-center lg:flex-shrink-0 lg:flex lg:flex-col lg:justify-center lg:p-12">
                                <p class="text-lg leading-6 font-bold text-gray-700 dark:text-white">
                                    PRICE
                                </p>
                                <div class="mt-4 flex items-center justify-center text-5xl leading-none font-extrabold text-gray-700 dark:text-white">
                                    <span>
                                        $230/mo
                                    </span>
                                </div>
                                <div class="mt-6">
                                    @livewire('subscription-pay', ['price' => "price_1IyPmBHURPMCL8WRYwr6gFba", 'name' => "Rooms 52-74", 'amount' => "230"], key("price_1IyPmBHURPMCL8WRYwr6gFba"))
                                    {{--@livewire('subscription-pay', ['price' => "price_1JLFGSBtsoHKHDBCqucCQnxE", 'name' => "Rooms 52-74"], key("price_1JLFGSBtsoHKHDBCqucCQnxE"))--}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if ($property->room_range_id == 4)
            {{-- BASIC --}}
            <div class="flex flex-col">
                <div class="bg-white shadow-md  rounded-lg p-4 dark:bg-gray-800">
                    <div class="flex-none lg:flex">
                        <div class="flex-auto ml-3 justify-evenly py-2">
                            <x-card-basic-plan />
                            <div class="py-6 px-6 text-center lg:flex-shrink-0 lg:flex lg:flex-col lg:justify-center lg:p-12">
                                <p class="text-lg leading-6 font-bold text-gray-700 dark:text-white">
                                    PRICE
                                </p>
                                <div class="mt-4 flex items-center justify-center text-5xl leading-none font-extrabold text-gray-700 dark:text-white">
                                    <span>
                                        $125/mo
                                    </span>
                                </div>
                                <div class="mt-6">
                                    @livewire('subscription-pay', ['price' => "price_1IyPnsHURPMCL8WRzaScblvP", 'name' => "Rooms 75-150", 'amount' => "125"], key("price_1IyPnsHURPMCL8WRzaScblvP"))
                                    {{--@livewire('subscription-pay', ['price' => "price_1JLFIuBtsoHKHDBCK2mlxx8J", 'name' => "Rooms 75-150"], key("price_1JLFIuBtsoHKHDBCK2mlxx8J"))--}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- EXPERT --}}
            <div class="flex flex-col">
                <div class="bg-white shadow-md  rounded-lg p-4 dark:bg-gray-800">
                    <div class="flex-none lg:flex">
                        <div class="flex-auto ml-3 justify-evenly py-2">
                            <x-card-expert-plan />
                            <div class="py-6 px-6 text-center lg:flex-shrink-0 lg:flex lg:flex-col lg:justify-center lg:p-12">
                                <p class="text-lg leading-6 font-bold text-gray-700 dark:text-white">
                                    PRICE
                                </p>
                                <div class="mt-4 flex items-center justify-center text-5xl leading-none font-extrabold text-gray-700 dark:text-white">
                                    <span>
                                        $160/mo
                                    </span>
                                </div>
                                <div class="mt-6">
                                    @livewire('subscription-pay', ['price' => "price_1IyPnsHURPMCL8WRBJcKBJPe", 'name' => "Rooms 75-150", 'amount' => "160"], key("price_1IyPnsHURPMCL8WRBJcKBJPe"))
                                    {{--@livewire('subscription-pay', ['price' => "price_1JLFIuBtsoHKHDBCYbebtEyT", 'name' => "Rooms 75-150"], key("price_1JLFIuBtsoHKHDBCYbebtEyT"))--}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- PRO --}}
            <div class="flex flex-col">
                <div class="bg-white shadow-md  rounded-lg p-4 dark:bg-gray-800">
                    <div class="flex-none lg:flex">
                        <div class="flex-auto ml-3 justify-evenly py-2">
                            <x-card-pro-plan />
                            <div class="py-6 px-6 text-center lg:flex-shrink-0 lg:flex lg:flex-col lg:justify-center lg:p-12">
                                <p class="text-lg leading-6 font-bold text-gray-700 dark:text-white">
                                    PRICE
                                </p>
                                <div class="mt-4 flex items-center justify-center text-5xl leading-none font-extrabold text-gray-700 dark:text-white">
                                    <span>
                                        $250/mo
                                    </span>
                                </div>
                                <div class="mt-6">
                                    @livewire('subscription-pay', ['price' => "price_1IyPnsHURPMCL8WR0kjwlXgf", 'name' => "Rooms 75-150", 'amount' => "250"], key("price_1IyPnsHURPMCL8WR0kjwlXgf"))
                                    {{--@livewire('subscription-pay', ['price' => "price_1JLFIuBtsoHKHDBCYyV9urJ0", 'name' => "Rooms 75-150"], key("price_1JLFIuBtsoHKHDBCYyV9urJ0"))--}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if ($property->room_range_id == 5)
            {{-- BASIC --}}
            <div class="flex flex-col">
                <div class="bg-white shadow-md  rounded-lg p-4 dark:bg-gray-800">
                    <div class="flex-none lg:flex">
                        <div class="flex-auto ml-3 justify-evenly py-2">
                            <x-card-basic-plan />
                            <div class="py-6 px-6 text-center lg:flex-shrink-0 lg:flex lg:flex-col lg:justify-center lg:p-12">
                                <p class="text-lg leading-6 font-bold text-gray-700 dark:text-white">
                                    PRICE
                                </p>
                                <div class="mt-4 flex items-center justify-center text-5xl leading-none font-extrabold text-gray-700 dark:text-white">
                                    <span>
                                        $189/mo
                                    </span>
                                </div>
                                <div class="mt-6">
                                    @livewire('subscription-pay', ['price' => "price_1IyPqUHURPMCL8WRmASIsup8", 'name' => "Rooms 151-299", 'amount' => "189"], key("price_1IyPqUHURPMCL8WRmASIsup8"))
                                    {{--@livewire('subscription-pay', ['price' => "price_1JLFLUBtsoHKHDBCBhQjIxYf", 'name' => "Rooms 151-299"], key("price_1JLFLUBtsoHKHDBCBhQjIxYf"))--}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- EXPERT --}}
            <div class="flex flex-col">
                <div class="bg-white shadow-md  rounded-lg p-4 dark:bg-gray-800">
                    <div class="flex-none lg:flex">
                        <div class="flex-auto ml-3 justify-evenly py-2">
                            <x-card-expert-plan />
                            <div class="py-6 px-6 text-center lg:flex-shrink-0 lg:flex lg:flex-col lg:justify-center lg:p-12">
                                <p class="text-lg leading-6 font-bold text-gray-700 dark:text-white">
                                    PRICE
                                </p>
                                <div class="mt-4 flex items-center justify-center text-5xl leading-none font-extrabold text-gray-700 dark:text-white">
                                    <span>
                                        $225/mo
                                    </span>
                                </div>
                                <div class="mt-6">
                                    @livewire('subscription-pay', ['price' => "price_1IyPqUHURPMCL8WR7v1lD4Tu", 'name' => "Rooms 151-299", 'amount' => "225"], key("price_1IyPqUHURPMCL8WR7v1lD4Tu"))
                                    {{--@livewire('subscription-pay', ['price' => "price_1JLFLUBtsoHKHDBC22uPGZfJ", 'name' => "Rooms 151-299"], key("price_1JLFLUBtsoHKHDBC22uPGZfJ"))--}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- PRO --}}
            <div class="flex flex-col">
                <div class="bg-white shadow-md  rounded-lg p-4 dark:bg-gray-800">
                    <div class="flex-none lg:flex">
                        <div class="flex-auto ml-3 justify-evenly py-2">
                            <x-card-pro-plan />
                            <div class="py-6 px-6 text-center lg:flex-shrink-0 lg:flex lg:flex-col lg:justify-center lg:p-12">
                                <p class="text-lg leading-6 font-bold text-gray-700 dark:text-white">
                                    PRICE
                                </p>
                                <div class="mt-4 flex items-center justify-center text-5xl leading-none font-extrabold text-gray-700 dark:text-white">
                                    <span>
                                        $378/mo
                                    </span>
                                </div>
                                <div class="mt-6">
                                    @livewire('subscription-pay', ['price' => "price_1IyPqUHURPMCL8WRpAp8Ba0R", 'name' => "Rooms 151-299", 'amount' => "378"], key("price_1IyPqUHURPMCL8WRpAp8Ba0R"))
                                    {{--@livewire('subscription-pay', ['price' => "price_1JLFLUBtsoHKHDBCfagWJMOI", 'name' => "Rooms 151-299"], key("price_1JLFLUBtsoHKHDBCfagWJMOI"))--}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if ($property->room_range_id == 6)
            {{-- BASIC --}}
            <div class="flex flex-col">
                <div class="bg-white shadow-md  rounded-lg p-4 dark:bg-gray-800">
                    <div class="flex-none lg:flex">
                        <div class="flex-auto ml-3 justify-evenly py-2">
                            <x-card-basic-plan />
                            <div class="py-6 px-6 text-center lg:flex-shrink-0 lg:flex lg:flex-col lg:justify-center lg:p-12">
                                <p class="text-lg leading-6 font-bold text-gray-700 dark:text-white">
                                    PRICE
                                </p>
                                <div class="mt-4 flex items-center justify-center text-5xl leading-none font-extrabold text-gray-700 dark:text-white">
                                    <span>
                                        $275/mo
                                    </span>
                                </div>
                                <div class="mt-6">
                                    @livewire('subscription-pay', ['price' => "price_1IyPrgHURPMCL8WRlaGxNtR7", 'name' => "Rooms 300 +", 'amount' => "275"], key("price_1IyPrgHURPMCL8WRlaGxNtR7"))
                                    {{--@livewire('subscription-pay', ['price' => "price_1JLFOHBtsoHKHDBCKahKnN1g", 'name' => "Rooms 300 +"], key("price_1JLFOHBtsoHKHDBCKahKnN1g"))--}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- EXPERT --}}
            <div class="flex flex-col">
                <div class="bg-white shadow-md  rounded-lg p-4 dark:bg-gray-800">
                    <div class="flex-none lg:flex">
                        <div class="flex-auto ml-3 justify-evenly py-2">
                            <x-card-expert-plan />
                            <div class="py-6 px-6 text-center lg:flex-shrink-0 lg:flex lg:flex-col lg:justify-center lg:p-12">
                                <p class="text-lg leading-6 font-bold text-gray-700 dark:text-white">
                                    PRICE
                                </p>
                                <div class="mt-4 flex items-center justify-center text-5xl leading-none font-extrabold text-gray-700 dark:text-white">
                                    <span>
                                        $300/mo
                                    </span>
                                </div>
                                <div class="mt-6">
                                    @livewire('subscription-pay', ['price' => "price_1IyPrgHURPMCL8WRiqjaFRyC", 'name' => "Rooms 300 +", 'amount' => "300"], key("price_1IyPrgHURPMCL8WRiqjaFRyC"))
                                    {{--@livewire('subscription-pay', ['price' => "price_1JLFOHBtsoHKHDBCrPiXCvYC", 'name' => "Rooms 300 +"], key("price_1JLFOHBtsoHKHDBCrPiXCvYC"))--}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- PRO --}}
            <div class="flex flex-col">
                <div class="bg-white shadow-md  rounded-lg p-4 dark:bg-gray-800">
                    <div class="flex-none lg:flex">
                        <div class="flex-auto ml-3 justify-evenly py-2">
                            <x-card-pro-plan />
                            <div class="py-6 px-6 text-center lg:flex-shrink-0 lg:flex lg:flex-col lg:justify-center lg:p-12">
                                <p class="text-lg leading-6 font-bold text-gray-700 dark:text-white">
                                    PRICE
                                </p>
                                <div class="mt-4 flex items-center justify-center text-5xl leading-none font-extrabold text-gray-700 dark:text-white">
                                    <span>
                                        $550/mo
                                    </span>
                                </div>
                                <div class="mt-6">
                                    @livewire('subscription-pay', ['price' => "price_1IyPrgHURPMCL8WRgQEVMK0j", 'name' => "Rooms 300 +", 'amount' => "550"], key("price_1IyPrgHURPMCL8WRgQEVMK0j"))
                                    {{--@livewire('subscription-pay', ['price' => "price_1JLFOHBtsoHKHDBC2MHLjtkP", 'name' => "Rooms 300 +"], key("price_1JLFOHBtsoHKHDBC2MHLjtkP"))--}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endif

</div>