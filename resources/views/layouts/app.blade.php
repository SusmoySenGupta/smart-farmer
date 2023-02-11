<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Smart Farmer') }}</title>
    <link rel="icon" type="image/x-icon" href="https://api.iconify.design/game-icons:wheat.svg">

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.3/flowbite.min.css" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script>
        if (
            localStorage.getItem("color-theme") === "dark" ||
            (!("color-theme" in localStorage) &&
                window.matchMedia("(prefers-color-scheme: dark)").matches)
        ) {
            document.documentElement.classList.add("dark");
        } else {
            document.documentElement.classList.remove("dark");
        }
    </script>
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white shadow dark:bg-gray-800">
                <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>

    @if (Session::has('success'))
        <x-alert type="success"> {{ Session::get('success') }} </x-alert>
    @elseif (Session::has('error'))
        <x-alert type="error"> {{ Session::get('error') }} </x-alert>
    @elseif (Session::has('warning'))
        <x-alert type="warning"> {{ Session::get('warning') }} </x-alert>
    @elseif (Session::has('info'))
        <x-alert type="info"> {{ Session::get('info') }} </x-alert>
    @endif

    <script src="{{ asset('js/flowbit.min.js') }}"></script>
    <script src="{{ asset('js/darkmode.js') }}"></script>
</body>

</html>
