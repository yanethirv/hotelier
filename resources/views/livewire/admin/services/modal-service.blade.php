<div>
    <form wire:submit.prevent="{{$method}}">
        <x-modal-component :showModal="$showModal" :action="$action">
            <div class="pb-6">

                <div class="mt-3 sm:mt-0 sm:text-left">
                    <div>
                        <h3 class="text-lg leading-6 text-blue-800 ml-4 font-bold" id="modal-title">
                            {{$action}} Service
                        </h3>
                    </div>
                    <div class="mt-2">
                        <div>
                            <x-input-component label="Name" name="name" placeholder="Enter name" type="text" />
                        </div>
                        <div>
                            <x-input-text-component label="Description" name="description" placeholder="Enter description" />
                        </div>
                        <div>
                            <x-input-component label="Price" name="price" placeholder="Enter price" type="text" />
                        </div>
                        <div>
                            <x-input-component label="Cost" name="cost" placeholder="Enter cost" type="text" />
                        </div>
                        <div>
                            <x-input-select-component label="Type" name="type_id" 
                                :options="$types"/>
                        </div>
                        <div>
                            <div>
                                <label for="attachment" class="block text-sm pt-4 ml-4">
                                    <span class="text-gray-700 dark:text-gray-400">Attachment</span>
                                    <input type="file" wire:model="attachment" id="{{$iterator}}" placeholder="Enter attachment"
                                        class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-blue-400 focus:outline-none focus:shadow-outline-blue dark:text-gray-300 dark:focus:shadow-outline-gray form-input" />
                                </label>
                            </div>
                            @if ($errors->has('attachment'))
                                <small class="text-red-600 ml-4">{{$errors->first('attachment')}}</small>        
                            @endif
                        </div>

                        <div wire:loading wire:target="attachment" class="block w-11/12 pt-4 m-4 bg-teal-100 border border-teal-400 text-teal-700 px-4 py-3 rounded relative" role="alert">
                            <strong class="font-bold">Uploading Attachment!</strong>
                            <span class="block sm:inline">Wait a moment...</span>
                        </div>

                    </div>
                </div>
            </div>
        </x-modal-component>
    </form>
</div>