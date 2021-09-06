<nav aria-label="Main" class="flex-1 px-2 py-4 space-y-2 overflow-y-hidden hover:overflow-y-auto">
  <!-- Dashboards links -->
  <div x-data="{ isActive: false, open: false}">
    <!-- active & hover classes 'bg-indigo-100 dark:bg-indigo-600' -->
    <a
      href="#"
      @click="$event.preventDefault(); open = !open"
      class="flex items-center p-2 text-white transition-colors rounded-md dark:text-light hover:bg-indigo-500 dark:hover:bg-indigo-600"
      :class="{'bg-indigo-600 dark:bg-indigo-600': isActive || open}"
      role="button"
      aria-haspopup="true"
      :aria-expanded="(open || isActive) ? 'true' : 'false'"
    >
      <span aria-hidden="true"><i class="fas fa-home"></i></span>
      <span class="ml-2 text-sm"> Home </span>
      <span class="ml-auto" aria-hidden="true"><i class="fas fa-angle-down"></i></span>
    </a>
    <div role="menu" x-show="open" class="mt-2 space-y-2 px-7" aria-label="Dashboards">
      <a href="#" role="menuitem"
        class="block p-2 text-sm text-white transition-colors duration-200 rounded-md dark:hover:text-light hover:text-indigo-200">
        Launch
      </a>
      <a href="#" role="menuitem"
        class="block p-2 text-sm text-white transition-colors duration-200 rounded-md dark:hover:text-light hover:text-indigo-200">
        Dashboard
      </a>
    </div>
  </div>
</nav>