<div>
    <form wire:submit.prevent="{{$method}}">
        <x-modal-component :showModal="$showModal" :action="$action">
            <h3 class="text-lg leading-6 text-blue-800 ml-4 font-bold" id="modal-title">
                {{$action}} Restaurant
            </h3>
            <div class="mt-2">
                <div>
                    <x-input-component label="Name" name="name" placeholder="Enter name" type="text" />
                </div>
                <div>
                    <x-input-select-component label="Hotel" name="property_id" 
                        :options="$properties"/>
                </div>
                <div>
                    <x-input-select-component label="Restaurant Theme" name="restaurant_theme_id" 
                        :options="$restaurantThemes"/>
                </div>
                <div>
                    <x-input-select-component label="Restaurant Type" name="restaurant_type_id" 
                        :options="$restaurantTypes"/>
                </div>
                <div>
                    <x-input-select-component label="Restaurant Location" name="restaurant_location_id" 
                        :options="$restaurantLocations"/>
                </div>
                <div>
                    <x-input-component label="How Many Pax" name="how_many_pax" placeholder="Enter how many pax" type="text" />
                </div>
                <div>
                    <x-input-component label="Open Time" name="open_time" placeholder="Enter open time" type="text" />
                </div>
                <div>
                    <x-input-component label="Closing Time" name="closing_time" placeholder="Enter closing time" type="text" />
                </div>
                <div>
                    <x-input-component label="Included" name="included" placeholder="Enter" type="text" />
                </div>
            </div>
        </x-modal-component>
    </form>
</div>