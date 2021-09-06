<div>
  <div class="text-center font-semibold pb-4">
    <h1 class="text-2xl">
        <span class="text-gray-600">Hello, </span>
        <span class="text-blue-600 tracking-wide uppercase">{{auth()->user()->name}}.</span>
        <span class="text-gray-600">Welcome to Hotelierhub!</span>
    </h1>
  </div>

  {{--<div class="-m-2 text-center">
    <div class="p-2">
      <div class="inline-flex items-center bg-white leading-none text-pink-600 rounded-full p-2 shadow text-teal text-sm">
        <span class="inline-flex bg-pink-600 text-white rounded-full h-6 px-3 justify-center items-center">Pink</span>
        <span class="inline-flex px-2">Donec sit amet neque risus. Pellentesque leo mauris, dictum et ligula in.</span>
      </div>
    </div>

    <div class="p-2">
      <div class="inline-flex items-center bg-white leading-none text-pink-600 rounded-full p-2 shadow text-teal text-sm">
        <span class="inline-flex bg-pink-600 text-white rounded-full h-6 px-3 justify-center items-center">Pink</span>
        <span class="inline-flex px-2">Donec sit amet neque risus. Pellentesque leo mauris, dictum et ligula in.</span>
      </div>
    </div>

    <div class="p-2">
      <div class="inline-flex items-center bg-white leading-none text-pink-600 rounded-full p-2 shadow text-teal text-sm">
        <span class="inline-flex bg-pink-600 text-white rounded-full h-6 px-3 justify-center items-center">Pink</span>
        <span class="inline-flex px-2">Donec sit amet neque risus. Pellentesque leo mauris, dictum et ligula in.</span>
      </div>
    </div>
    
    <div class="p-2">
      <div class="inline-flex items-center bg-white leading-none text-purple-600 rounded-full p-2 shadow text-sm">
        <span class="inline-flex bg-purple-600 text-white rounded-full h-6 px-3 justify-center items-center text-">Purple</span>
        <span class="inline-flex px-2">Aliquam condimentum, odio ac finibus fermentum neque risus.</span>
      </div>
    </div>
    
    <div class="p-2">
      <div class="inline-flex items-center bg-white leading-none text-purple-600 rounded-full p-2 shadow text-teal text-sm">
        <span class="inline-flex bg-indigo-600 text-white rounded-full h-6 px-3 justify-center items-center">Indigo</span>
        <span class="inline-flex px-2">Praesent ex nibh, laoreet id luctus vitae, porttitor at turpis. </span>
      </div>
    </div>
  </div>--}}

  <!-- How to Get Started -->
  <div class="relative flex flex-col min-w-0 break-words bg-white dark:bg-gray-800 w-full shadow-lg rounded">
    <div class="rounded-t mb-0 px-0 border-0">
      <div class="flex flex-wrap items-center px-4 py-4">
        <div class="relative w-full max-w-full flex-grow flex-1">
          <h3 class="font-semibold text-lg text-gray-600 dark:text-gray-50">How to Get Started</h3>
        </div>
      </div>
      <div class="block w-full">
        <div class="px-4 bg-gray-100 dark:bg-gray-600 text-gray-500 text-md dark:text-gray-100 align-middle border border-solid border-gray-200 dark:border-gray-500 py-3 border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
          General
        </div>
        <ul class="my-1">
          <li class="flex px-4">
            <div class="flex-grow flex items-center dark:border-gray-400 text-sm text-gray-600 dark:text-gray-100 py-2">
              <div class="flex-grow flex justify-between items-center">
                @if (!$property == NULL)
                  <div class="self-center">
                    <span class="text-green-500 text-lg"><i class="fas fa-check-circle"></i> Add a Hotel</span>
                  </div>
                @else
                  <div class="self-center">
                      <span class="text-red-500 text-lg"><i class="fas fa-exclamation-circle"></i> Add a Hotel</span>
                  </div>
                  <div class="flex-shrink-0 ml-2">
                    <a href="{{route('hotels.index')}}" class="flex items-center font-medium text-blue-500 hover:text-blue-600 dark:text-blue-400 dark:hover:text-blue-500" style="outline: none;">
                      Go to Hotel<span><svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor" class="transform transition-transform duration-500 ease-in-out"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg></span>
                    </a>
                  </div>
                @endif
              </div>
            </div>
          </li>
        </ul>

        <div class="px-4 bg-gray-100 dark:bg-gray-600 text-gray-500 text-md dark:text-gray-100 align-middle border border-solid border-gray-200 dark:border-gray-500 py-3 border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
          Billing
        </div>
        <ul class="my-1">
          <li class="flex px-4">
            <div class="flex-grow flex items-center  dark:border-gray-400 text-sm text-gray-600 dark:text-gray-100 py-2">
              <div class="flex-grow flex justify-between items-center">
                @if (auth()->user()->hasDefaultPaymentMethod())
                  <div class="self-center">
                    <span class="text-green-500 text-lg"><i class="fas fa-check-circle"></i> Add a Payment Method</span>
                  </div>
                @else
                  <div class="self-center">
                      <span class="text-red-500 text-lg"><i class="fas fa-exclamation-circle"></i> Add a Payment Method</span>
                  </div>
                  <div class="flex-shrink-0 ml-2">
                    <a href="{{route('payment.methods')}}" class="flex items-center font-medium text-blue-500 hover:text-blue-600 dark:text-blue-400 dark:hover:text-blue-500" style="outline: none;">
                      Go to Payment Methods<span><svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor" class="transform transition-transform duration-500 ease-in-out"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg></span>
                    </a>
                  </div>
                @endif
              </div>
            </div>
          </li>
        </ul>

        <div class="px-4 bg-gray-100 dark:bg-gray-600 text-gray-500 text-md dark:text-gray-100 align-middle border border-solid border-gray-200 dark:border-gray-500 py-3 border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
          Marketplace
        </div>
        <ul class="my-1">
          <li class="flex px-4">
            <div class="flex-grow flex items-center  dark:border-gray-400 text-sm text-gray-600 dark:text-gray-100 py-2">
              <div class="flex-grow flex justify-between items-center">
                @if ($subscription)
                  <div class="self-center">
                    <span class="text-green-500 text-lg"><i class="fas fa-check-circle"></i> Select a Subscription</span>
                  </div>
                @else
                  <div class="self-center">
                      <span class="text-red-500 text-lg"><i class="fas fa-exclamation-circle"></i> Select a Subscription</span>
                  </div>
                  <div class="flex-shrink-0 ml-2">
                    <a href="{{route('subscriptions')}}" class="flex items-center font-medium text-blue-500 hover:text-blue-600 dark:text-blue-400 dark:hover:text-blue-500" style="outline: none;">
                      Go to Subscriptions<span><svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor" class="transform transition-transform duration-500 ease-in-out"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg></span>
                    </a>
                  </div>
                @endif
              </div>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </div>
  <!-- ./Recent Activities -->
</div>
