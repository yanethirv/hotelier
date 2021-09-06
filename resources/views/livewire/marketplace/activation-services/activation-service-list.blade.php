<div class="grid my-8 gap-8 grid-cols-1 lg:grid-cols-2">

    @foreach ($activationServices as $activationService)
        <div class="flex flex-col">
            <div class="bg-white shadow-md  rounded-lg p-4 dark:bg-gray-800">
                <div class="flex-none lg:flex">
                    <div class="flex-auto ml-3 justify-evenly py-2">
                        <div class="flex flex-wrap ">
                            <div class="w-full flex-none text-sm text-blue-600 font-semibold dark:text-blue-400 uppercase">
                                {{$activationService->type->name}}
                            </div>
                            <h3 class="text-2xl leading-8 font-extrabold text-gray-700 sm:text-3xl sm:leading-9 dark:text-gray-400">
                                {{$activationService->name}}
                            </h3>
                            <p class="dark:text-gray-400 py-4"></p>
                        </div>
                        
                        <div class="mt-4">
                            <div class="flex items-center">
                                <h4 class="flex-shrink-0 pr-4 bg-white dark:bg-gray-800 text-sm leading-5 tracking-wider font-semibold uppercase text-gray-500">
                                    Description
                                </h4>
                                <div class="flex-1 border-t-2 border-gray-200">
                                </div>
                            </div>
                            <p class="ml-3 py-4 text-medium leading-5 text-gray-700 dark:text-gray-200">
                                {{$activationService->description}}
                            </p>
                        </div>
                        <div class="flex space-x-3 text-sm font-medium pt-4">
                            <div class="flex-auto flex space-x-3">
                                @if ($activationService->attachment)
                                    <a href="{{ asset('storage/'.$activationService->attachment) }}" target="_blank" rel="noopener noreferrer"
                                        class="cursor-pointer mb-2 md:mb-0 bg-blue-100 px-5 py-2 shadow-sm tracking-wider text-blue-600 rounded-lg hover:bg-blue-600 hover:text-white inline-flex items-center space-x-2 ">
                                        <span class="rounded-lg">
                                            <svg viewBox="0 0 20 20" fill="currentColor" strokeWidth="2" class="w-5 h-5"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"></path></svg>
                                        </span>
                                        <span>View Info</span>
                                    </a>
                                @endif
                            </div>
                            
                            @if ($userActivationServices->contains('activation_service_id', $activationService->id))
                                <a class="mb-2 md:mb-0 bg-gray-200 px-5 py-2 shadow-sm tracking-wider text-gray-600 rounded-lg">
                                    Service Requested
                                </a>
                            @else
                                <a wire:click="sendActivation({{$activationService}})" href="javascript:void(0)" class="cursor-pointer mb-2 md:mb-0 bg-blue-500 px-5 py-2 shadow-sm tracking-wider text-white rounded-lg hover:bg-blue-800">
                                    Send Activation
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    @push('scripts')
        <script>
            window.addEventListener('swal:modal', event => {
                const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
                });

                Toast.fire({
                icon: event.detail.type,
                title: event.detail.title,
                });
            });
        </script>
    @endpush
</div>