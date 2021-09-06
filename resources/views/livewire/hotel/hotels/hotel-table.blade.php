<div class="flex flex-row px-4">
    <div class="flex-1">
        <div class="bg-gray-50 dark:border-gray-700 dark:text-gray-400 dark:bg-gray-800 py-3 items-center justify-between">
            <div class="flex text-gray-500">
                <select wire:model="perPage" class="text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-blue-400 focus:outline-none focus:shadow-outline-blue dark:focus:shadow-outline-gray">
                    <option>5</option>
                    <option>10</option>
                    <option>15</option>
                    <option>20</option>
                </select>
                <input wire:model.debounce.300ms="search" type="text" class="form-input w-full text-gray-500 ml-2" placeholder="Search ..." />
            </div>
            <div class="flex text-gray-500 pt-4">
                <button wire:click="showModal" type="button"
                    class="flex items-center justify-between px-4 py-2 mb-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-blue-600 border border-transparent rounded active:bg-blue-600 hover:bg-blue-800 focus:outline-none focus:shadow-outline-blue">
                    <svg class="w-4 h-4 mr-2 -ml-1" fill="currentColor" aria-hidden="true" viewBox="0 0 20 20">
                        <path d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" fill-rule="evenodd"></path>
                    </svg>
                    <span>Add Hotel</span>
                </button>
            </div>
        </div>

        <div class="w-full overflow-hidden rounded-lg shadow-xs mt-4">
            <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-normal">
                    <thead>
                        <tr
                            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-100 dark:text-gray-400 dark:bg-gray-800">
                            <th wire:click="sortBy('id')" class="px-6 py-3 cursor-pointer">ID
                                @include('layouts._sort-icon',['field' => 'id'])</th>
                            <th wire:click="sortBy('name')"  class="px-4 py-3">Name
                                @include('layouts._sort-icon',['field' => 'title'])
                            </th>
                            <th class="px-4 py-3">Category</th>
                            <th class="px-4 py-3">Room Range</th>
                            <th class="px-4 py-3">Country</th>
                            <th class="px-4 py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                        @foreach ($properties as $property)
                        <tr class="text-gray-700 dark:text-gray-400">
                            <td class="px-4 py-3 text-sm">
                                {{$property->id}}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{$property->name}}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{$property->category->name}}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{$property->roomRange->name}}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{$property->country->name}}
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex items-center space-x-4 text-sm">
                                    <a wire:click="modalDetails({{$property->id}})" href="javascript:void(0)"
                                        class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-blue-500 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                                        title="Details">
                                        <svg viewBox="0 0 20 20" fill="currentColor" strokeWidth="2" class="w-5 h-5"><path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path><path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"></path></svg>
                                    </a>
                                    <a href="/hotel/hotel-pdf/{{ $property->id }}"
                                        class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-gray-500 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                                        title="Download">
                                        <svg viewBox="0 0 20 20" fill="currentColor" strokeWidth="2" class="w-5 h-5">
                                            <path fill-rule="evenodd" d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm5 6a1 1 0 10-2 0v3.586l-1.293-1.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V8z" clip-rule="evenodd"></path>
                                        </svg>
                                    </a>
                                    <a wire:click="showModal({{$property->id}})" href="javascript:void(0)"
                                        class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-green-500 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                                        title="Edit">
                                        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z">
                                            </path>
                                        </svg>
                                    </a>
                                    
                                        {{--<a wire:click="deleteConfirm({{$amenity->id}})" href="javascript:void(0)"
                                        class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-red-500 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                                        title="Delete">
                                        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor"
                                            viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    </a>--}}
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div
                class="grid px-4 py-3 text-xs font-semibold tracking-wide text-blue-700 uppercase border-t dark:border-gray-700 bg-white sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800">
                <span class="flex items-center col-span-3">
                    Showing {{ $properties->firstItem() }} to {{ $properties->lastItem() }} out of {{ $properties->total() }}
                </span>
                <span class="col-span-2"></span>
                <!-- Pagination -->
                <span class="flex col-span-4 mt-2 sm:mt-auto sm:justify-end">
                    {{ $properties->links() }}
                </span>
            </div>
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
        </script>
    @endpush
</div>
