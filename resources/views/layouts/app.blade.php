<!DOCTYPE html>
<html x-data="data()" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tailwind.output.css') }}" />
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <script src="{{asset('js/init-alpine.js')}}" defer></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" defer></script>
    <script src="{{asset('js/charts-lines.js')}}" defer></script>
    <script src="{{asset('js/charts-pie.js')}}" defer></script>
    <script src="{{asset('js/charts-bars.js')}}" defer></script>
    
    <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet">

    @livewireStyles
    <script>
        import Turbolinks from 'turbolinks';
        Turbolinks.start()
    </script>


    <link rel="stylesheet" href="{{asset('vendor/fontawesome/css/all.min.css')}}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <script src="https://js.stripe.com/v3/"></script>

    @isset($css)
        {{$css}}
    @endisset
    <!-- Scripts -->
    {{-- <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.6.0/dist/alpine.js" defer></script> --}}
</head>

<body>
    <div class="flex h-screen bg-gray-50 dark:bg-gray-900" :class="{ 'overflow-hidden': isSideMenuOpen }">
        @include('layouts.menu')
        @include('layouts.mobile-menu')

        <div class="flex flex-col flex-1 w-full">
            @include('layouts.navigation-dropdown')

            <!-- Page Heading -->
           @if (isset($header))
                <header class="bg-white mb-6 dark:bg-gray-700">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        <h2 class="text-2xl font-semibold text-blue-700 dark:text-gray-200">
                            {{ $header }}
                        </h2>
                    </div>
                </header>
            @endif
            <main class="h-full overflow-y-auto">
                {{ $slot }}
            </main>
        </div>

        @stack('modals')

        @livewireScripts

        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
        <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>

        @stack('scripts')

    </div>

    @isset($js)
        {{$js}}
    @endisset
    
</body>

</html>
