<div class="w-full">

    @if (auth()->user()->hasDefaultPaymentMethod())
        
        @if (auth()->user()->subscribed($name))

            @if (auth()->user()->subscribedToPlan($price, $name))

                @if (auth()->user()->subscription($name)->onGracePeriod())
                    <div>
                        <button wire:click="resuminSubscription"
                            wire:loading.attr="disabled"
                            wire:target="resuminSubscription"
                            class="font-bold bg-gray-500 hover:bg-gray-800 text-white text-lg rounded-md flex px-10 py-4 transition-colors w-full items-center justify-center">
                            <x-spinner wire:loading wire:target="resuminSubscription" size="6" class="mr-2" />
                            RESUME PLAN
                        </button>
                    </div>
                @else
                    <article>
                        <button wire:click="cancellingSubscription"
                            wire:loading.attr="disabled"
                            wire:target="cancellingSubscription"
                            class="font-bold bg-red-500 text-white hover:bg-red-800 hover:text-white text-lg rounded-md flex px-10 py-4 transition-colors w-full items-center justify-center">
                            <x-spinner wire:loading wire:target="cancellingSubscription" size="6" class="mr-2" />
                            CANCEL PLAN
                        </button>
                    </article>
                @endif

            @else

                <button wire:click="changingPlans"
                    wire:loading.attr="disabled"
                    wire:target="changingPlans"
                    class="font-bold bg-blue-500 hover:bg-blue-800 text-white hover:text-white text-lg rounded-md flex px-10 py-4 transition-colors w-full items-center justify-center">
                    <x-spinner wire:loading wire:target="changingPlans" size="6" class="mr-2" />
                    CHANGE PLAN
                </button>

            @endif
            
        @else
                
            <input wire:model="coupon" type="text" class="bg-gray-50 text-gray-700 border border-gray-100 text-lg rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-purple-400 mb-3" placeholder="Apply coupon ...">

            <a wire:click="newSubscription"
                wire:loading.attr="disabled"
                wire:target="newSubscription"
                class="cursor-pointer font-bold bg-blue-200 text-blue-900 hover:bg-blue-900 hover:text-white rounded-md flex px-10 py-4 transition-colors w-full items-center justify-center">
                <x-spinner wire:loading wire:target="newSubscription" size="6" class="mr-2" />
                SUBSCRIBE
            </a>
        
        @endif

    @else
        
        <a class="font-bold cursor-pointer text-sm text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-md flex px-10 py-4 transition-colors w-full items-center justify-center"
            href="{{route('payment.methods')}}">
            Add payment method
        </a>

    @endif
</div>