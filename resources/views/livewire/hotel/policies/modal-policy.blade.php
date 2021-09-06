<div>
    <form wire:submit.prevent="{{$method}}">
        <x-modal-component :showModal="$showModal" :action="$action">
            <h3 class="text-lg leading-6 text-blue-800 ml-4 font-bold" id="modal-title">
                {{$action}} Policy
            </h3>
            <div class="mt-2">
                <div>
                    <x-input-text-component label="Policy" name="name" placeholder="Enter policy" />
                </div>
                <div>
                    <x-input-select-component label="Hotel" name="property_id" 
                        :options="$properties"/>
                </div>
                <div>
                    <x-input-select-component label="Policy Type" name="policy_type_id" 
                        :options="$policyTypes"/>
                </div>
            </div>
        </x-modal-component>
    </form>
</div>