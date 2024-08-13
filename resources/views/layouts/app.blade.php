<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <style>
        /* Optional: Hide scrollbar for a cleaner look */
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .no-scrollbar {
            -ms-overflow-style: none;
            /* Internet Explorer 10+ */
            scrollbar-width: none;
            /* Firefox */
        }

        .carousel-inner {
            scroll-behavior: smooth;
        }

        .carousel-inner::-webkit-scrollbar {
            display: none;

        }

        /* Optional: Smooth scrolling */
        .scroll-smooth {
            scroll-behavior: smooth;
        }

        .scrollbar-hidden::-webkit-scrollbar {
            display: none;
        }

        .scrollbar-hidden {
            -ms-overflow-style: none;
            /* IE and Edge */
            scrollbar-width: none;
            /* Firefox */
        }
    </style>
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="font-sans antialiased bg-primary w-screen h-screen p-0 m-0 overflow-x-hidden">

    <x-header.header class="fixed top-0 left-0" />

    <main id="main1" class="flex flex-col justify-start items-center m-0 p-0  bg-primary mt-32 md:mt-52  ">
        {{ $slot }}
    </main>

    <x-footer class="bg-primary z-20" />
    <x-success-error/>

    <script src="{{ asset('scripts/index.js') }}"></script>
    
    @stack('scripts')
    @livewireScripts
</body>

</html>
