<div class="py-4 text-white dark:text-gray-400">
    <a class="ml-6 text-2xl font-bold text-indigo-200 dark:text-gray-200 uppercase" href="#">
        {{--{{ config('app.name') }}--}} Hotelier Hub
    </a>
    <ul class="mt-6">
      {{-- Dashboard --}}
      <li class="relative px-6 py-3">
          {!! request()->routeIs('dashboard') ? '<span class="absolute inset-y-0 left-0 w-1 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>' : '' !!}
          <a data-turbolinks-action="replace" class="inline-flex items-center w-full text-md font-semibold text-white transition-colors duration-150 hover:text-indigo-200 dark:hover:text-indigo-500 dark:text-indigo-400" href="{{route('dashboard')}}">
            <i class="fas fa-rocket"></i><span class="ml-4">{{ __('Launch') }}</span>
          </a>
      </li>

      {{-- Dashboard --}}
      <li class="relative px-6 py-3">
        {!! request()->routeIs('dashboard') ? '<span class="absolute inset-y-0 left-0 w-1 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>' : '' !!}
        <a data-turbolinks-action="replace" class="inline-flex items-center w-full text-md font-semibold text-white transition-colors duration-150 hover:text-indigo-200 dark:hover:text-indigo-500 dark:text-indigo-400" href="{{route('dashboard')}}">
          <i class="fas fa-home"></i><span class="ml-4">{{ __('Dashboard') }}</span>
        </a>
      </li>

      {{-- Resources --}}
      <li class="relative px-6 py-3">
        {!! request()->routeIs('resources') ? '<span class="absolute inset-y-0 left-0 w-1 bg-indigo-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>' : '' !!}
        <a data-turbolinks-action="replace" class="inline-flex items-center w-full text-md font-semibold transition-colors duration-150 hover:text-indigo-200 dark:hover:text-indigo-500" href="{{route('resources')}}">  
          <i class="fas fa-book"></i><span class="ml-4">Resources</span>
        </a>
      </li>

      {{-- Billing --}}
      <li class="relative px-6 py-3">
        <button class="focus:outline-none inline-flex items-center justify-between w-full text-md font-semibold transition-colors duration-150 hover:text-indigo-200 dark:hover:text-gray-200"
            @click="toggleBillingMenu" aria-haspopup="true">
            <span class="inline-flex items-center">
              <i class="far fa-credit-card"></i><span class="ml-4">Billing</span>
            </span>
            <i class="fas fa-angle-down"></i>
          </button>
          <template x-if="isBillingMenuOpen">
            <ul
              x-transition:enter="transition-all ease-in-out duration-300"
              x-transition:enter-start="opacity-25 max-h-0"
              x-transition:enter-end="opacity-100 max-h-xl"
              x-transition:leave="transition-all ease-in-out duration-300"
              x-transition:leave-start="opacity-100 max-h-xl"
              x-transition:leave-end="opacity-0 max-h-0"
              class="p-2 mt-2 space-y-2 overflow-hidden text-sm font-medium text-gray-500 rounded-md shadow-inner bg-gray-100 dark:text-gray-400 dark:bg-gray-900"
              aria-label="submenu">
              <li class="px-2 py-1 transition-colors duration-150 hover:text-indigo-500 dark:hover:text-indigo-500">
                <a class="w-full" href="{{route('payment.methods')}}">Payment Methods</a>
              </li>
              <li class="px-2 py-1 transition-colors duration-150 hover:text-indigo-500 dark:hover:text-indigo-500">
                <a class="w-full" href="{{route('invoices')}}">Invoices</a>
              </li>
            </ul>
          </template>
      </li>



        {{-- Marketplace --}}
        <li class="relative px-6 py-3">
          <button
              class="focus:outline-none inline-flex items-center justify-between w-full text-md font-semibold transition-colors duration-150 hover:text-indigo-200 dark:hover:text-gray-200"
              @click="toggleMarketplaceMenu"
              aria-haspopup="true">
              <span class="inline-flex items-center">
                <svg viewBox="0 0 20 20" fill="currentColor" strokeWidth="2" class="w-5 h-5"><path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z"></path></svg>
                <span class="ml-4">Marketplace</span>
              </span>
              <svg class="w-4 h-4" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                  clip-rule="evenodd"></path>
              </svg>
            </button>
            <template x-if="isMarketplaceMenuOpen">
              <ul
                x-transition:enter="transition-all ease-in-out duration-300"
                x-transition:enter-start="opacity-25 max-h-0"
                x-transition:enter-end="opacity-100 max-h-xl"
                x-transition:leave="transition-all ease-in-out duration-300"
                x-transition:leave-start="opacity-100 max-h-xl"
                x-transition:leave-end="opacity-0 max-h-0"
                class="p-2 mt-2 space-y-2 overflow-hidden text-sm font-medium text-gray-500 rounded-md shadow-inner bg-gray-100 dark:text-gray-400 dark:bg-gray-900"
                aria-label="submenu">

                {{--<li class="px-2 py-1 transition-colors duration-150 hover:text-indigo-500 dark:hover:text-indigo-500">
                  <a class="w-full" href="{{route('plans')}}">Plans</a>
                </li>--}}

                <li class="px-2 py-1 transition-colors duration-150 hover:text-indigo-500 dark:hover:text-indigo-500">
                  <a class="w-full" href="{{route('plans.marketplace')}}">Plans</a>
                </li>

                <li class="px-2 py-1 transition-colors duration-150 hover:text-indigo-500 dark:hover:text-indigo-500">
                  <a class="w-full" href="{{route('activation-services')}}">Request a Activation</a>
                </li>

                <li class="px-2 py-1 transition-colors duration-150 hover:text-indigo-500 dark:hover:text-indigo-500">
                  <a class="w-full" href="{{route('services')}}">Services-Buy Now</a>
                </li>

                <li class="px-2 py-1 transition-colors duration-150 hover:text-indigo-500 dark:hover:text-indigo-500">
                  <a class="w-full" href="{{route('subscriptions')}}">Subscriptions</a>
                </li>

              </ul>
            </template>
        </li>

        {{-- Request Management --}}
        <li class="relative px-6 py-3">
          <button
              class="focus:outline-none inline-flex items-center justify-between w-full text-md font-semibold transition-colors duration-150 hover:text-indigo-200 dark:hover:text-gray-200"
              @click="toggleRequestManagementMenu"
              aria-haspopup="true"
          >
              <span class="inline-flex items-center">
                <svg viewBox="0 0 20 20" fill="currentColor" strokeWidth="2" class="w-5 h-5"><path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path><path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm9.707 5.707a1 1 0 00-1.414-1.414L9 12.586l-1.293-1.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                <span class="ml-4">Request Management</span>
              </span>
              <svg
                class="w-4 h-4"
                aria-hidden="true"
                fill="currentColor"
                viewBox="0 0 20 20"
              >
                <path
                  fill-rule="evenodd"
                  d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                  clip-rule="evenodd"
                ></path>
              </svg>
            </button>
            <template x-if="isRequestManagementMenuOpen">
              <ul
                x-transition:enter="transition-all ease-in-out duration-300"
                x-transition:enter-start="opacity-25 max-h-0"
                x-transition:enter-end="opacity-100 max-h-xl"
                x-transition:leave="transition-all ease-in-out duration-300"
                x-transition:leave-start="opacity-100 max-h-xl"
                x-transition:leave-end="opacity-0 max-h-0"
                class="p-2 mt-2 space-y-2 overflow-hidden text-sm font-medium text-gray-500 rounded-md shadow-inner bg-gray-100 dark:text-gray-400 dark:bg-gray-900"
                aria-label="submenu"
              >
                <li
                  class="px-2 py-1 transition-colors duration-150 hover:text-indigo-500 dark:hover:text-indigo-500"
                >
                  <a class="w-full" href="pages/login.html">Activation Services Request</a>
                </li>
                <li
                  class="px-2 py-1 transition-colors duration-150 hover:text-indigo-500 dark:hover:text-indigo-500"
                >
                  <a class="w-full" href="pages/create-account.html">Payment Services Request</a>
                </li>
                <li
                  class="px-2 py-1 transition-colors duration-150 hover:text-indigo-500 dark:hover:text-indigo-500"
                >
                  <a class="w-full" href="pages/forgot-password.html">Subscription Request</a>
                </li>
              </ul>
            </template>
        </li>

        {{-- MANAGEMENT --}}
        <li class="relative px-6 py-3">
          <button class="focus:outline-none inline-flex items-center justify-between w-full text-md font-semibold transition-colors duration-150 hover:text-indigo-200 dark:hover:text-gray-200"
              @click="toggleManagementMenu" aria-haspopup="true">
              <span class="inline-flex items-center">
                <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
                <span class="ml-4">Management</span>
              </span>
              <svg class="w-4 h-4" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
              </svg>
            </button>
            <template x-if="isManagementMenuOpen">
              <ul
                x-transition:enter="transition-all ease-in-out duration-300"
                x-transition:enter-start="opacity-25 max-h-0"
                x-transition:enter-end="opacity-100 max-h-xl"
                x-transition:leave="transition-all ease-in-out duration-300"
                x-transition:leave-start="opacity-100 max-h-xl"
                x-transition:leave-end="opacity-0 max-h-0"
                class="p-2 mt-2 space-y-2 overflow-hidden text-sm font-medium text-gray-500 rounded-md shadow-inner bg-gray-100 dark:text-gray-400 dark:bg-gray-900"
                aria-label="submenu">
                  <li class="px-2 py-1 transition-colors duration-150 hover:text-indigo-500 dark:hover:text-indigo-500">
                    <a class="w-full" href="{{route('resources.list')}}">Resources</a>
                  </li>
              </ul>
            </template>
        </li>

        {{-- USER MANAGEMENT --}}
        <li class="relative px-6 py-3">
          <button class="focus:outline-none inline-flex items-center justify-between w-full text-md font-semibold transition-colors duration-150 hover:text-indigo-200 dark:hover:text-gray-200"
              @click="toggleUserManagementMenu" aria-haspopup="true">
              <span class="inline-flex items-center">
                <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                  <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"></path>
                </svg>
                <span class="ml-4">User Management</span>
              </span>
              <svg class="w-4 h-4" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
              </svg>
            </button>
            <template x-if="isUserManagementMenuOpen">
              <ul
                x-transition:enter="transition-all ease-in-out duration-300"
                x-transition:enter-start="opacity-25 max-h-0"
                x-transition:enter-end="opacity-100 max-h-xl"
                x-transition:leave="transition-all ease-in-out duration-300"
                x-transition:leave-start="opacity-100 max-h-xl"
                x-transition:leave-end="opacity-0 max-h-0"
                class="p-2 mt-2 space-y-2 overflow-hidden text-sm font-medium text-gray-500 rounded-md shadow-inner bg-gray-100 dark:text-gray-400 dark:bg-gray-900"
                aria-label="submenu">

                @if (canView('user'))
                  <li class="px-2 py-1 transition-colors duration-150 hover:text-indigo-500 dark:hover:text-indigo-500">
                    <a class="w-full" href="{{route('users.index')}}">Users</a>
                  </li>
                @endif
                  
                @if (canView('role'))
                  <li class="px-2 py-1 transition-colors duration-150 hover:text-indigo-500 dark:hover:text-indigo-500">
                    <a class="w-full" href="{{route('roles.index')}}">Roles</a>
                  </li>
                @endif

                @if (canView('role'))
                  <li class="px-2 py-1 transition-colors duration-150 hover:text-indigo-500 dark:hover:text-indigo-500">
                    <a class="w-full" href="{{route('permissions.index')}}">Permissions</a>
                  </li>
                @endif
              </ul>
            </template>
        </li>

        {{-- ADMIN SETTINGS --}}
        <li class="relative px-6 py-3">
          <button class="focus:outline-none inline-flex items-center justify-between w-full text-md font-semibold transition-colors duration-150 hover:text-indigo-200 dark:hover:text-gray-200"
              @click="toggleAdminSettingsMenu" aria-haspopup="true">
              <span class="inline-flex items-center">
                <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                  <path d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path>
                </svg>
                <span class="ml-4">Admin Settings</span>
              </span>
              <svg class="w-4 h-4" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
              </svg>
            </button>
            <template x-if="isAdminSettingsMenuOpen">
              <ul
                x-transition:enter="transition-all ease-in-out duration-300"
                x-transition:enter-start="opacity-25 max-h-0"
                x-transition:enter-end="opacity-100 max-h-xl"
                x-transition:leave="transition-all ease-in-out duration-300"
                x-transition:leave-start="opacity-100 max-h-xl"
                x-transition:leave-end="opacity-0 max-h-0"
                class="p-2 mt-2 space-y-2 overflow-hidden text-sm font-medium text-gray-500 rounded-md shadow-inner bg-gray-100 dark:text-gray-400 dark:bg-gray-900"
                aria-label="submenu">
                <li class="px-2 py-1 transition-colors duration-150 hover:text-indigo-500 dark:hover:text-indigo-500">
                  <a class="w-full" href="{{route('activation-services.index')}}">Activation Services</a>
                </li>
                <li class="px-2 py-1 transition-colors duration-150 hover:text-indigo-500 dark:hover:text-indigo-500">
                  <a class="w-full" href="{{route('services.index')}}">Services</a>
                </li>
                {{--<li class="px-2 py-1 transition-colors duration-150 hover:text-indigo-500 dark:hover:text-indigo-500">
                  <a class="w-full" href="{{route('subscriptions.index')}}">Subscriptions</a>
                </li>--}}
                <li class="px-2 py-1 transition-colors duration-150 hover:text-indigo-500 dark:hover:text-indigo-500">
                  <a class="w-full" href="{{route('plans.index')}}">Plans</a>
                </li>
                
                <li class="px-2 py-1 transition-colors duration-150 hover:text-indigo-500 dark:hover:text-indigo-500">
                  <a class="w-full" href="{{route('products.index')}}">Products</a>
                </li>
                
                <li class="px-2 py-1 transition-colors duration-150 hover:text-indigo-500 dark:hover:text-indigo-500">
                  <a class="w-full" href="{{route('categories.index')}}">Categories</a>
                </li>
                <li class="px-2 py-1 transition-colors duration-150 hover:text-indigo-500 dark:hover:text-indigo-500">
                  <a class="w-full" href="{{route('experiences.index')}}">Experiences</a>
                </li>
                <li class="px-2 py-1 transition-colors duration-150 hover:text-indigo-500 dark:hover:text-indigo-500">
                  <a class="w-full" href="{{route('meal-plans.index')}}">Meal Plans</a>
                </li>
                <li class="px-2 py-1 transition-colors duration-150 hover:text-indigo-500 dark:hover:text-indigo-500">
                  <a class="w-full" href="{{route('occupancies.index')}}">Occupancies</a>
                </li>
                <li class="px-2 py-1 transition-colors duration-150 hover:text-indigo-500 dark:hover:text-indigo-500">
                  <a class="w-full" href="{{route('rate-plans.index')}}">Rate Plans</a>
                </li>
                <li class="px-2 py-1 transition-colors duration-150 hover:text-indigo-500 dark:hover:text-indigo-500">
                  <a class="w-full" href="{{route('restaurant-locations.index')}}">Restauran Locations</a>
                </li>
                <li class="px-2 py-1 transition-colors duration-150 hover:text-indigo-500 dark:hover:text-indigo-500">
                  <a class="w-full" href="{{route('restaurant-themes.index')}}">Restaurant Themes</a>
                </li>
                <li class="px-2 py-1 transition-colors duration-150 hover:text-indigo-500 dark:hover:text-indigo-500">
                  <a class="w-full" href="{{route('restaurant-types.index')}}">Restaurant Types</a>
                </li>
                <li class="px-2 py-1 transition-colors duration-150 hover:text-indigo-500 dark:hover:text-indigo-500">
                  <a class="w-full" href="{{route('room-types.index')}}">Room Types</a>
                </li>
                <li class="px-2 py-1 transition-colors duration-150 hover:text-indigo-500 dark:hover:text-indigo-500">
                  <a class="w-full" href="{{route('types.index')}}">Types</a>
                </li>
              </ul>
            </template>
        </li>
{{--
        <li class="relative px-6 py-3">
            {!! request()->routeIs('forms') ? '<span class="absolute inset-y-0 left-0 w-1 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>' : '' !!}
            <a data-turbolinks-action="replace" class="inline-flex items-center w-full text-md font-semibold transition-colors duration-150 hover:text-indigo-200 dark:hover:text-indigo-500" href="{{route('forms')}}">
                <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                    <path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01">
                    </path>
                </svg>
                <span class="ml-4">Forms</span>
            </a>
        </li>
        <li class="relative px-6 py-3">
            {!! request()->routeIs('cards') ? '<span class="absolute inset-y-0 left-0 w-1 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>' : '' !!}
            <a class="inline-flex items-center w-full text-md font-semibold transition-colors duration-150 hover:text-indigo-200 dark:hover:text-indigo-500" href="{{route('cards')}}">
                <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                    <path d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                    </path>
                </svg>
                <span class="ml-4">Cards</span>
            </a>
        </li>
        <li class="relative px-6 py-3">
            {!! request()->routeIs('charts') ? '<span class="absolute inset-y-0 left-0 w-1 bg-indigo-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>' : '' !!}
            <a class="inline-flex items-center w-full text-md font-semibold transition-colors duration-150 hover:text-indigo-500 dark:hover:text-indigo-500" href="{{route('charts')}}">
                <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                    <path d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path>
                    <path d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path>
                </svg>
                <span class="ml-4">Charts</span>
            </a>
        </li>
        <li class="relative px-6 py-3">
            {!! request()->routeIs('buttons') ? '<span class="absolute inset-y-0 left-0 w-1 bg-indigo-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>' : '' !!}
            <a class="inline-flex items-center w-full text-md font-semibold transition-colors duration-150 hover:text-indigo-500 dark:hover:text-indigo-500" href="{{route('buttons')}}">
                <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                    <path d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122">
                    </path>
                </svg>
                <span class="ml-4">Buttons</span>
            </a>
        </li>
        <li class="relative px-6 py-3">
            {!! request()->routeIs('modals') ? '<span class="absolute inset-y-0 left-0 w-1 bg-indigo-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>' : '' !!}
            <a class="inline-flex items-center w-full text-md font-semibold transition-colors duration-150 hover:text-indigo-500 dark:hover:text-indigo-500" href="{{route('modals')}}">
                <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                    <path d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z">
                    </path>
                </svg>
                <span class="ml-4">Modals</span>
            </a>
        </li>
        <li class="relative px-6 py-3">
            {!! request()->routeIs('tables') ? '<span class="absolute inset-y-0 left-0 w-1 bg-indigo-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>' : '' !!}
            <a class="inline-flex items-center w-full text-md font-semibold transition-colors duration-150 hover:text-indigo-500 dark:hover:text-indigo-500" href="{{route('tables')}}">
                <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                    <path d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                </svg>
                <span class="ml-4">Tables</span>
            </a>
        </li>
        <li class="relative px-6 py-3">
            {!! request()->routeIs('calendar') ? '<span class="absolute inset-y-0 left-0 w-1 bg-indigo-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>' : '' !!}
            <a class="inline-flex items-center w-full text-md font-semibold transition-colors duration-150 hover:text-indigo-500 dark:hover:text-indigo-500" href="{{route('calendar')}}">
                <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                    <path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                <span class="ml-4">Calendar</span>
            </a>
        </li>
     --}}   
    </ul>
</div>
