<div>
    <form wire:submit.prevent="{{$method}}">
        <x-modal-component :showModal="$showModal" :action="$action">
            <div class="pb-6">

                <div class="mt-3 sm:mt-0 sm:text-left">
                    <div>
                        <h3 class="text-lg leading-6 text-blue-800 ml-4 font-bold" id="modal-title">
                            {{$action}} Plan
                        </h3>
                    </div>
                    <div class="mt-2">
                        <div>
                            <x-input-component label="Name" name="nickname" placeholder="Enter name" type="text" />
                        </div>
                        <div>
                            <x-input-text-component label="Description" name="description" placeholder="Enter description" />
                        </div>
                        @if ($action == 'Create')
                        <div>
                            <x-input-select-component label="Product" name="product_id" 
                                :options="$products"/>
                        </div>
                        <div>
                            <x-input-component label="Amount" name="amount" placeholder="Enter amount" type="text" />
                        </div>
                        @endif

                        @if ($action == 'Test')
                            <div>
                                <label for="active" class="block text-sm pt-4 ml-4">
                                    <span class="text-gray-700 dark:text-gray-400">Active</span>
                                    <input type="checkbox" name="active" id="active" wire:model="active" class="text-purple-600 form-checkbox focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" />
                                </label>
                                @if ($errors->has('active'))
                                    <small class="text-red-600 ml-4">{{$errors->first('active')}}</small>        
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </x-modal-component>
    </form>
</div>