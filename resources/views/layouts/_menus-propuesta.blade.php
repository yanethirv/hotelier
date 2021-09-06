
  <!-- Dashboards links -->
  <div class="flex-1 px-2 py-4 space-y-2 overflow-y-hidden hover:overflow-y-auto">
    <!-- logo -->
    <a href="#" class="flex items-center space-x-2 px-4 text-gray-100">
      <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
      </svg>
      <span class="text-2xl font-extrabold text-gray-100">Hotelier Hub</span>
    </a>

    <!-- nav -->
    <nav>
      @if (auth()->user()->hasRole('user'))
        <a href="{{route('launch')}}" data-turbolinks-action="replace" 
          class="block py-2.5 px-4 rounded transition duration-200 text-gray-100 hover:bg-blue-600 hover:text-white hover:font-extrabold">
          <span aria-hidden="true"><i class="fas fa-rocket"></i></span>
          <span class="ml-2 font-semibold"> Launchpad </span>
        </a>
      @endif

      <!-- Dashboard link -->
      <a href="{{route('dashboard')}}" data-turbolinks-action="replace"
        class="block py-2.5 px-4 rounded transition duration-200 text-gray-100 hover:bg-blue-600">
        <span aria-hidden="true"><i class="fas fa-home"></i></span>
        <span class="ml-2 font-semibold"> Dashboard </span>
      </a>

      <!-- Resources link -->
      <a href="{{route('resources')}}" data-turbolinks-action="replace"
        class="block py-2.5 px-4 rounded transition duration-200 text-gray-100 hover:bg-blue-600">
        <span aria-hidden="true"><i class="fas fa-book"></i></span>
        <span class="ml-2 font-semibold"> Resources </span>
      </a>

      <!-- Billing links -->
      <a class="block py-2.5 px-4 rounded transition duration-200 text-gray-100">
        <span aria-hidden="true"><i class="far fa-credit-card"></i></span>
        <span class="ml-2 font-semibold"> Billing </span>
      </a>
        <a href="{{route('payment.methods')}}" data-turbolinks-action="replace"
          class="block py-2.5 pl-10 rounded transition duration-200 text-sm font-semibold hover:text-blue-500">
          Payment Methods
        </a>
        <a href="{{route('invoices')}}" data-turbolinks-action="replace"
          class="block py-2.5 pl-10 rounded transition duration-200 text-sm font-semibold hover:text-blue-500">
          Invoices
        </a>

      <!-- Request Management links -->
      <a class="block py-2.5 px-4 rounded transition duration-200">
        <span aria-hidden="true"><i class="fas fa-tasks"></i></span>
        <span class="ml-2 font-semibold"> Request Management </span>
      </a>
        <a href="{{route('activation-services-requests')}}" data-turbolinks-action="replace"
          class="block py-2.5 pl-10 rounded transition duration-200 text-sm font-semibold hover:text-blue-500">
          Activation Services Requests
        </a>
        <a href="{{route('plans-requests')}}" data-turbolinks-action="replace"
          class="block py-2.5 pl-10 rounded transition duration-200 text-sm font-semibold hover:text-blue-500">
          Plans Requests
        </a>
        <a href="{{route('services-requests')}}" data-turbolinks-action="replace"
          class="block py-2.5 pl-10 rounded transition duration-200 text-sm font-semibold hover:text-blue-500">
          Plans Requests
        </a>
        <a href="{{route('subscriptions-requests')}}" data-turbolinks-action="replace"
          class="block py-2.5 pl-10 rounded transition duration-200 text-sm font-semibold hover:text-blue-500">
          Subscriptions Requests
        </a>

      <!-- Marketplace links -->
      <a class="block py-2.5 px-4 rounded transition duration-200">
        <span aria-hidden="true"><i class="fas fa-store"></i></span>
        <span class="ml-2 font-semibold"> Marketplace </span>
      </a>
        <a href="{{route('plans.marketplace')}}" data-turbolinks-action="replace"
          class="block py-2.5 pl-10 rounded transition duration-200 text-sm font-semibold hover:text-blue-500">
          Plans
        </a>
        <a href="{{route('activation-services')}}" data-turbolinks-action="replace"
          class="block py-2.5 pl-10 rounded transition duration-200 text-sm font-semibold hover:text-blue-500">
          Request a Activation
        </a>
        <a href="{{route('services')}}" data-turbolinks-action="replace"
          class="block py-2.5 pl-10 rounded transition duration-200 text-sm font-semibold hover:text-blue-500">
          Services-Buy Now
        </a>
        <a href="{{route('subscriptions')}}" data-turbolinks-action="replace"
          class="block py-2.5 pl-10 rounded transition duration-200 text-sm font-semibold hover:text-blue-500">
          Subscriptions
        </a>

      <!-- Management links -->
      <a class="block py-2.5 px-4 rounded transition duration-200">
        <span aria-hidden="true"><i class="fas fa-layer-group"></i></span>
        <span class="ml-2 font-semibold"> Management </span>
      </a>
        <a href="{{route('resources.list')}}" data-turbolinks-action="replace"
          class="block py-2.5 pl-10 rounded transition duration-200 text-sm font-semibold hover:text-blue-500">
          Resources
        </a>

      <!-- User Management links -->
      <a class="block py-2.5 px-4 rounded transition duration-200">
        <span aria-hidden="true"><i class="fas fa-users-cog"></i></span>
        <span class="ml-2 font-semibold"> User Management </span>
      </a>
        <a href="{{route('users.index')}}" data-turbolinks-action="replace"
          class="block py-2.5 pl-10 rounded transition duration-200 text-sm font-semibold hover:text-blue-500">
          Users
        </a>
        <a href="{{route('roles.index')}}" data-turbolinks-action="replace"
          class="block py-2.5 pl-10 rounded transition duration-200 text-sm font-semibold hover:text-blue-500">
          Roles
        </a>
        <a href="{{route('permissions.index')}}" data-turbolinks-action="replace"
          class="block py-2.5 pl-10 rounded transition duration-200 text-sm font-semibold hover:text-blue-500">
          Permissions
        </a>

      <!-- Hotel Settings links -->
      <a class="block py-2.5 px-4 rounded transition duration-200">
        <span aria-hidden="true"><i class="fas fa-laptop-code"></i></span>
        <span class="ml-2 font-semibold "> Hotel Settings </span>
      </a>
        <a href="{{route('amenities.index')}}" data-turbolinks-action="replace"
          class="block py-2.5 pl-10 rounded transition duration-200 text-sm font-semibold hover:text-blue-500">
          Amenities
        </a>
        <a href="{{route('categories.index')}}" data-turbolinks-action="replace"
          class="block py-2.5 pl-10 rounded transition duration-200 text-sm font-semibold hover:text-blue-500">
          Categories
        </a>
        <a href="{{route('experiences.index')}}" data-turbolinks-action="replace"
          class="block py-2.5 pl-10 rounded transition duration-200 text-sm font-semibold hover:text-blue-500">
          Experiences
        </a>
        <a href="{{route('occupancies.index')}}" data-turbolinks-action="replace"
          class="block py-2.5 pl-10 rounded transition duration-200 text-sm font-semibold hover:text-blue-500">
          Occupancies
        </a>
        <a href="{{route('restaurant-locations.index')}}" data-turbolinks-action="replace"
          class="block py-2.5 pl-10 rounded transition duration-200 text-sm font-semibold hover:text-blue-500">
          Restaurant Locations
        </a>
        <a href="{{route('restaurant-themes.index')}}" data-turbolinks-action="replace"
          class="block py-2.5 pl-10 rounded transition duration-200 text-sm font-semibold hover:text-blue-500">
          Restaurant Themes
        </a>
        <a href="{{route('restaurant-types.index')}}" data-turbolinks-action="replace"
          class="block py-2.5 pl-10 rounded transition duration-200 text-sm font-semibold hover:text-blue-500">
          Restaurant Types
        </a>
        <a href="{{route('room-ranges.index')}}" data-turbolinks-action="replace"
          class="block py-2.5 pl-10 rounded transition duration-200 text-sm font-semibold hover:text-blue-500">
          Room Ranges
        </a>
        <a href="{{route('room-types.index')}}" data-turbolinks-action="replace"
          class="block py-2.5 pl-10 rounded transition duration-200 text-sm font-semibold hover:text-blue-500">
          Room Types
        </a>

      <!-- Marketplace Settings links -->
      <a class="block py-2.5 px-4 rounded transition duration-200 text-gray-100 bg-blue-700">
        <span aria-hidden="true"><i class="fas fa-cogs"></i></span>
        <span class="ml-2 text-sm"> Marketplace Settings </span>
      </a>
        <a href="{{route('types.index')}}" data-turbolinks-action="replace"
          class="block py-2.5 pl-10 rounded transition duration-200 text-sm hover:text-gray-400">
          Types
        </a>
        <a href="{{route('activation-services.index')}}" data-turbolinks-action="replace"
          class="block py-2.5 pl-10 rounded transition duration-200 text-sm hover:text-gray-400">
          Activation Services
        </a>
        <a href="{{route('services.index')}}" data-turbolinks-action="replace"
          class="block py-2.5 pl-10 rounded transition duration-200 text-sm hover:text-gray-400">
          Services
        </a>
        <a href="{{route('plans.index')}}" data-turbolinks-action="replace"
          class="block py-2.5 pl-10 rounded transition duration-200 text-sm hover:text-gray-400">
          Plans
        </a>
        <a href="{{route('products.index')}}" data-turbolinks-action="replace"
          class="block py-2.5 pl-10 rounded transition duration-200 text-sm hover:text-gray-400">
          Products
        </a>

      <!-- Reports links -->
      <a class="block py-2.5 px-4 rounded transition duration-200 text-gray-100 bg-blue-700">
        <span aria-hidden="true"><i class="fas fa-chart-pie"></i></span>
        <span class="ml-2 text-sm"> Reports </span>
      </a>
        <a href="#" data-turbolinks-action="replace"
          class="block py-2.5 pl-10 rounded transition duration-200 text-sm hover:text-gray-400">
          Charts
        </a>

      <!-- Communication links -->
      <a class="block py-2.5 px-4 rounded transition duration-200 text-gray-100 bg-blue-700">
        <span aria-hidden="true"><i class="fas fa-comments"></i></span>
        <span class="ml-2 text-sm"> Communication </span>
      </a>
        <a href="#" data-turbolinks-action="replace"
          class="block py-2.5 pl-10 rounded transition duration-200 text-sm hover:text-gray-400">
          Send Message
        </a>
        <a href="#" data-turbolinks-action="replace"
          class="block py-2.5 pl-10 rounded transition duration-200 text-sm hover:text-gray-400">
          Send Massive Message
        </a>
        <a href="{{route('notifications.index')}}" data-turbolinks-action="replace"
          class="block py-2.5 pl-10 rounded transition duration-200 text-sm hover:text-gray-400">
          Notifications
        </a>

      <!-- Hotels links -->
      <a class="block py-2.5 px-4 rounded transition duration-200 text-gray-100 bg-blue-700">
        <span aria-hidden="true"><i class="fas fa-comments"></i></span>
        <span class="ml-2 text-sm"> My Hotel </span>
      </a>
        <a href="{{route('hotels.index')}}" data-turbolinks-action="replace"
          class="block py-2.5 pl-10 rounded transition duration-200 text-sm hover:text-gray-400">
          Hotels
        </a>
        <a href="{{route('rooms.index')}}" data-turbolinks-action="replace"
          class="block py-2.5 pl-10 rounded transition duration-200 text-sm hover:text-gray-400">
          Rooms
        </a>
        <a href="{{route('restaurants.index')}}" data-turbolinks-action="replace"
          class="block py-2.5 pl-10 rounded transition duration-200 text-sm hover:text-gray-400">
          Restaurants
        </a>
        <a href="{{route('meal-plans.index')}}" data-turbolinks-action="replace"
          class="block py-2.5 pl-10 rounded transition duration-200 text-sm hover:text-gray-400">
          Meal Plans
        </a>
        <a href="{{route('rate-plans.index')}}" data-turbolinks-action="replace"
          class="block py-2.5 pl-10 rounded transition duration-200 text-sm hover:text-gray-400 
          {{ (request()->is('hotel/rate-plans')) ? 'bg-blue-500' : '' }}">
          Rate Plans
        </a>
    </nav>

    <div x-show="open" class="mt-2 space-y-2 px-7" role="menu" aria-label="Authentication">
      <!-- active & hover classes 'text-gray-700 dark:text-light' -->
      <!-- inActive classes 'text-gray-400 dark:text-gray-400' -->
      <a
        href="#"
        role="menuitem"
        class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:text-gray-400 dark:hover:text-light hover:text-gray-700"
      >
        Two Columns Sidebar
      </a>
      <a
        href="#"
        role="menuitem"
        class="block p-2 text-sm text-gray-700 transition-colors duration-200 rounded-md dark:text-light dark:hover:text-light hover:text-gray-700"
      >
        Mini + One Columns Sidebar
      </a>
    </div>
    
  </div>