<div class="flex flex-row px-4 pb-4">
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
                    <span>Add Photo</span>
                </button>
            </div>
        </div>
        
        <div
            class="grid px-4 py-3 text-xs font-semibold tracking-wide text-blue-700 uppercase border-t dark:border-gray-700 bg-white sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800">
            <span class="flex items-center col-span-3">
                Showing {{ $photos->firstItem() }} to {{ $photos->lastItem() }} out of {{ $photos->total() }}
            </span>
            <span class="col-span-2"></span>
            <!-- Pagination -->
            <span class="flex col-span-4 mt-2 sm:mt-auto sm:justify-end">
                {{ $photos->links() }}
            </span>
        </div>

        <div class="mx-auto px-4 md:px-12">
            <div class="flex flex-wrap -mx-1 lg:-mx-4">
                @foreach ($photos as $photo)
                <div class="my-1 px-1 w-full md:w-1/2 lg:my-4 lg:px-4 lg:w-1/3">
                    <article class="overflow-hidden rounded-lg shadow-lg">
                        <img class="block h-80 w-full" src="{{ asset('storage/'.$photo->photo_path) }}" alt="{{$photo->title}}">

                        <div class="pt-4 mx-4">
                            <span class="text-md font-semibold text-gray-700 dark:text-gray-400">Title: </span>{{$photo->title}}
                        </div>

                        <div class="pt-4 mx-4">
                            <span class="text-md font-semibold text-gray-700 dark:text-gray-400">Hotel: </span>{{$photo->property->name}}
                        </div>

                        <div class="pt-4 mx-4">
                            <span class="text-md font-semibold text-gray-700 dark:text-gray-400">Location: </span>{{$photo->photoLocation->name}}
                        </div>

                        <footer class="flex items-center justify-between leading-none p-4 md:p-6">
                            <a wire:click="showModal({{$photo->id}})" href="javascript:void(0)" class="text-xs mr-2 rounded-l-none hover:scale-110 focus:outline-none flex justify-center px-4 py-2 rounded font-semibold cursor-pointer 
                                hover:bg-green-600 hover:text-green-100 bg-green-100 text-green-600 border duration-200 ease-in-out border-none transition">
                                <div class="flex leading-5">Edit</div>
                            </a>
                            <a wire:click="deleteConfirm({{$photo->id}})" href="javascript:void(0)" class="text-xs mr-2 rounded-l-none hover:scale-110 focus:outline-none flex justify-center px-4 py-2 rounded font-semibold cursor-pointer 
                                hover:bg-red-600 hover:text-red-100 bg-red-100 text-red-600 border duration-200 ease-in-out border-none transition">
                                <div class="flex leading-5">Delete</div>
                            </a>
                        </footer>
                    </article>
                </div>
                @endforeach
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
                        window.livewire.emit('deletePhoto', event.detail.id);
                        Toast.fire({
                        icon: 'success',
                        title: 'Photo has been deleted.',
                        })
                    }
                });

                });
        </script>
    @endpush
</div>
