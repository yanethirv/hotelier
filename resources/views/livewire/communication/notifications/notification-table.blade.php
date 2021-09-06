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

                @if ($count = Auth::user()->unreadNotifications->count())
                    <a wire:click="markAllAsRead()"
                        class="focus:outline-none cursor-pointer ml-2 mb-2 md:mb-0 bg-blue-100 text-blue-600 px-2 py-2 shadow-sm tracking-wider rounded-lg hover:bg-blue-600 hover:text-white" 
                        href="javascript:void(0)">Mark all as read</a>
                @endif

            </div>
        </div>

        <div class="w-full overflow-hidden rounded-lg shadow-xs mt-4">
            <div class="w-full overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr
                            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-100 dark:text-gray-400 dark:bg-gray-800">
                            <th class="px-4 py-3">Notification</th>
                            <th class="px-4 py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                        @foreach ($notifications as $notification)
                        <tr class="text-gray-700 dark:text-gray-400">
                            <td class="px-4 py-3 text-sm">
                                [{{ $notification->created_at }}] {{ $notification->data['content'] }} 
                            </td>
                            <td class="px-4 py-3 whitespace-no-wrap">
                                <div class="flex items-center space-x-4 text-sm">
                                    <a wire:click="markAsRead({{$notification->increment}})" href="javascript:void(0)" class="text-xs mr-2 rounded-l-none hover:scale-110 focus:outline-none flex justify-center px-4 py-2 rounded font-semibold cursor-pointer 
                                        hover:bg-green-600 hover:text-green-100 bg-green-100 text-green-600 border duration-200 ease-in-out border-none transition">
                                        <div class="flex leading-5">Mark as read</div>
                                    </a>
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
                    Showing {{ $notifications->firstItem() }} to {{ $notifications->lastItem() }} out of {{ $notifications->total() }}
                </span>
                <span class="col-span-2"></span>
                <!-- Pagination -->
                <span class="flex col-span-4 mt-2 sm:mt-auto sm:justify-end">
                    {{ $notifications->links() }}
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
                    window.livewire.emit('deleteActivationService', event.detail.id);
                    Toast.fire({
                    icon: 'success',
                    title: 'Activation Service has been deleted.',
                    })
                }
            });

        });
    </script>
@endpush
</div>
