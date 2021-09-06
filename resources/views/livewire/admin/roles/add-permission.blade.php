<div>
    <x-modal-component :showModal="$showModal">
        <div class="pb-6">

            <div class="mt-3 sm:mt-0 sm:ml-4 sm:text-left">

                <div class="flex">
                    <!-- Heroicon name: outline/exclamation -->
                    <svg class="h-6 w-6 text-blue-600 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                        Permissions
                    </h3>
                </div>

                <div class="w-full mt-3">
                    @foreach ($permission_check as $key => $p)
                        <div class="flex flex-row mb-1">
                            <div class="mt-1 mr-2 text-blue-600 w-1/12">
                                <span class="fa {{$p['check'] ? 'fa-check' : ''}}"></span>
                            </div>
                            <div class="w-3/4">
                                <span>{{$key}}</span>
                            </div>
                            <div class="flex-1">
                                <input type="checkbox" 
                                        wire:model="permission_check.{{$key}}.check"
                                        wire:click="addPermissionCheck('{{$key}}')"
                                        class="bg-blue-300">
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </x-modal-component>
</div>
