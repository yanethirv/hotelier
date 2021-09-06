<div>
    <article class="card relative bg-white dark:bg-gray-800">

        <div wire:loading.flex class="absolute w-full h-full bg-transparent bg-opacity-25 z-30 items-center justify-center">
            <x-spinner size="32" />
        </div>

        <form action="" id="card-form">
            <div class="card-body">
                <h1 class="text-gray-700 text-lg font-bold mb-4 dark:text-gray-400">Your Payment Information</h1>
                {{-- {{$paymentMethod}} --}}
                <div class="flex">
                    <p class="text-gray-700 dark:text-gray-400">Card information</p>
                    <div class="flex-1 ml-6">
                        <div class="mb-6">
                            <input class="appearance-none block w-full bg-blue-50 text-gray-700 border border-gray-100 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-blue-400" id="card-holder-name" type="text" placeholder="Cardholder's name" required>
                        </div>
                        <!-- Stripe Elements Placeholder -->
                        <div class="appearance-none block w-full bg-blue-50 text-blue-600 border border-gray-100 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-blue-400" id="card-element"></div>
                        <span class="text-red-700 text-xs italic" id="cardErrors"></span>
                    </div>
                </div>
            </div>
            <div class="card-footer flex justify-end dark:bg-gray-800">
                <button class="focus:outline-none cursor-pointer mb-2 md:mb-0 bg-blue-500 px-5 py-2 shadow-sm tracking-wider text-white rounded-lg hover:bg-blue-800" id="card-button" data-secret="{{ $intent->client_secret }}">
                    Add payment method
                </button>
            </div>
        </form>
    </article>

    @slot('js')

        <script>
            document.addEventListener('livewire:load', function(){
                stripe();
            });

            Livewire.on('resetStripe', function(){
                document.getElementById('card-form').reset();
                stripe();
            });
        </script>

        <script>

            function stripe(){
                const stripe = Stripe("{{ env('STRIPE_KEY')}}");
            
                const elements = stripe.elements();
                const cardElement = elements.create('card');
            
                cardElement.mount('#card-element');

                //GENERAR TOKEN
                const cardHolderName = document.getElementById('card-holder-name');
                const cardButton = document.getElementById('card-button');
                const cardForm = document.getElementById('card-form');
                const clientSecret = cardButton.dataset.secret;

                cardForm.addEventListener('submit', async (e) => {

                    e.preventDefault();

                    const { setupIntent, error } = await stripe.confirmCardSetup(
                        clientSecret, {
                            payment_method: {
                                card: cardElement,
                                billing_details: { name: cardHolderName.value }
                            }
                        }
                    );

                    if (error) {
                        // Display "error.message" to the user...
                        document.getElementById('cardErrors').textContent = error.message;
                    } else {
                        // The card has been verified successfully...

                        Livewire.emit('paymentMethodCreate', setupIntent.payment_method);
                    }
                });
            }
            
        </script>
    @endslot

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
