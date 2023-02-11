<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Orders') }}
        </h2>
    </x-slot>

    <div class="pt-12 pb-4">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="p-4 overflow-hidden bg-white shadow sm:p-8 dark:bg-gray-800 sm:rounded-lg">
                <div class="flex flex-col-reverse gap-4 mb-4 sm:flex-row sm:items-center sm:justify-between">
                    <form action="{{ route('orders.index') }}" method="GET">
                        <x-search-box name="search" route="{{ route('orders.index') }}" value="{{ old('search', request()->get('search')) }}" placeholder="Search orders by id..." class="w-full" required />
                    </form>
                </div>
                <!-- Orders Table -->
                <div class="overflow-x-auto border rounded-lg dark:border-gray-700">
                    <table class="w-full overflow-hidden text-sm text-left text-gray-500 border rounded-lg dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    @hasrole('farmer')
                                        Customer
                                    @endhasrole
                                    @hasrole('customer')
                                        Farmer
                                    @endhasrole
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Order ID
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Total Amount (Tk)
                                </th>
                                <th scope="col" class="px-6 py-3 text-center whitespace-nowrap">
                                    Status
                                </th>
                                <th scope="col" class="px-6 py-3 text-center whitespace-nowrap">
                                    Placed On
                                </th>
                                <th scope="col" class="px-6 py-3 text-center">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($orders as $order)
                                <tr class="border-t dark:border-gray-700">
                                    <td class="th-user-avatar">
                                        @hasrole('farmer')
                                            <x-user-avatar :user="$order->customer" />
                                        @endhasrole
                                        @hasrole('customer')
                                            <x-user-avatar :user="$order->farmer" />
                                        @endhasrole
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="pill-badge-info">#{{ $order->id }}</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $order->total }}
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        @if ($order->is_delivered)
                                            <span class="pill-badge-success">
                                                Delivered
                                            </span>
                                        @else
                                            <span class="pill-badge-warning">
                                                Pending
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        {{ $order->created_at->format('d M Y, h:i a') }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center justify-center gap-4">
                                            <a href="{{ route('orders.show', $order) }}" class="link-btn-secondary">
                                                {{ __('Details') }}
                                            </a>
                                            @if (
                                                !$order->is_delivered &&
                                                    auth()->user()->hasRole('farmer'))
                                                <form action="{{ route('orders.mark-as-delivered', $order) }}" method="POST" onsubmit="return confirm('Are you sure you want to mark this order as delivered?')">
                                                    @csrf
                                                    <button type="submit" class="link-btn whitespace-nowrap">
                                                        {{ __('Mark as delivered') }}
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-4 text-center">
                                        No orders found
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <p class="block my-2 text-sm text-gray-400 sm:hidden ">
                    Showing <span class="font-bold">{{ $orders->firstItem() }}</span> to <span class="font-bold">{{ $orders->lastItem() }}</span> of
                    <span class="font-bold">{{ $orders->total() }}</span> orders
                </p>
                <div class="my-4">
                    {{ $orders->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
