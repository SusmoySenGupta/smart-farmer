<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="pt-12 pb-4">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="px-6 overflow-hidden">
                <div class="grid gap-6 mb-8 lg:grid-cols-2">
                    <!-- Card -->
                    <div class="flex items-center p-4 bg-white rounded-lg shadow-md dark:bg-gray-800">
                        <div class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full dark:text-blue-100 dark:bg-blue-500">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                                Total users
                            </p>
                            <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                                {{ $totalUserCount }}
                            </p>
                        </div>
                    </div>
                    <!-- Card -->
                    <div class="flex items-center p-4 bg-white rounded-lg shadow-md dark:bg-gray-800">
                        <div class="p-3 mr-4 text-green-500 bg-green-100 rounded-full dark:text-green-100 dark:bg-green-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 32 32">
                                <path fill="currentColor"
                                    d="m24.877 1.562l-.439-.9l-.898.44c-3.834 1.87-5.444 6.497-3.57 10.337l.056.115a13.218 13.218 0 0 1-4.641 5.854l-.925-1.903a5.228 5.228 0 0 0 2.227-6.892L14.44 3.994l-.899.437a5.226 5.226 0 0 0-2.412 6.986l1.537 3.16c.009.026.02.052.032.077l1.69 3.476a14.384 14.384 0 0 0-4.68 6.58l-.256.74l-.964-1.983a6.408 6.408 0 0 0 2.77-8.463l-2.76-5.662l-.9.44c-3.172 1.55-4.502 5.377-2.949 8.557l2.284 4.685c.01.031.022.062.037.092l1.922 3.954l-.874 2.53l1.14.39l1.007-2.907l3.8.396a.623.623 0 0 0 .073.002l4.536.474a6.403 6.403 0 0 0 7.039-5.701l.104-.995l-6.265-.653a6.403 6.403 0 0 0-7.015 5.501l-1.867-.195l.278-.802a13.204 13.204 0 0 1 3.975-5.764l3.233.343v.002l.627.065l.507.054a.707.707 0 0 0 .027.002l3.957.413c2.866.296 5.442-1.78 5.739-4.652l.103-.994l-5.11-.533h-.003c-2.807-.302-5.31 1.688-5.713 4.445l-1.937-.207a14.4 14.4 0 0 0 4.91-6.315l.143-.07c3.846-1.871 5.444-6.5 3.57-10.337Zm-3.473 7.94a.268.268 0 0 0-.034-.01a5.744 5.744 0 0 1 2.098-6.012a5.733 5.733 0 0 1-2.064 6.022Zm-8.476 1.041a3.23 3.23 0 0 1 .657-3.734l1.304 2.678a3.226 3.226 0 0 1-.66 3.732l-1.301-2.676Zm-6.482 6.918a4.397 4.397 0 0 1 1.182-5.34l1.83 3.755v.001a4.41 4.41 0 0 1-1.18 5.342l-1.831-3.757v-.001Zm16.935.775l-2.965-.31a3.213 3.213 0 0 1 3.275-1.891h.003l2.969.31a3.23 3.23 0 0 1-3.282 1.89ZM14.62 25.53a4.407 4.407 0 0 1 4.624-2.936l4.162.434a4.407 4.407 0 0 1-4.624 2.936l-4.162-.434Z" />
                            </svg>
                        </div>
                        <div>
                            <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                                Active products
                            </p>
                            <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                                {{ $totalProductCount }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="pb-6">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="px-6 overflow-hidden">
                <div class="grid gap-6 mb-8 lg:grid-cols-2">
                    <!-- Latest Users Card -->
                    <div class="w-full max-w-xl p-4 bg-white border rounded-lg shadow-md sm:p-8 dark:bg-gray-800 dark:border-gray-700">
                        <div class="flex items-center justify-between mb-4">
                            <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white">Latest Users</h5>
                            <a href="{{ route('users.index') }}" class="text-sm font-medium text-blue-600 hover:underline dark:text-blue-500">
                                View all
                            </a>
                        </div>
                        <div class="flow-root">
                            <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                                @forelse ($latestUsers as $user)
                                    <li class="py-3 sm:py-4">
                                        <div class="flex items-center space-x-4">
                                            <div class="flex-shrink-0">
                                                <img class="w-8 h-8 rounded-full" src="https://ui-avatars.com/api/?name={{ $user->name }}" alt="{{ $user->name }}">
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                                    {{ __($user->name) }}
                                                </p>
                                                <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                                    {{ __($user->email) }}
                                                </p>
                                            </div>
                                            <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                                <span class="bg-blue-100 font-semibold capitalize text-blue-800 text-xs mr-2 px-2.5 py-0.5 rounded-full dark:bg-blue-900 dark:text-blue-300">
                                                    {{ $user?->roles?->first()?->name ?? 'N/A' }}
                                                </span>
                                            </div>
                                        </div>
                                    </li>
                                @empty
                                    <li class="py-3 sm:py-4">
                                        <div class="flex items-center space-x-4">
                                            <div class="flex-1 w-0 min">
                                                <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                                    No users found
                                                </p>
                                            </div>
                                        </div>
                                    </li>
                                @endforelse
                            </ul>
                        </div>
                    </div>

                    <!-- Latest Products Card -->
                    <div class="w-full max-w-xl p-4 bg-white border rounded-lg shadow-md sm:p-8 dark:bg-gray-800 dark:border-gray-700">
                        <div class="flex items-center justify-between mb-4">
                            <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white">Latest Products</h5>
                            <a href="{{ route('products.index') }}" class="text-sm font-medium text-blue-600 hover:underline dark:text-blue-500">
                                View all
                            </a>
                        </div>
                        <div class="flow-root">
                            <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                                @forelse ($latestProducts as $product)
                                    <li class="py-3 sm:py-4">
                                        <div class="flex items-center space-x-4">
                                            <div class="flex-shrink-0">
                                                <img class="w-8 h-8 rounded-full" src="https://ui-avatars.com/api/?name={{ $product->image_url }}" alt="{{ $product->title }}">
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                                    {{ __($product->title) }}
                                                </p>
                                                <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                                    Created by <strong>{{ __($product->user->name) }}</strong>
                                                </p>
                                            </div>
                                            <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                                ৳ {{ $product->price }}
                                            </div>
                                        </div>
                                    </li>
                                @empty
                                    <li class="py-3 sm:py-4">
                                        <div class="flex items-center space-x-4">
                                            <div class="flex-1 w-0 min">
                                                <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                                    No products found
                                                </p>
                                            </div>
                                        </div>
                                    </li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
