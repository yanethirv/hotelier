<div class="card relative bg-white dark:bg-gray-800 dark:text-gray-400">

    <div wire:loading.flex class="absolute w-full h-full bg-transparent bg-opacity-25 z-30 items-center justify-center">
        <x-spinner size="20" />
    </div>
    
    <div class="card-body">

        <table class="w-full">
            <thead>
                <tr class="text-left">
                    <th class="w-1/2 px-4 py-2">Date</th>
                    <th class="w-1/4 px-4 py-2">USD</th>
                    <th class="w-1/4 px-4 py-2"></th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200">
                @forelse ($invoices as $invoice)
                    <tr>
                        <td class="px-4 py-3">{{ $invoice->date()->toFormattedDateString() }}</td>
                        <td class="px-4 py-3">{{ $invoice->total() }}</td>
                        <td class="px-4 py-3 text-right">
                            <a class="focus:outline-none cursor-pointer mb-2 md:mb-0 bg-blue-100 text-blue-600 px-5 py-2 shadow-sm tracking-wider rounded-lg hover:bg-blue-600 hover:text-white" href="/user/invoice/{{ $invoice->id }}">Download</a>
                        </td>
                    </tr>
                @empty

                <tr>
                    <td colspan="3" class="px-4 py-3 text-gray-700">
                        You do not have registered invoices
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

    </div>
</div>