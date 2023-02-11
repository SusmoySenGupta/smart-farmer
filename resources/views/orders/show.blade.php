<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Order Details') }}
        </h2>
    </x-slot>

    <div class="pt-12 pb-4">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="flex flex-col w-full gap-6 md:flex-row">
                <div class="w-full p-4 overflow-hidden bg-white shadow sm:p-8 dark:bg-gray-800 sm:rounded-lg">
                    <div class="flex items-start justify-between gap-6 space-y-2">
                        <div>
                            <h2 class="text-xl font-semibold leading-tight text-gray-800 text-md dark:text-gray-200 flex items-center gap-2">
                                Order No: <span class="pill-badge-info">#{{ $order->id }}</span>
                            </h2>
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Placed on: {{ $order->created_at->format('d M Y H:i') }}</p>
                        </div>
                        @if ($order->is_delivered)
                            <span class="pill-badge-success">Delivered</span>
                        @else
                            <span class="pill-badge-warning">Pending</span>
                        @endif
                    </div>

                    <!-- Order Items -->
                    <div class="mt-6 overflow-x-auto border rounded-lg dark:border-gray-700">
                        <table class="w-full overflow-hidden text-sm text-left text-gray-500 border rounded-lg dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Item
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-right">
                                        Quantity (Kg)
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-right">
                                        Amount (Tk)
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->products as $product)
                                    <tr class="border-t dark:border-gray-700">
                                        <td class="px-6 py-4">
                                            {{ $product->title }}
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            {{ $product->pivot->quantity }}
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            {{ $product->pivot->amount }}
                                        </td>
                                    </tr>
                                @endforeach
                                <tr class="border-t dark:border-gray-700">
                                    <td class="px-6 py-4 font-semibold text-right" colspan="2">
                                        Total:
                                    </td>
                                    <td class="px-6 py-4 font-semibold text-right">
                                        {{ $order->total }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Order Actions -->
                    @if (
                        !$order->is_delivered &&
                            auth()->user()->hasRole('farmer'))
                        <form action="{{ route('orders.mark-as-delivered', $order) }}" method="POST" onsubmit="return confirm('Are you sure you want to mark this order as delivered?')" class="mt-6">
                            @csrf
                            <button type="submit" class="link-btn">
                                {{ __('Mark as delivered') }}
                            </button>
                        </form>
                    @endif
                </div>
                <div class="w-full p-4 overflow-hidden bg-white shadow md:w-1/2 sm:p-8 dark:bg-gray-800 sm:rounded-lg">
                    <h2 class="text-xl font-semibold leading-tight text-gray-800 text-md dark:text-gray-200">
                        Customer Details
                    </h2>
                    <ul class="mt-4 space-y-1 text-sm text-gray-600 dark:text-gray-400">
                        <li>Name: {{ $order->customer->name }}</li>
                        <li>Email: {{ $order->customer->email }}</li>
                        <li>Phone: +880{{ $order->customer->mobile_no }}</li>
                        <li>Address: {{ $order->address }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
