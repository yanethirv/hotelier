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
                    <span>Create Invoice</span>
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
                            <th class="px-4 py-3">Date</th>
                            <th class="px-4 py-3">Amount</th>
                            <th class="px-4 py-3">Description</th>
                            <th class="px-4 py-3">Status</th>
                            <th class="px-4 py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                        @foreach ($invoices as $invoice)
                        <tr class="text-gray-700 dark:text-gray-400">
                            <td class="px-4 py-3 text-sm">
                                {{$invoice->id}}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ Carbon\Carbon::parse($invoice->created_at)->format('d-m-Y') }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{$invoice->amount}}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{$invoice->description}}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                @if ($invoice->status == 'open')
                                    <span class="inline-flex items-center justify-center px-2 py-1 mr-2 text-sm font-bold leading-none text-blue-600 bg-blue-200 rounded">
                                        Open
                                    </span>
                                @endif
                                @if ($invoice->status == 'paid')
                                    <span class="inline-flex items-center justify-center px-2 py-1 mr-2 text-sm font-bold leading-none text-green-600 bg-green-200 rounded">
                                        Paid
                                    </span>
                                @endif
                                @if ($invoice->status == 'paid outside')
                                    <span class="inline-flex items-center justify-center px-2 py-1 mr-2 text-sm font-bold leading-none text-gray-600 bg-gray-200 rounded">
                                        Paid outside Stripe
                                    </span>
                                @endif
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex items-center space-x-4 text-sm">
                                    @if ($invoice->status == 'open')
                                        <a href="{{$invoice->hosted_invoice_url}}" target="_blank"
                                            class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-green-500 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                                            title="Pay Invoice">
                                            <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor" class="transform transition-transform duration-500 ease-in-out">
                                                <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"></path><path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd">
                                                </path>
                                            </svg>
                                        </a>
                                        <a wire:click="showModal({{$invoice->id}})" href="javascript:void(0)"
                                            class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-green-500 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                                            title="Pay Invoice">
                                            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor"
                                                viewBox="0 0 20 20">
                                                <path
                                                    d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z">
                                                </path>
                                            </svg>
                                        </a>
                                    @endif
                                    <a href="{{$invoice->invoice_pdf}}"
                                        class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-blue-500 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                                        title="Download Invoice">
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor" class="transform transition-transform duration-500 ease-in-out">
                                            <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd">
                                            </path>
                                        </svg>
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
                    Showing {{ $invoices->firstItem() }} to {{ $invoices->lastItem() }} out of {{ $invoices->total() }}
                </span>
                <span class="col-span-2"></span>
                <!-- Pagination -->
                <span class="flex col-span-4 mt-2 sm:mt-auto sm:justify-end">
                    {{ $invoices->links() }}
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
                        window.livewire.emit('deleteFeeInvoice', event.detail.id);
                        Toast.fire({
                        icon: 'success',
                        title: 'Fee Invoice has been deleted.',
                        })
                    }
                });

            });
        </script>
    @endpush
</div>