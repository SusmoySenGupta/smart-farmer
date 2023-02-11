<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Smart Farmer</title>
    <link rel="icon" type="image/x-icon" href="https://api.iconify.design/game-icons:wheat.svg">

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <symbol viewBox="0 0 512 512" id="game-icons-wheat">
        <path fill="currentColor"
            d="M98.344 16.688C79.692 43.785 68.498 69.01 65.5 89.56l23.938 39.157l28.624-33.47c.868-21.213-5.49-48.677-19.718-78.563zM472.5 19.625C444.04 36.055 423.112 54 411.562 71.25l4.75 45.688L456.563 99c9.89-18.777 15.938-46.29 15.938-79.375zm-91.75 27.28c-10.153 21.036-16.8 40.84-20.156 58.314l18.375 57.686l19.78-34.25l-6.5-62.22h.03a276.899 276.899 0 0 0-11.53-19.53zM27.25 80.782c-.125 23.364 2.393 44.102 6.875 61.314L75.5 186.25l3.125-39.406L46 93.47l.03-.032a279.975 279.975 0 0 0-18.78-12.657zm132.844 10.532c-8.415 3.504-16.29 7.213-23.594 11.094l-39.25 45.97l-3.094 39.374l50.438-39.094c6.712-15.904 12.09-35.263 15.5-57.344zm177.22 21.626c-24.024 58.09-16.16 97.86 7.873 108.5l21.157-36.625l-19.594-61.438a273.514 273.514 0 0 0-9.438-10.438zm146.03.218c-4.55-.028-8.97.084-13.28.28L414.935 138l-19.78 34.28l62.343-13.655c12.897-11.47 26.09-26.626 38.656-45.094c-4.358-.216-8.64-.348-12.812-.374zm-226.094 8.72c-23.24 23.238-38.832 46.003-45.53 65.655l16.436 42.907l34.22-27.75c4.695-20.704 3.436-48.856-5.126-80.812zM16.406 159.06c3.28 62.77 27.482 95.31 53.75 94.594l3.344-42.22l-44.063-47a278.462 278.462 0 0 0-13.03-5.374zm143.22 11.375a272.272 272.272 0 0 0-18.5 4.563l-48.97 37.938l-3.312 41.75c26.492 7.51 57.16-20.567 70.78-84.25zm16.06 1.563c-4.36 22.935-5.65 43.762-4.374 61.5l32.688 51l10.22-38.188l-22.407-58.437h.03a276.624 276.624 0 0 0-16.155-15.875zm267.408 8.938l-60.563 13.218l-20.936 36.25c20.682 18.195 60.438 6.035 100.125-45.625a274.745 274.745 0 0 0-18.626-3.843zm-138.688 25.53c-8.912 1.92-17.304 4.16-25.187 6.657l-46.97 38.03l-10.22 38.19l56.69-29.283c9.493-14.424 18.323-32.49 25.686-53.593zm155.125 25.063c-25.85 20.324-44.046 41.06-53.03 59.782l11.22 44.532l37.28-23.47c7.126-19.99 9.236-48.088 4.53-80.843zm-123.342 8.595c-34.435 77.573-59.394 159.06-62.97 253.03h18.72c3.558-90.792 27.573-169.428 61.312-245.436l-17.063-7.595zm-185.375 6.906c-8.173 62.347 9.714 98.713 35.687 102.75l10.97-40.874l-34.814-54.25a278.524 278.524 0 0 0-11.844-7.625zm221.75 24.532c-7.053 22.243-10.817 42.77-11.657 60.532l26.406 54.594L402 349.967l-15.28-60.687h.06c-4.3-5.848-9.033-11.76-14.217-17.717zm-302.47 1.532c-8.664 74.584-8.13 147.835 12.188 220.062h19.44c-20.877-70.772-21.764-143.02-13.064-217.906l-18.562-2.156zm219.47 11.094c-6.613.16-12.953.54-19.032 1.125L215.5 313.78l-10.844 40.408c24.69 12.23 59.938-9.82 84.906-70zm206.718 36.937c-9.072.844-17.664 2.052-25.78 3.594l-51.156 32.217l-14.688 36.657l59.75-22.313c11.14-13.193 22.055-30.075 31.875-50.155zm-157.31 22c-15.528 60.938-2.096 99.19 23.217 106.28l15.72-39.28l-28.094-58.03c-3.43-3-7.053-5.985-10.844-8.97zM183.25 368.72c-12.674 41.233-22.26 82.547-26.844 124.436h18.813c4.507-39.722 13.69-79.23 25.905-118.97l-17.875-5.467zm270 26.655l-58 21.688l-15.563 38.875c23.056 15.098 60.673-2.606 92.625-59.407a273.166 273.166 0 0 0-19.062-1.155zM356.5 469.03c-1.874 7.713-3.185 15.757-3.656 24.126h18.687c.45-6.686 1.55-13.206 3.126-19.687l-18.156-4.44z">
        </path>
    </symbol>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>


<body class="antialiased">
    <header class="text-gray-600 body-font">
        <div class="container flex flex-col flex-wrap items-center p-5 mx-auto md:flex-row">
            <a href="/" class="flex items-center mb-4 font-medium text-gray-900 title-font md:mb-0">
                <x-application-logo class="w-10 h-10 text-green-500" />
                <span class="ml-3 text-xl">Smart Farmer</span>
            </a>
            <nav class="flex flex-wrap items-center justify-center text-base md:ml-auto md:mr-auto">
                @auth
                    <a href="{{ route('dashboard') }}" class="mr-5 hover:text-gray-900">Dashboard</a>
                @endauth
                <a href="{{ route('farmers') }}" class="mr-5 hover:text-gray-900">Farmers</a>
            </nav>
            <div class="flex items-center gap-4">
                @if (auth()->check() &&
                        auth()->user()->cart()->count())
                    <div class="relative inline-flex">
                        <a href="{{ route('cart.index') }}" class="inline-flex items-center px-3 py-1 mt-4 text-base bg-gray-100 border-0 rounded focus:outline-none hover:bg-gray-200 md:mt-0">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-1">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                            </svg>
                            Cart

                            <span class="ml-1 text-sm font-medium text-gray-700">({{ auth()->user()->cart->products()->count() }})</span>
                        </a>
                    </div>
                @endif

                @auth
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="inline-flex items-center px-3 py-1 mt-4 text-base bg-gray-100 border-0 rounded focus:outline-none hover:bg-gray-200 md:mt-0">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-1">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                            </svg>
                            Log out
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="inline-flex items-center px-3 py-1 mt-4 text-base bg-gray-100 border-0 rounded focus:outline-none hover:bg-gray-200 md:mt-0">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-1">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
                        </svg>
                        Log in
                    </a>
                @endauth
            </div>
        </div>
    </header>

    @if ($errors->any())
        <div class="flex p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
            <svg aria-hidden="true" class="flex-shrink-0 inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
            </svg>
            <span class="sr-only">Danger</span>
            <div>
                <span class="font-medium">Woops!!! Something went wrong!</span>
                <ul class="mt-1.5 ml-4 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    @yield('content')

    @if (Session::has('success'))
        <x-alert type="success"> {{ Session::get('success') }} </x-alert>
    @elseif (Session::has('error'))
        <x-alert type="error"> {{ Session::get('error') }} </x-alert>
    @elseif (Session::has('warning'))
        <x-alert type="warning"> {{ Session::get('warning') }} </x-alert>
    @elseif (Session::has('info'))
        <x-alert type="info"> {{ Session::get('info') }} </x-alert>
    @endif

    <!-- Footer -->
    <footer class="text-gray-600 bg-gray-100 body-font">
        <div class="container flex flex-col items-center px-5 py-8 mx-auto sm:flex-row">
            <a class="flex items-center justify-center font-medium text-gray-900 title-font md:justify-start">
                <x-application-logo class="w-10 h-10 text-green-500" />
                <span class="ml-3 text-xl">Smart Farmer</span>
            </a>
            <p class="mt-4 text-sm text-gray-500 sm:ml-4 sm:pl-4 sm:border-l-2 sm:border-gray-200 sm:py-2 sm:mt-0">© {{ now()->format('Y') }} Smart Farmer
            </p>
            <span class="inline-flex justify-center mt-4 sm:ml-auto sm:mt-0 sm:justify-start">
                <a class="text-gray-500">
                    <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                        <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"></path>
                    </svg>
                </a>
                <a class="ml-3 text-gray-500">
                    <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                        <path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z"></path>
                    </svg>
                </a>
                <a class="ml-3 text-gray-500">
                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                        <rect width="20" height="20" x="2" y="2" rx="5" ry="5"></rect>
                        <path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37zm1.5-4.87h.01"></path>
                    </svg>
                </a>
                <a class="ml-3 text-gray-500">
                    <svg fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="0" class="w-5 h-5" viewBox="0 0 24 24">
                        <path stroke="none" d="M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6zM2 9h4v12H2z"></path>
                        <circle cx="4" cy="4" r="2" stroke="none"></circle>
                    </svg>
                </a>
            </span>
        </div>
    </footer>
</body>

</html>
