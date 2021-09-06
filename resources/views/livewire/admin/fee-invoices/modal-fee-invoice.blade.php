<div>
    <form wire:submit.prevent="{{$method}}">
        <x-modal-component :showModal="$showModal" :action="$action">
            <div class="pb-6">

                <div class="mt-3 sm:mt-0 sm:text-left">
                    <div>
                        <h3 class="text-lg leading-6 text-blue-800 ml-4 font-bold" id="modal-title">
                            {{$action}} Fee Invoice
                        </h3>
                    </div>
                    <div class="mt-2">
                        @if ($action === 'Pay')
                        <div class="grid grid-cols-1 mt-5 mx-7">
                            <label class="mb-2 uppercase md:text-sm text-sm text-gray-700 font-bold">Amount</label>
                            <span class="text-blue-600 text-light">{{$amount}}</span>
                        </div>
                        <div class="grid grid-cols-1 mt-5 mx-7">
                            <label class="mb-2 uppercase md:text-sm text-sm text-gray-700 font-bold">Description</label>
                            <span class="text-blue-600 text-light">{{$description}}</span>
                        </div>
                        <div class="grid grid-cols-1 mt-5">
                            <x-input-text-component label="Payment details" name="details" placeholder="" />
                        </div>
                        @endif
                        @if ($action === 'Create')
                            <div>
                                <x-input-component label="Amount" name="amount" placeholder="E.g 10,00" type="text" />
                            </div>
                            <div>
                                <x-input-text-component label="Description" name="description" placeholder="Enter description" />
                            </div>
                            <div>
                                <x-input-select-component label="Client" name="user_id" :options="$users"/>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </x-modal-component>
    </form>
</div>