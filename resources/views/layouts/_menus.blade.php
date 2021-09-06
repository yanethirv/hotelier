
  <!-- Dashboards links -->
  <div class="flex-1 px-2 py-4 space-y-2 overflow-y-hidden hover:overflow-y-auto">
    <!-- logo -->
    <a href="#" class="flex items-center space-x-2 p-4 text-gray-100">
      <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
      </svg>
      <span class="text-2xl font-extrabold text-gray-100">Hotelier Hub</span>
    </a>

    <!-- nav -->
    <nav>
      @if (auth()->user()->hasanyrole('Hotelier'))
        <a href="{{route('launch')}}" data-turbolinks-action="replace"
          class="block py-2.5 px-4 rounded transition duration-200 hover:bg-blue-600 hover:text-white
            border-l-4 border-transparent hover:border-blue-400
            {{ (request()->is('launch')) ? 'bg-blue-500 text-white' : 'text-gray-100' }}">
          <span aria-hidden="true"><i class="fas fa-rocket"></i></span>
          <span class="ml-2 font-semibold"> Launchpad </span>
        </a>
      @endif

      <!-- Dashboard link -->
      <a href="{{route('dashboard')}}" data-turbolinks-action="replace"
        class="block py-2.5 px-4 rounded transition duration-200 hover:bg-blue-600 hover:text-white
        border-l-4 border-transparent hover:border-blue-400
        {{ (request()->is('dashboard')) ? 'bg-blue-500 text-white' : 'text-gray-100' }}">
        <span aria-hidden="true"><i class="fas fa-home"></i></span>
        <span class="ml-2 font-semibold"> Dashboard </span>
      </a>

      <!-- Resources link -->
      <a href="{{route('resources')}}" data-turbolinks-action="replace"
        class="block py-2.5 px-4 rounded transition duration-200 hover:bg-blue-600 hover:text-white
        border-l-4 border-transparent hover:border-blue-400
        {{ (request()->is('resources')) ? 'bg-blue-500 text-white' : 'text-gray-100' }}">
        <span aria-hidden="true"><i class="fas fa-book"></i></span>
        <span class="ml-2 font-semibold"> Resources </span>
      </a>

      <!-- Hotel links -->
      @if (auth()->user()->hasanyrole('Super Admin|Manager|Platform Manager'))
        <a href="{{route('hotels.list')}}" data-turbolinks-action="replace"
          class="block py-2.5 px-4 rounded transition duration-200 hover:bg-blue-600 hover:text-white
          border-l-4 border-transparent hover:border-blue-400
          {{ (request()->is('hotels')) ? 'bg-blue-500 text-white' : 'text-gray-100' }}">
          <span aria-hidden="true"><i class="fas fa-hotel"></i></span>
          <span class="ml-2 font-semibold"> Hotels </span>
        </a>
      @endif

      <!-- Fee Invoices links -->
      @if (auth()->user()->hasanyrole('Super Admin|Platform Manager|Hotelier'))
        <a class="block py-2.5 px-4 rounded transition duration-200 text-white bg-blue-800">
          <span aria-hidden="true"><i class="fas fa-cogs"></i></span>
          <span class="ml-2 font-semibold"> Invoices </span>
        </a>

        <a href="{{route('fee-invoices.index')}}" data-turbolinks-action="replace"
          class="block py-2.5 pl-10 rounded transition duration-200 hover:bg-blue-600 hover:text-white 
          border-l-4 border-transparent hover:border-blue-400
          {{ (request()->is('invoices/fee-invoices')) ? 'bg-blue-500 text-white' : 'text-gray-100' }}">
            Fee Invoices
        </a>
      @endif

      <!-- Billing links -->
      @if (auth()->user()->hasanyrole('Hotelier'))
        <a class="block py-2.5 px-4 rounded transition duration-200 text-white bg-blue-800">
          <span aria-hidden="true"><i class="far fa-credit-card"></i></span>
          <span class="ml-2 font-semibold"> Billing </span>
        </a>
        <a href="{{route('payment.methods')}}" data-turbolinks-action="replace"
          class="block py-2.5 pl-10 rounded transition duration-200 hover:bg-blue-600 hover:text-white
          border-l-4 border-transparent hover:border-blue-400
          {{ (request()->is('billing/payment-methods')) ? 'bg-blue-500 text-white' : 'text-gray-100' }}">
            Payment Methods
        </a>
        <a href="{{route('invoices')}}" data-turbolinks-action="replace"
          class="block py-2.5 pl-10 rounded transition duration-200 hover:bg-blue-600 hover:text-white
          border-l-4 border-transparent hover:border-blue-400
          {{ (request()->is('billing/invoices')) ? 'bg-blue-500 text-white' : 'text-gray-100' }}">
            Invoices
        </a>
        <a href="{{route('fee.invoices.index')}}" data-turbolinks-action="replace"
          class="block py-2.5 pl-10 rounded transition duration-200 hover:bg-blue-600 hover:text-white 
          border-l-4 border-transparent hover:border-blue-400
          {{ (request()->is('billing/fee-invoices')) ? 'bg-blue-500 text-white' : 'text-gray-100' }}">
            Fee Invoices
        </a>
      @endif

      <!-- Request Management links -->
      @if (auth()->user()->hasanyrole('Super Admin|Platform Manager'))
        <a class="block py-2.5 px-4 rounded transition duration-200 text-white bg-blue-800">
          <span aria-hidden="true"><i class="fas fa-tasks"></i></span>
          <span class="ml-2 font-semibold"> Request Management </span>
        </a>
        <a href="{{route('activation-services-requests')}}" data-turbolinks-action="replace"
          class="block py-2.5 pl-10 rounded transition duration-200 hover:bg-blue-600 hover:text-white
          border-l-4 border-transparent hover:border-blue-400
          {{ (request()->is('request-management/activation-services-requests')) ? 'bg-blue-500 text-white' : 'text-gray-100' }}">
            Activation Services Requests
        </a>
        <a href="{{route('plans-requests')}}" data-turbolinks-action="replace"
          class="block py-2.5 pl-10 rounded transition duration-200 hover:bg-blue-600 hover:text-white
          border-l-4 border-transparent hover:border-blue-400
          {{ (request()->is('request-management/plans-requests')) ? 'bg-blue-500 text-white' : 'text-gray-100' }}">
            Plans Requests
        </a>
        <a href="{{route('services-requests')}}" data-turbolinks-action="replace"
          class="block py-2.5 pl-10 rounded transition duration-200 hover:bg-blue-600 hover:text-white
          border-l-4 border-transparent hover:border-blue-400
          {{ (request()->is('request-management/services-requests')) ? 'bg-blue-500 text-white' : 'text-gray-100' }}">
            Services Requests
        </a>
        <a href="{{route('subscriptions-requests')}}" data-turbolinks-action="replace"
          class="block py-2.5 pl-10 rounded transition duration-200 hover:bg-blue-600 hover:text-white 
          border-l-4 border-transparent hover:border-blue-400
          {{ (request()->is('request-management/subscriptions-requests')) ? 'bg-blue-500 text-white' : 'text-gray-100' }}">
            Subscriptions Requests
        </a>
      @endif

      <!-- Marketplace links -->
      @if (auth()->user()->hasanyrole('Hotelier'))
        <a class="block py-2.5 px-4 rounded transition duration-200 text-white bg-blue-800">
          <span aria-hidden="true"><i class="fas fa-store"></i></span>
          <span class="ml-2 font-semibold"> Marketplace </span>
        </a>
        <a href="{{route('plans.marketplace')}}" data-turbolinks-action="replace"
          class="block py-2.5 pl-10 rounded transition duration-200 hover:bg-blue-600 hover:text-white 
          border-l-4 border-transparent hover:border-blue-400
          {{ (request()->is('marketplace/plans')) ? 'bg-blue-500 text-white' : 'text-gray-100' }}">
            Plans
        </a>
        <a href="{{route('activation-services')}}" data-turbolinks-action="replace"
          class="block py-2.5 pl-10 rounded transition duration-200 hover:bg-blue-600 hover:text-white 
          border-l-4 border-transparent hover:border-blue-400
          {{ (request()->is('marketplace/activation-services')) ? 'bg-blue-500 text-white' : 'text-gray-100' }}">
            Request a Activation
        </a>
        <a href="{{route('services')}}" data-turbolinks-action="replace"
          class="block py-2.5 pl-10 rounded transition duration-200 hover:bg-blue-600 hover:text-white 
          border-l-4 border-transparent hover:border-blue-400
          {{ (request()->is('marketplace/services')) ? 'bg-blue-500 text-white' : 'text-gray-100' }}">
            Services-Buy Now
        </a>
        <a href="{{route('subscriptions')}}" data-turbolinks-action="replace"
          class="block py-2.5 pl-10 rounded transition duration-200 hover:bg-blue-600 hover:text-white 
          border-l-4 border-transparent hover:border-blue-400
          {{ (request()->is('marketplace/subscriptions')) ? 'bg-blue-500 text-white' : 'text-gray-100' }}">
            Subscriptions
        </a>
      @endif

      <!-- Management links -->
      @if (auth()->user()->hasanyrole('Super Admin|Platform Manager|Manager'))
        <a class="block py-2.5 px-4 rounded transition duration-200 text-white bg-blue-800">
          <span aria-hidden="true"><i class="fas fa-layer-group"></i></span>
          <span class="ml-2 font-semibold"> Management </span>
        </a>
        <a href="{{route('resources.list')}}" data-turbolinks-action="replace"
          class="block py-2.5 pl-10 rounded transition duration-200 hover:bg-blue-600 hover:text-white 
          border-l-4 border-transparent hover:border-blue-400
          {{ (request()->is('management/resources')) ? 'bg-blue-500 text-white' : 'text-gray-100' }}">
            Resources
        </a>
      @endif

      <!-- User Management links -->
      @if (auth()->user()->hasanyrole('Super Admin|Platform Manager'))
        <a class="block py-2.5 px-4 rounded transition duration-200 text-white bg-blue-800">
          <span aria-hidden="true"><i class="fas fa-users-cog"></i></span>
          <span class="ml-2 font-semibold"> User Management </span>
        </a>
        <a href="{{route('users.index')}}" data-turbolinks-action="replace"
          class="block py-2.5 pl-10 rounded transition duration-200 hover:bg-blue-600 hover:text-white 
          border-l-4 border-transparent hover:border-blue-400
          {{ (request()->is('user-management/users')) ? 'bg-blue-500 text-white' : 'text-gray-100' }}">
            Users
        </a>
        <a href="{{route('roles.index')}}" data-turbolinks-action="replace"
          class="block py-2.5 pl-10 rounded transition duration-200 text-gray-100 hover:bg-blue-600 hover:text-white 
          border-l-4 border-transparent hover:border-blue-400
          {{ (request()->is('user-management/roles')) ? 'bg-blue-500 text-white' : 'text-gray-100' }}">
            Roles
        </a>
        <a href="{{route('permissions.index')}}" data-turbolinks-action="replace"
          class="block py-2.5 pl-10 rounded transition duration-200 hover:bg-blue-600 hover:text-white 
          border-l-4 border-transparent hover:border-blue-400
          {{ (request()->is('user-management/permissions')) ? 'bg-blue-500 text-white' : 'text-gray-100' }}">
            Permissions
        </a>
      @endif

      <!-- Hotel Settings links -->
      @if (auth()->user()->hasanyrole('Super Admin|Platform Manager'))
      <a class="block py-2.5 px-4 rounded transition duration-200 text-white bg-blue-800">
        <span aria-hidden="true"><i class="fas fa-laptop-code"></i></span>
        <span class="ml-2 font-semibold "> Hotel Settings </span>
      </a>
        <a href="{{route('amenities.index')}}" data-turbolinks-action="replace"
        class="block py-2.5 pl-10 rounded transition duration-200  hover:bg-blue-600 hover:text-white 
        border-l-4 border-transparent hover:border-blue-400
        {{ (request()->is('hotel-settings/amenities')) ? 'bg-blue-500 text-white' : 'text-gray-100' }}">
          Amenities
        </a>
        <a href="{{route('categories.index')}}" data-turbolinks-action="replace"
        class="block py-2.5 pl-10 rounded transition duration-200 hover:bg-blue-600 hover:text-white 
        border-l-4 border-transparent hover:border-blue-400
        {{ (request()->is('hotel-settings/categories')) ? 'bg-blue-500 text-white' : 'text-gray-100' }}">
          Categories
        </a>
        <a href="{{route('experiences.index')}}" data-turbolinks-action="replace"
        class="block py-2.5 pl-10 rounded transition duration-200 hover:bg-blue-600 hover:text-white 
        border-l-4 border-transparent hover:border-blue-400
        {{ (request()->is('hotel-settings/experiences')) ? 'bg-blue-500 text-white' : 'text-gray-100' }}">
          Experiences
        </a>
        <a href="{{route('occupancies.index')}}" data-turbolinks-action="replace"
        class="block py-2.5 pl-10 rounded transition duration-200 hover:bg-blue-600 hover:text-white 
        border-l-4 border-transparent hover:border-blue-400
        {{ (request()->is('hotel-settings/occupancies')) ? 'bg-blue-500 text-white' : 'text-gray-100' }}">
          Occupancies
        </a>
        <a href="{{route('photo-locations.index')}}" data-turbolinks-action="replace"
        class="block py-2.5 pl-10 rounded transition duration-200 hover:bg-blue-600 hover:text-white 
        border-l-4 border-transparent hover:border-blue-400
        {{ (request()->is('hotel-settings/photo-locations')) ? 'bg-blue-500 text-white' : 'text-gray-100' }}">
          Photo Locations
        </a>
        <a href="{{route('policy-types.index')}}" data-turbolinks-action="replace"
        class="block py-2.5 pl-10 rounded transition duration-200 hover:bg-blue-600 hover:text-white 
        border-l-4 border-transparent hover:border-blue-400
        {{ (request()->is('hotel-settings/policy-types')) ? 'bg-blue-500 text-white' : 'text-gray-100' }}">
          Policy Types
        </a>
        <a href="{{route('restaurant-locations.index')}}" data-turbolinks-action="replace"
        class="block py-2.5 pl-10 rounded transition duration-200 hover:bg-blue-600 hover:text-white 
        border-l-4 border-transparent hover:border-blue-400
        {{ (request()->is('hotel-settings/restaurant-locations')) ? 'bg-blue-500 text-white' : 'text-gray-100' }}">
          Restaurant Locations
        </a>
        <a href="{{route('restaurant-themes.index')}}" data-turbolinks-action="replace"
        class="block py-2.5 pl-10 rounded transition duration-200 hover:bg-blue-600 hover:text-white 
        border-l-4 border-transparent hover:border-blue-400
        {{ (request()->is('hotel-settings/restaurant-themes')) ? 'bg-blue-500 text-white' : 'text-gray-100' }}">
          Restaurant Themes
        </a>
        <a href="{{route('restaurant-types.index')}}" data-turbolinks-action="replace"
        class="block py-2.5 pl-10 rounded transition duration-200 hover:bg-blue-600 hover:text-white 
        border-l-4 border-transparent hover:border-blue-400
        {{ (request()->is('hotel-settings/restaurant-types')) ? 'bg-blue-500 text-white' : 'text-gray-100' }}">
          Restaurant Types
        </a>
        <a href="{{route('room-ranges.index')}}" data-turbolinks-action="replace"
        class="block py-2.5 pl-10 rounded transition duration-200 hover:bg-blue-600 hover:text-white 
        border-l-4 border-transparent hover:border-blue-400
        {{ (request()->is('hotel-settings/room-ranges')) ? 'bg-blue-500 text-white' : 'text-gray-100' }}">
          Room Ranges
        </a>
        <a href="{{route('room-types.index')}}" data-turbolinks-action="replace"
        class="block py-2.5 pl-10 rounded transition duration-200 hover:bg-blue-600 hover:text-white 
        border-l-4 border-transparent hover:border-blue-400
        {{ (request()->is('hotel-settings/room-types')) ? 'bg-blue-500 text-white' : 'text-gray-100' }}">
          Room Types
        </a>
      @endif

      <!-- Marketplace Settings links -->
      @if (auth()->user()->hasanyrole('Super Admin|Platform Manager|Hotelier'))
        <a class="block py-2.5 px-4 rounded transition duration-200 text-white bg-blue-800">
          <span aria-hidden="true"><i class="fas fa-cogs"></i></span>
          <span class="ml-2 font-semibold"> Marketplace Settings </span>
        </a>
        <a href="{{route('types.index')}}" data-turbolinks-action="replace"
          class="block py-2.5 pl-10 rounded transition duration-200 hover:bg-blue-600 hover:text-white 
          border-l-4 border-transparent hover:border-blue-400
          {{ (request()->is('marketplace-settings/types')) ? 'bg-blue-500 text-white' : 'text-gray-100' }}">
            Types
        </a>
        <a href="{{route('activation-services.index')}}" data-turbolinks-action="replace"
          class="block py-2.5 pl-10 rounded transition duration-200 hover:bg-blue-600 hover:text-white 
          border-l-4 border-transparent hover:border-blue-400
          {{ (request()->is('marketplace-settings/activation-services')) ? 'bg-blue-500 text-white' : 'text-gray-100' }}">
            Activation Services
        </a>
        <a href="{{route('services.index')}}" data-turbolinks-action="replace"
          class="block py-2.5 pl-10 rounded transition duration-200 hover:bg-blue-600 hover:text-white 
          border-l-4 border-transparent hover:border-blue-400
          {{ (request()->is('marketplace-settings/services')) ? 'bg-blue-500 text-white' : 'text-gray-100' }}">
            Services
        </a>
        <a href="{{route('plans.index')}}" data-turbolinks-action="replace"
          class="block py-2.5 pl-10 rounded transition duration-200 hover:bg-blue-600 hover:text-white 
          border-l-4 border-transparent hover:border-blue-400
          {{ (request()->is('marketplace-settings/plans')) ? 'bg-blue-500 text-white' : 'text-gray-100' }}">
            Plans
        </a>
        <a href="{{route('products.index')}}" data-turbolinks-action="replace"
          class="block py-2.5 pl-10 rounded transition duration-200 hover:bg-blue-600 hover:text-white 
          border-l-4 border-transparent hover:border-blue-400
          {{ (request()->is('marketplace-settings/products')) ? 'bg-blue-500 text-white' : 'text-gray-100' }}">
            Products
        </a>
      @endif

      <!-- Reports links -->
      @if (auth()->user()->hasanyrole('Super Admin|Platform Manager|Manager'))
        <a class="block py-2.5 px-4 rounded transition duration-200 text-white bg-blue-800">
          <span aria-hidden="true"><i class="fas fa-chart-pie"></i></span>
          <span class="ml-2 font-semibold"> Reports </span>
        </a>
        <a href="#" data-turbolinks-action="replace"
          class="block py-2.5 pl-10 rounded transition duration-200 hover:bg-blue-600 hover:text-white 
          border-l-4 border-transparent hover:border-blue-400
          {{ (request()->is('hotel/notifications')) ? 'bg-blue-500 text-white' : 'text-gray-100' }}">
          Charts
        </a>
      @endif

      <!-- Hotels links -->
      @if (auth()->user()->hasanyrole('Hotelier'))
        <a class="block py-2.5 px-4 rounded transition duration-200 text-white bg-blue-800">
          <span aria-hidden="true"><i class="fas fa-hotel"></i></span>
          <span class="ml-2 font-semibold"> My Hotel </span>
        </a>
        <a href="{{route('hotels.index')}}" data-turbolinks-action="replace"
          class="block py-2.5 pl-10 rounded transition duration-200 hover:bg-blue-600 hover:text-white 
          border-l-4 border-transparent hover:border-blue-400
          {{ (request()->is('hotel/hotels')) ? 'bg-blue-500 text-white' : 'text-gray-100' }}">
          Hotels
        </a>
        <a href="{{route('rooms.index')}}" data-turbolinks-action="replace"
          class="block py-2.5 pl-10 rounded transition duration-200 hover:bg-blue-600 hover:text-white 
          border-l-4 border-transparent hover:border-blue-400
          {{ (request()->is('hotel/rooms')) ? 'bg-blue-500 text-white' : 'text-gray-100' }}">
          Rooms
        </a>
        <a href="{{route('restaurants.index')}}" data-turbolinks-action="replace"
          class="block py-2.5 pl-10 rounded transition duration-200 hover:bg-blue-600 hover:text-white 
          border-l-4 border-transparent hover:border-blue-400
          {{ (request()->is('hotel/restaurants')) ? 'bg-blue-500 text-white' : 'text-gray-100' }}">
          Restaurants
        </a>
        <a href="{{route('meal-plans.index')}}" data-turbolinks-action="replace"
          class="block py-2.5 pl-10 rounded transition duration-200 hover:bg-blue-600 hover:text-white 
          border-l-4 border-transparent hover:border-blue-400
          {{ (request()->is('hotel/meal-plans')) ? 'bg-blue-500 text-white' : 'text-gray-100' }}">
          Meal Plans
        </a>
        <a href="{{route('rate-plans.index')}}" data-turbolinks-action="replace"
          class="block py-2.5 pl-10 rounded transition duration-200 hover:bg-blue-600 hover:text-white 
          border-l-4 border-transparent hover:border-blue-400
          {{ (request()->is('hotel/rate-plans')) ? 'bg-blue-500 text-white' : 'text-gray-100' }}">
          Rate Plans
        </a>
        <a href="{{route('documents.index')}}" data-turbolinks-action="replace"
          class="block py-2.5 pl-10 rounded transition duration-200 hover:bg-blue-600 hover:text-white 
          border-l-4 border-transparent hover:border-blue-400
          {{ (request()->is('hotel/documents')) ? 'bg-blue-500 text-white' : 'text-gray-100' }}">
          Documents
        </a>
        <a href="{{route('photos.index')}}" data-turbolinks-action="replace"
          class="block py-2.5 pl-10 rounded transition duration-200 hover:bg-blue-600 hover:text-white 
          border-l-4 border-transparent hover:border-blue-400
          {{ (request()->is('hotel/photos')) ? 'bg-blue-500 text-white' : 'text-gray-100' }}">
          Photos
        </a>
        <a href="{{route('policies.index')}}" data-turbolinks-action="replace"
          class="block py-2.5 pl-10 rounded transition duration-200 hover:bg-blue-600 hover:text-white 
          border-l-4 border-transparent hover:border-blue-400
          {{ (request()->is('hotel/policies')) ? 'bg-blue-500 text-white' : 'text-gray-100' }}">
          Policies
        </a>
      @endif

       <!-- Communication links -->
       <a class="block py-2.5 px-4 rounded transition duration-200 text-white bg-blue-800">
        <span aria-hidden="true"><i class="fas fa-comments"></i></span>
        <span class="ml-2 font-semibold"> Communication </span>
      </a>
        <a href="#" data-turbolinks-action="replace"
        class="block py-2.5 pl-10 rounded transition duration-200 hover:bg-blue-600 hover:text-white 
        border-l-4 border-transparent hover:border-blue-400
        {{ (request()->is('communication/notifications')) ? 'bg-blue-500 text-white' : 'text-gray-100' }}">
          Send Message
        </a>

        @if (auth()->user()->hasanyrole('Super Admin|Platform Manager'))
          <a href="#" data-turbolinks-action="replace"
            class="block py-2.5 pl-10 rounded transition duration-200 hover:bg-blue-600 hover:text-white 
            border-l-4 border-transparent hover:border-blue-400
            {{ (request()->is('communication/notifications')) ? 'bg-blue-500 text-white' : 'text-gray-100' }}">
            Send Massive Message
          </a>
        @endif

        <a href="{{route('notifications.index')}}" data-turbolinks-action="replace"
          class="block py-2.5 pl-10 rounded transition duration-200 hover:bg-blue-600 hover:text-white 
          border-l-4 border-transparent hover:border-blue-400
          {{ (request()->is('communication/notifications')) ? 'bg-blue-500 text-white' : 'text-gray-100' }}">
          Notifications
        </a>
    </nav>
  </div>