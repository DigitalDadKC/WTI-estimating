<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'WTI-Estimating') }}</title>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <link rel="icon" href="images/favicon.ico" />
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
            integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
            crossorigin="anonymous"
            referrerpolicy="no-referrer"
        />
        <script src="//unpkg.com/alpinejs" defer></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        @livewireStyles
    </head>
    <body>
        <div class="min-h-screen bg-gray-300">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($pageheader))
                <header class="bg-emerald-600 text-lg text-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        <h2 class="font-semibold text-xl text-gray-800 text-center leading-tight">
                            {{ $pageheader }}
                        </h2>
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main class="p-4">
                <div class="bg-gray-200 overflow-hidden shadow-sm sm:rounded-lg max-w-7xl mx-auto p-4">
                    {{ $slot }}
                </div>
            </main>

            <!-- Page Footer -->
            @if(isset($pagefooter))
                <footer class="bg-emerald-600 text-leg text-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{$pagefooter}}
                    </div>
                </footer>
            @endif
        </div>
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
        @livewireScripts
    </body>
</html>
