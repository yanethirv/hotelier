<div>
    <form wire:submit.prevent="{{$method}}">
        <x-modal-component :showModal="$showModal" :action="$action">
            <h3 class="text-lg leading-6 text-blue-800 ml-4 font-bold" id="modal-title">
                {{$action}} Hotel
            </h3>
            <div class="mt-2">

                <div class="grid grid-cols-1 mt-5 mx-7">
                    <x-input-component label="Name" name="name" placeholder="Enter name" type="text" />
                </div>
    
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mt-5 mx-7">
                    <div class="grid grid-cols-1">
                        <x-input-select-component label="Room Range" name="room_range_id" 
                        :options="$roomRanges"/>
                    </div>
                    <div class="grid grid-cols-1">
                        <x-input-select-component label="Category" name="category_id" 
                                :options="$categories"/>
                    </div>
                </div>

                <div class="grid grid-cols-1 mt-5 mx-7">
                    <x-input-text-component label="Description" name="description" placeholder="Enter description" />
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-5 md:gap-8 mt-5 mx-7">
                    <div class="grid grid-cols-1">
                        <x-input-component label="Stars" name="stars" placeholder="Enter starts" type="text" />
                    </div>
                    <div class="grid grid-cols-1">
                        <x-input-component label="Opening Date" name="opening_date" placeholder="Enter opening date" type="text" />
                    </div>
                    <div class="grid grid-cols-1">
                        <x-input-component label="Floor Number" name="floor_number" placeholder="Enter floor number" type="text" />
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-5 md:gap-8 mt-5 mx-7">
                    <div class="grid grid-cols-1">
                        <x-input-select-component label="Country" name="country_id" 
                        :options="$countries"/>
                    </div>
                    <div class="grid grid-cols-1">
                        <x-input-component label="City" name="city" placeholder="Enter city" type="text" />
                    </div>
                    <div class="grid grid-cols-1">
                        <x-input-component label="State" name="state" placeholder="Enter state" type="text" />
                    </div>
                </div>

                <div class="grid grid-cols-1 mt-5 mx-7">
                    <x-input-text-component label="Address" name="address" placeholder="Enter address" />
                </div>

                <div class="grid grid-cols-1 mt-5 mx-7">
                    <label for="logo" class="block text-md font-semibold pt-4 mx-4">
                        <span class="text-gray-700 dark:text-gray-400">Logo</span>
                        <input type="file" wire:model="logo" id="{{$iterator}}" placeholder="Enter logo"
                            class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-blue-400 focus:outline-none focus:shadow-outline-blue dark:text-gray-300 dark:focus:shadow-outline-gray form-input" />
                    </label>
                    @if ($errors->has('logo'))
                        <small class="text-red-600 ml-4">{{$errors->first('logo')}}</small>        
                    @endif

                    <div wire:loading wire:target="logo" class="block pt-4 m-4 bg-teal-100 border border-teal-400 text-teal-700 px-4 py-3 rounded relative" role="alert">
                        <strong class="font-bold">Uploading logo!</strong>
                        <span class="block sm:inline">Wait a moment...</span>
                    </div>
                </div>

                <div class="grid grid-cols-1 mt-5 mx-7">
                    <label for="Experiences" class="block text-md font-semibold pt-4 mx-4">Experiences</label>
                    <!-- This is the tags container -->       
                    <div class='m-2 flex flex-wrap'>
                        @foreach ($experienceList as $e)
                            <span class="m-1 bg-blue-200 hover:bg-blue-300 rounded-full px-2 font-bold text-sm leading-loose cursor-none">
                                {{$e->name}}
                            </span>
                        @endforeach
                    </div>
                </div>

                <div class="grid grid-cols-1 mx-7">
                    <label for="experience" class="block text-sm pt-2 mx-4">
                        <select wire:model="experiences_check" class="form-multiselect block w-full mt-1 text-sm" multiple>
                            @foreach ($experiences as $key => $option)
                                <option value="{{$key}}">{{$option}}</option>
                            @endforeach
                        </select>
                    </label>
                </div>

                <div class="grid grid-cols-1 mt-5 mx-7">
                    <label for="Amenities" class="block text-md font-semibold pt-4 mx-4">Amenities</label>
                    <!-- This is the tags container -->       
                    <div class='m-2 flex flex-wrap'>
                        @foreach ($amenityList as $a)
                            <span class="m-1 bg-blue-200 hover:bg-blue-300 rounded-full px-2 font-bold text-sm leading-loose cursor-none">
                                {{$a->name}}
                            </span>
                        @endforeach
                    </div>
                </div>

                <div class="grid grid-cols-1 mx-7">
                    <label for="amenity" class="block text-sm pt-2 mx-4">
                        <select wire:model="amenities_check" class="form-multiselect block w-full mt-1 text-sm" multiple>
                            @foreach ($amenities as $key => $option)
                                <option value="{{$key}}">{{$option}}</option>
                            @endforeach
                        </select>
                    </label>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-5 md:gap-8 mt-5 mx-7">
                    <div class="grid grid-cols-1">
                        <x-input-component label="Instagram" name="instagram" placeholder="Enter instagram" type="text" />
                    </div>
                    <div class="grid grid-cols-1">
                        <x-input-component label="Facebook" name="facebook" placeholder="Enter facebook" type="text" />
                    </div>
                    <div class="grid grid-cols-1">
                        <x-input-component label="LinkedIn" name="linkedin" placeholder="Enter linkedin" type="text" />
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mt-5 mx-7">
                    <div class="grid grid-cols-1">
                        <x-input-component label="Youtube" name="youtube" placeholder="Enter youtube" type="text" />
                    </div>
                    <div class="grid grid-cols-1">
                        <x-input-component label="Twitter" name="twitter" placeholder="Enter twitter" type="text" />
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mt-5 mx-7">
                    <div class="grid grid-cols-1">
                        <x-input-component label="Front Desk Phone" name="frontdesk_phone" placeholder="Enter phone" type="text" />
                    </div>
                    <div class="grid grid-cols-1">
                        <x-input-component label="Front Desk Email" name="frontdesk_email" placeholder="Enter email" type="text" />
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mt-5 mx-7">
                    <div class="grid grid-cols-1">
                        <x-input-component label="Reservation Phone" name="reservation_phone" placeholder="Enter phone" type="text" />
                    </div>
                    <div class="grid grid-cols-1">
                        <x-input-component label="Reservation Email" name="reservation_email" placeholder="Enter email" type="text" />
                    </div>
                </div>

                <div class="grid grid-cols-1 mt-5 mx-7">
                    <x-input-component label="Billing Email" name="billing_email" placeholder="Enter email" type="text" />
                </div>
            
            </div>
        </x-modal-component>
    </form>
</div>