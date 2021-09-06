<div>
    <form wire:submit.prevent="{{$method}}">
        <x-modal-component :showModal="$showModal" :action="$action">
            <h3 class="text-lg leading-6 text-blue-800 ml-4 font-bold" id="modal-title">
                {{$action}} Room
            </h3>
            <div class="mt-2">
                <div>
                    <x-input-component label="Code" name="code" placeholder="Enter code" type="text" />
                </div>
                <div>
                    <x-input-select-component label="Hotel" name="property_id" 
                        :options="$properties"/>
                </div>
                <div>
                    <x-input-select-component label="Room Type" name="room_type_id" 
                        :options="$roomTypes"/>
                </div>
                <div>
                    <x-input-select-component label="Occupancy" name="occupancy_id" 
                        :options="$occupancies"/>
                </div>
                <div>
                    <x-input-component label="Floor" name="floor" placeholder="Enter floor" type="text" />
                </div>
                <div>
                    <x-input-component label="Number" name="number" placeholder="Enter number" type="text" />
                </div>
                <div>
                    <x-input-text-component label="Description" name="description" placeholder="Enter description" />
                </div>

                @if(!is_null($ratePlans))
                <div>
                    <x-input-select-component label="Rate Plan" name="rate_plan_id" 
                        :options="$ratePlans"/>
                </div>
                @endif
                <div>
                    <x-input-component label="BAR Rate" name="rate" placeholder="Enter" type="text" />
                </div>
                <div>
                    <x-input-component label="Amount Extra Person Fee" name="amount_extra_person" placeholder="Enter" type="text" />
                </div>
                <div>
                    <x-input-component label="Late Check Out Fee" name="late_check_out" placeholder="Enter" type="text" />
                </div>
                <div>
                    <x-input-component label="Early Check In Fee" name="early_check_in" placeholder="Enter" type="text" />
                </div>
                <div>
                    <x-input-component label="Day Pass Fee" name="day_pass_fee" placeholder="Enter" type="text" />
                </div>
                <div>
                    <x-input-component label="Night Pass Fee" name="night_pass_fee" placeholder="Enter" type="text" />
                </div>
                <div>
                    <x-input-component label="Rool Away Bed Fee" name="roll_away_bed" placeholder="Enter" type="text" />
                </div>
                <div>
                    <x-input-component label="Pet Fee" name="pet_fee" placeholder="Enter" type="text" />
                </div>
            </div>
        </x-modal-component>
    </form>
</div>