<div>
    <form wire:submit.prevent="{{$method}}">
        <x-modal-component :showModal="$showModal" :action="$action">
            <div class="pb-6">

                <div class="mt-3 sm:mt-0 sm:text-left">
                    <div>
                        <h3 class="text-lg leading-6 text-blue-800 ml-4 font-bold" id="modal-title">
                            {{$action}} by Transfer Fee Invoice
                        </h3>
                    </div>
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
                            <x-input-component label="Transfer Number" name="trans_number" placeholder="Enter Transfer Number" type="text" />
                        </div>
                        <div class="grid grid-cols-1 mt-5">
                            <x-input-component label="Transfer Date" name="trans_date" placeholder="Enter Transfer Date" type="text" />
                        </div>
                        <div class="grid grid-cols-1 mt-5">
                            <x-input-component label="Transfer Bank" name="trans_bank" placeholder="Enter Bank" type="text" />
                        </div>
                        <div class="grid grid-cols-1 mt-5">
                            <x-input-text-component label="Note" name="note" placeholder="" />
                        </div>
                        @endif
                    
                </div>
            </div>
        </x-modal-component>
    </form>
</div>