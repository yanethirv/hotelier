<div>
    <section class="card relative bg-white">

        <div wire:loading.flex class="absolute w-full h-full bg-transparent bg-opacity-25 z-30 items-center justify-center">
            <x-spinner size="24" />
        </div>

        <div class="px-6 py-5 bg-gray-200 dark:bg-gray-700">
            <h1 class="tex-gray-700 text-lg font-bold dark:text-gray-400">Aggregate payment methods</h1>
        </div>

        <div class="card-body divide-y divide-gray-200 dark:bg-gray-800">
            @forelse ($paymentMethods as $paymentMethod)
                <article class="text-sm text-gray-700 dark:text-gray-400 py-2 flex justify-between items-center">
                    <div>
                        <h1>
                            <span class="font-bold">{{$paymentMethod->billing_details->name}}</span>
                            xxxx-{{$paymentMethod->card->last4}}

                            @if ($paymentMethod->id == auth()->user()->defaultPaymentMethod()->id)
                                <span class="font-bold text-blue-700"">(default)</span>
                            @endif
                            
                        </h1>
                        <p>Expires {{$paymentMethod->card->month}}/{{$paymentMethod->card->exp_year}}</p>
                    </div>

                    <div class="grid grid-cols-2 border border-gray-200 rounded text-gray-500 divide-x divide-gray-200">
                        
                        @unless ($paymentMethod->id == auth()->user()->defaultPaymentMethod()->id)
                            
                            <i class="fas fa-star cursor-pointer p-3 hover:text-blue-700" wire:click="defaultPaymentMethod('{{$paymentMethod->id}}')"></i>
                            <i class="fas fa-trash cursor-pointer p-3 hover:text-blue-700" wire:click="deletePaymentMethod('{{$paymentMethod->id}}')"></i>
                        
                        @endunless

                    </div>
                </article>

            @empty
                
                <article class="p-2">
                    <h1 class="text-sm text-gray-700">No payment method registered</h1>
                </article>
                
            @endforelse
        </div>

    </section>
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
