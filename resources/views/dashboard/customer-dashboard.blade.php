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
                        <div class="p-3 mr-4 text-green-500 bg-green-100 rounded-full dark:text-green-100 dark:bg-green-500">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                                Account Balance
                            </p>
                            <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                                {{ $balance }}
                            </p>
                        </div>
                    </div>
                    <!-- Card -->
                    <div class="flex items-center p-4 bg-white rounded-lg shadow-md dark:bg-gray-800">
                        <div class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 512 512">
                                <path d="M408 64H104c-22.091 0-40 17.908-40 40v304c0 22.092 17.909 40 40 40h304c22.092 0 40-17.908 40-40V104c0-22.092-17.908-40-40-40zM304 368H144v-48h160v48zm64-88H144v-48h224v48zm0-88H144v-48h224v48z" fill="currentColor" />
                            </svg>
                        </div>
                        <div>
                            <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                                Pending orders
                            </p>
                            <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                                {{ $pendingOrderCount }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="pb-6">
        <div class="w-full mx-auto md:max-w-7xl sm:px-6 lg:px-8">
            <div class="px-6 overflow-hidden">
                <div class="grid gap-6 mb-8 lg:grid-cols-1">
                    <!-- Latest Orders Card -->
                    <div class="w-full p-4 bg-white border rounded-lg shadow-md sm:p-8 dark:bg-gray-800 dark:border-gray-700">
                        <div class="flex items-center justify-between mb-4">
                            <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white">Your Latest Orders</h5>
                            @if ($latestOrders->count() > 0)
                                <a href="{{ route('orders.index') }}" class="text-sm font-medium text-blue-600 hover:underline dark:text-blue-500">
                                    View all
                                </a>
                            @endif
                        </div>
                        <div class="flow-root">
                            <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach ($latestOrders as $order)
                                    <li class="py-3 sm:py-4">
                                        <div class="flex items-center space-x-4">
                                            <a href="{{ route('orders.show', $order) }}" class="flex-1 min-w-0">
                                                <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                                    Order ID:
                                                    <span class="pill-badge-info">#{{ $order->id }}</span>
                                                </p>
                                                <p class="text-xs text-gray-500 truncate dark:text-gray-400">
                                                    {{ $order->created_at->format('d M Y, h:i a') }}
                                                </p>
                                            </a>
                                            <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                                @if ($order->is_delivered)
                                                    <span class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300">Delivered</span>
                                                @else
                                                    <span class="bg-yellow-100 text-yellow-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full dark:bg-yellow-900 dark:text-yellow-300">
                                                        Pending
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        @if ($latestOrders->count() === 0)
                            <div class="flex items-center justify-center w-full h-full -mt-4 space-x-4">
                                <p class="text-sm font-medium text-gray-900 truncate dark:text-gray-200">
                                    No orders found
                                </p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
