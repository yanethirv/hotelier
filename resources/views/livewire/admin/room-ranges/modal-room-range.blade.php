<div>
    <form wire:submit.prevent="{{$method}}">
        <x-modal-component :showModal="$showModal" :action="$action">
            <div class="pb-6">

                <div class="mt-3 sm:mt-0 sm:text-left">
                    <div>
                        <h3 class="text-lg leading-6 text-blue-800 ml-4 font-bold" id="modal-title">
                            {{$action}} Room Range
                        </h3>
                    </div>
                    <div class="mt-2">
                        <div>
                            <x-input-component label="Name" name="name" placeholder="Enter name" type="text" />
                        </div>
                        <div>
                            <x-input-text-component label="Description" name="description" placeholder="Enter description" />
                        </div>
                    </div>
                </div>
            </div>
        </x-modal-component>
    </form>
</div>