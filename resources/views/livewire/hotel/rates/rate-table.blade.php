<div class="flex flex-row">
    <div class="flex-1">
        <div class="bg-white dark:border-gray-700 dark:text-gray-400 dark:bg-gray-800 px-4 py-3 items-center justify-between border-t border-gray-200 sm:px-6">
            <div class="flex text-gray-500">

                <select wire:model="perPage" class="text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-blue-400 focus:outline-none focus:shadow-outline-blue dark:focus:shadow-outline-gray">
                    <option>5</option>
                    <option>10</option>
                    <option>15</option>
                    <option>20</option>
                </select>

                <input wire:model.debounce.300ms="search" type="text" class="form-input w-full text-gray-500 ml-2" placeholder="Search Meal Plan..." />

            </div>
        </div>

        <div class="bg-white dark:border-gray-700 dark:text-gray-400 dark:bg-gray-800 px-4 py-3 items-center justify-between border-t border-gray-200 sm:px-6">
                
            <button wire:click="showModal" type="button"
                class="flex items-center justify-between px-4 py-2 mb-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-blue-600 border border-transparent rounded active:bg-blue-600 hover:bg-blue-800 focus:outline-none focus:shadow-outline-blue">
                <svg class="w-4 h-4 mr-2 -ml-1" fill="currentColor" aria-hidden="true" viewBox="0 0 20 20">
                    <path d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" fill-rule="evenodd"></path>
                </svg>
                <span>Add Rate</span>
            </button>
        </div>

        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-blue-50">
                <tr>
                    <th wire:click="sortBy('id')" 
                        scope="col" class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        ID
                        @include('layouts._sort-icon',['field' => 'id'])
                    </th>
                    <th wire:click="sortBy('name')" 
                        scope="col" class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        ROOM
                        @include('layouts._sort-icon',['field' => 'name'])
                    </th>
                    <th 
                        scope="col" class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        SUGGESTION
                    </th>
                    <th
                        scope="col" class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        SUGGESTION
                    </th>
                    <th scope="col" class="relative px-6 py-3">
                        <span class="sr-only">Edit</span>
                    </th>
                    
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($ratePlans as $ratePlan)
                    <tr>
                        <td class="px-6 py-4">
                            {{$ratePlan->id}}
                        </td>
                        <td class="px-6 py-4">
                            {{$ratePlan->name}}
                        </td>
                        <td class="px-6 py-4">
                            {{$ratePlan->suggestion}}
                        </td>
                        <td class="px-6 py-4">
                            {{$ratePlan->description}}
                        </td>
                        <td class="px-6 py-4 text-xs">
                            <div class="flex m-2">
                                <a wire:click="showModal({{$ratePlan->id}})" href="javascript:void(0)" class="text-xs mr-2 rounded-l-none hover:scale-110 focus:outline-none flex justify-center px-4 py-2 rounded font-semibold cursor-pointer 
                                        hover:bg-green-600 hover:text-green-100 bg-green-100 text-green-600 border duration-200 ease-in-out border-none transition">
                                    <div class="flex leading-5">Edit</div>
                                </a>
                                <a wire:click="deleteConfirm({{$ratePlan->id}})" href="javascript:void(0)" class="text-xs rounded-l-none hover:scale-110 focus:outline-none flex justify-center px-4 py-2 rounded font-semibold cursor-pointer 
                                        hover:bg-red-600 hover:text-red-100 bg-red-100 text-red-600 border duration-200 ease-in-out border-none transition">
                                    <div class="flex leading-5">Delete</div>
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="bg-white dark:border-gray-700 dark:text-gray-400 dark:bg-gray-800 px-4 py-3 items-center justify-between border-t border-gray-200 sm:px-6">
            <p class="text-xs py-2">Showing {{ $ratePlans->firstItem() }} to {{ $ratePlans->lastItem() }} out of {{ $ratePlans->total() }}</p>
            <p>{{ $ratePlans->links() }}</p>
        </div>

    </div>
    @push('scripts')
        <script>
            window.addEventListener('swal:modal', event => {

                const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 1500,
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

            window.addEventListener('swal:confirm', event => {

                const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 1500,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
                });

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                    if (result.isConfirmed) {
                        window.livewire.emit('deleteRatePlan', event.detail.id);
                        Toast.fire({
                        icon: 'success',
                        title: 'Rate Plan has been deleted.',
                        })
                    }
                });
                
            });
        </script>
    @endpush
</div>