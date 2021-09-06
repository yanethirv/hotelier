<div>
    <x-modal-view :modalDetails="$modalDetails" :action="$action">
        <div class="w-full lg:w-7/12 bg-white p-5 rounded-lg lg:rounded-l-none">
            <div class="flex justify-center">
                <div class="flex">
                    <h1 class="text-gray-600 font-bold md:text-2xl text-xl">Hotel {{$action}}</h1>
                </div>
            </div>
              
            {{--<div class="grid grid-cols-1 mt-5 mx-7"></div>--}}
              
            <div class="grid grid-cols-1 mt-5 mx-7">
                <label class="mb-2 uppercase md:text-sm text-sm text-gray-700 font-bold">Hotel name</label>
                <span class="text-blue-600 text-light">{{$name}}</span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mt-5 mx-7">
                <div class="grid grid-cols-1">
                    <label class="mb-2 uppercase md:text-sm text-sm text-gray-700 font-bold">Room Range</label>
                    <select wire:model="room_range_id" class="block w-full border-none text-blue-600 text-light form-select" disabled>
                        @foreach ($roomRanges as $key => $option)
                            <option value="{{$key}}">{{$option}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="grid grid-cols-1">
                    <label class="mb-2 uppercase md:text-sm text-sm text-gray-700 font-bold">Category</label>
                    <select wire:model="category_id" class="block w-full border-none text-blue-600 text-light form-select" disabled>
                        @foreach ($categories as $key => $option)
                            <option value="{{$key}}">{{$option}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 mt-5 mx-7">
                <label class="mb-2 uppercase md:text-sm text-sm text-gray-700 font-bold">Description</label>
                <span class="text-blue-600 text-light">{{$description}}</span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-5 md:gap-8 mt-5 mx-7">
                <div class="grid grid-cols-1">
                    <label class="mb-2 uppercase md:text-sm text-sm text-gray-700 font-bold">Stars</label>
                    <span class="text-blue-600 text-light">{{$stars}}</span>
                </div>
                <div class="grid grid-cols-1">
                    <label class="mb-2 uppercase md:text-sm text-sm text-gray-700 font-bold">Opening Date</label>
                    <span class="text-blue-600 text-light">{{$opening_date}}</span>
                </div>
                <div class="grid grid-cols-1">
                    <label class="mb-2 uppercase md:text-sm text-sm text-gray-700 font-bold">Floor Number</label>
                    <span class="text-blue-600 text-light">{{$floor_number}}</span>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-5 md:gap-8 mt-5 mx-7">
                <div class="grid grid-cols-1">
                    <label class="mb-2 uppercase md:text-sm text-sm text-gray-700 font-bold">Country</label>
                    <select wire:model="country_id" class="block w-full border-none text-blue-600 text-light form-select" disabled>
                        @foreach ($countries as $key => $option)
                            <option value="{{$key}}">{{$option}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="grid grid-cols-1">
                    <label class="mb-2 uppercase md:text-sm text-sm text-gray-700 font-bold">City</label>
                    <span class="text-blue-600 text-light">{{$city}}</span>
                </div>
                <div class="grid grid-cols-1">
                    <label class="mb-2 uppercase md:text-sm text-sm text-gray-700 font-bold">State</label>
                    <span class="text-blue-600 text-light">{{$state}}</span>
                </div>
            </div>

            <div class="grid grid-cols-1 mt-5 mx-7">
                <label class="mb-2 uppercase md:text-sm text-sm text-gray-700 font-bold">Address</label>
                <span class="text-blue-600 text-light">{{$address}}</span>
            </div>

            <div class="grid grid-cols-1 mt-5 mx-7">
                <label class="mb-2 uppercase md:text-sm text-sm text-gray-700 font-bold">Experiences</label>
                <div class='my-3 flex flex-wrap -m-1'>
                    @foreach ($experienceList as $e)
                        <span class="m-1 bg-blue-200 hover:bg-blue-300 rounded-full px-2 font-bold text-sm leading-loose cursor-none">
                                {{$e->name}}
                        </span>
                    @endforeach
                </div>
            </div>

            <div class="grid grid-cols-1 mt-5 mx-7">
                <label class="mb-2 uppercase md:text-sm text-sm text-gray-700 font-bold">Amenities</label>
                <div class='my-3 flex flex-wrap -m-1'>
                    @foreach ($amenityList as $a)
                        <span class="m-1 bg-blue-200 hover:bg-blue-300 rounded-full px-2 font-bold text-sm leading-loose cursor-none">
                                {{$a->name}}
                        </span>
                    @endforeach
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-5 md:gap-8 mt-5 mx-7">
                <div class="grid grid-cols-1">
                    <label class="mb-2 uppercase md:text-sm text-sm text-gray-700 font-bold">Instagram</label>
                    <span class="text-blue-600 text-light">{{$instagram}}</span>
                </div>
                <div class="grid grid-cols-1">
                    <label class="mb-2 uppercase md:text-sm text-sm text-gray-700 font-bold">Facebook</label>
                    <span class="text-blue-600 text-light">{{$facebook}}</span>
                </div>
                <div class="grid grid-cols-1">
                    <label class="mb-2 uppercase md:text-sm text-sm text-gray-700 font-bold">LinkedIn</label>
                    <span class="text-blue-600 text-light">{{$linkedin}}</span>
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mt-5 mx-7">
                <div class="grid grid-cols-1">
                    <label class="mb-2 uppercase md:text-sm text-sm text-gray-700 font-bold">Youtube</label>
                    <span class="text-blue-600 text-light">{{$youtube}}</span>
                </div>
                <div class="grid grid-cols-1">
                    <label class="mb-2 uppercase md:text-sm text-sm text-gray-700 font-bold">Twitter</label>
                    <span class="text-blue-600 text-light">{{$twitter}}</span>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mt-5 mx-7">
                <div class="grid grid-cols-1">
                    <label class="mb-2 uppercase md:text-sm text-sm text-gray-700 font-bold">Front Desk Phone</label>
                    <span class="text-blue-600 text-light">{{$frontdesk_phone}}</span>
                </div>
                <div class="grid grid-cols-1">
                    <label class="mb-2 uppercase md:text-sm text-sm text-gray-700 font-bold">Front Desk Email</label>
                    <span class="text-blue-600 text-light">{{$frontdesk_email}}</span>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mt-5 mx-7">
                <div class="grid grid-cols-1">
                    <label class="mb-2 uppercase md:text-sm text-sm text-gray-700 font-bold">Reservation Phone</label>
                    <span class="text-blue-600 text-light">{{$reservation_phone}}</span>
                </div>
                <div class="grid grid-cols-1">
                    <label class="mb-2 uppercase md:text-sm text-sm text-gray-700 font-bold">Reservation Email</label>
                    <span class="text-blue-600 text-light">{{$reservation_email}}</span>
                </div>
            </div>

            <div class="grid grid-cols-1 mt-5 mx-7">
                <label class="mb-2 uppercase md:text-sm text-sm text-gray-700 font-bold">Billing Email</label>
                <span class="text-blue-600 text-light">{{$billing_email}}</span>
            </div>
            {{--<div class="pt-4 mx-4">
                <span class="text-md font-semibold text-gray-700 dark:text-gray-400">Experiences</span>
                <!-- This is the tags container -->       
                <div class='my-3 flex flex-wrap -m-1'>
                    @if (!$logo == '')
                        {{$logo}}
                    @endif
                </div>
            </div>--}}
        </div>
    </x-modal-view>
</div>