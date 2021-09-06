<div>
    <form wire:submit.prevent="{{$method}}" id="form-user">
        <x-modal-component :showModal="$showModal" :action="$action">
            <div class="pb-6">

                <div class="mt-3 sm:mt-0 sm:ml-4 sm:text-left">

                    <div class="flex">
                        <h3 class="text-lg leading-6 text-blue-800 ml-4 font-bold" id="modal-title">
                            {{$action}} User
                        </h3>
                    </div>
                    <div class="mt-2">
                        {{--<p class="text-sm text-gray-500">
                        Are you sure you want to deactivate your account? All of your data will be permanently removed. This action cannot be undone.
                        </p>--}}
                        
                        <div>
                            <x-input-component label="Name" name="name" placeholder="Enter name" type="text" />
                            <x-input-component label="Email" name="email" placeholder="Enter email" type="email" />
                        </div>

                        <div>
                            <x-input-select-component label="Role" name="role" 
                                :options="$roles"/>
                        </div>

                        <div>
                            <div>
                                <label for="profile_photo_path" class="block text-sm pt-4 ml-4">
                                    <span class="text-gray-700 dark:text-gray-400">Avatar</span>
                                    <input type="file" wire:model="profile_photo_path" id="{{$iterator}}" placeholder="Enter avatar"
                                        class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-blue-400 focus:outline-none focus:shadow-outline-blue dark:text-gray-300 dark:focus:shadow-outline-gray form-input" />
                                </label>
                            </div>
                            @if ($errors->has('profile_photo_path'))
                                <small class="text-red-600 ml-4">{{$errors->first('profile_photo_path')}}</small>        
                            @endif
                        </div>

                        <div wire:loading wire:target="profile_photo_path" class="block w-11/12 pt-4 m-4 bg-teal-100 border border-teal-400 text-teal-700 px-4 py-3 rounded relative" role="alert">
                            <strong class="font-bold">Uploading Avatar!</strong>
                            <span class="block sm:inline">Wait a moment...</span>
                        </div>

                        @if ($action == 'Create')
                            <div class="flex">
                                <x-input-component label="Password" name="password" placeholder="Enter password" type="password" />
                                <x-input-component label="Confirm Password" name="password_confirmation" placeholder="Confirm password" type="password" />
                            </div>
                        
                        @endif
                    </div>
                </div>
            </div>
        </x-modal-component>
    </form>
</div>