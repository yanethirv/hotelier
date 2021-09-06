<div>
    <form wire:submit.prevent="{{$method}}">
        <x-modal-component :showModal="$showModal" :action="$action">
            <div class="pb-6">

                <div class="mt-3 sm:mt-0 sm:text-left">
                    <div>
                        <h3 class="text-lg leading-6 text-blue-800 ml-4 font-bold" id="modal-title">
                            {{$action}} Subscription Request
                        </h3>
                    </div>
                    <div class="mt-2">
                        <div>
                            <x-input-select-component label="RequestStatus" name="request_status_id" 
                                :options="$requestStatus"/>
                        </div>
                        <div>
                            <x-input-text-component label="Comment" name="comment" placeholder="Enter comment" />
                        </div>
                    </div>
                </div>
            </div>
        </x-modal-component>
    </form>
</div>