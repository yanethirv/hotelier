<div> 
    <div class="card relative bg-white shadow-md  rounded-lg p-4 dark:bg-gray-800">
        <div wire:loading.flex class="absolute w-full h-full bg-transparent bg-opacity-25 z-30 items-center justify-center">
            <x-spinner size="20" />
        </div>
        <div class="card-body">
            <div class="flex justify-between items-center mb-4">
                <h1 class="font-bold text-lg text-gray-700 dark:text-gray-400">Payment method</h1>
                <img class="h-8" src="https://leadershipmemphis.org/wp-content/uploads/2020/08/780370.png" alt="">
            </div>
            <form id="card-form">
                <div class="form-group pb-6">
                    <input class="appearance-none block w-full bg-blue-50 text-gray-700 border border-gray-100 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-blue-400" id="card-holder-name" type="text" placeholder="Enter cardholder's name" required>
                </div>
                <!-- Stripe Elements Placeholder -->
                <div class="form-group pb-6">
                    <div class="appearance-none block w-full bg-blue-50 text-gray-700 border border-gray-100 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-blue-400" id="card-element"></div>
                    <span class="text-red-700 text-xs italic" id="card-error"></span>
                </div>
                <button id="card-button" class="focus:outline-none cursor-pointer mb-2 md:mb-0 bg-blue-500 px-5 py-2 shadow-sm tracking-wider text-white rounded-lg hover:bg-blue-800">
                    Process Payment
                </button>
            </form>
        </div>
    </div>

    @slot('js')
    <script>
        document.addEventListener('livewire:load', function(){
            stripe();
        });

        Livewire.on('resetStripe', function(){
                document.getElementById('card-form').reset();
                stripe();
            });

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
    <script>
        function stripe(){
            const stripe = Stripe("{{env('STRIPE_KEY')}}");
            const elements = stripe.elements();
            const cardElement = elements.create('card');
        
            cardElement.mount('#card-element');
            //PAYMENT METHOD
            const cardHolderName = document.getElementById('card-holder-name');
            const cardButton = document.getElementById('card-button');
            const cardForm = document.getElementById('card-form');
            cardForm.addEventListener('submit', async (e) => {
                e.preventDefault();
                const { paymentMethod, error } = await stripe.createPaymentMethod(
                    'card', cardElement, {
                        billing_details: { name: cardHolderName.value }
                    }
                );
                if (error) {
                    // Display "error.message" to the user...
                    document.getElementById('card-error').textContent = error.message
                } else {
                    // The card has been verified successfully...
                    Livewire.emit('paymentMethodCreate', paymentMethod.id)
                }
            });
        }
    </script>
    @endslot
</div>