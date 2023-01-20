<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Products') }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
            <div class="p-4 overflow-hidden bg-white shadow sm:p-8 dark:bg-gray-800 sm:rounded-lg">
                <section class="overflow-x-auto rounded-lg">
                    <div class="flex flex-col gap-4 pb-4 sm:flex-row sm:items-center sm:justify-between">
                        <p class="hidden text-sm text-gray-400 sm:block">Total products: <span class="font-bold">{{ $products->total() }}</span></p>

                        <label for="table-search" class="sr-only">Search</label>
                        <!-- Search form -->
                        <form action="{{ route('products.index') }}" method="GET" class="flex flex-col items-start gap-1 mt-1">
                            @php
                                $searchByOptions = [
                                    'title' => 'Title',
                                    'category' => 'Category',
                                    'created_by' => 'Created By',
                                ];
                            @endphp
                            <x-search-with-dropdown name="search" value="{{ old('search', request()->get('search')) }}" placeholder="Search products..." class="w-full" required>
                                @foreach ($searchByOptions as $value => $label)
                                    <option value="{{ $value }}" {{ request()->get('search_by') == $value ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </x-search-with-dropdown>
                            @if (request()->has('search'))
                                <p class="mt-1 text-xs text-gray-500">
                                    Showing results for <span class="font-semibold"> {{ request()->get('search') }} </span>
                                    <a href="{{ route('products.index') }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="inline-block w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </a>
                                </p>
                            @endif
                        </form>
                    </div>

                    <!-- Products Table -->
                    <table class="w-full overflow-hidden text-sm text-left text-gray-500 rounded-lg dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    #SL
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Title
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Image
                                </th>
                                <th scope="col" class="px-6 py-3 whitespace-nowrap">
                                    Price (Tk)
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Category
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Status
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Created By
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($products as $product)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <!-- SL -->
                                    <td class="px-6 py-4">
                                        {{ $products->firstItem() + $loop->index }}
                                    </td>
                                    <!-- Title -->
                                    <td class="px-6 py-4">
                                        <span class="text-base font-semibold">{{ $product->title }}</span>
                                    </td>
                                    <!-- Image -->
                                    <td class="px-6 py-4">
                                        <img src="{{ asset('storage/' . $product->image_url) }}" alt="{{ $product->title }}" class="object-cover w-20 h-20">
                                    </td>
                                    <!-- Price -->
                                    <td class="px-6 py-4">
                                        <span class="text-base">{{ $product->price }}</span>
                                    </td>
                                    <!-- Category -->
                                    <td class="px-6 py-4">
                                        <span class="text-base">{{ $product->category->title }}</span>
                                    </td>
                                    <!-- Status -->
                                    <td class="px-6 py-4">
                                        @if ($product->is_active)
                                            <span class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300">Active</span>
                                        @else
                                            <span class="bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full dark:bg-red-900 dark:text-red-300">Inactive</span>
                                        @endif
                                    </td>
                                    <!-- Created By -->
                                    <td class="px-6 py-4">
                                        <span class="text-base">{{ $product->user->name }}</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <form action="{{ route('products.destroy', $product) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?')">
                                            @csrf
                                            @method('DELETE')
                                            <x-danger-button>
                                                {{ __('Delete') }}
                                            </x-danger-button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="px-6 py-4 text-center">
                                        No products found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <p class="block my-2 text-sm text-gray-400 sm:hidden ">
                        Showing <span class="font-bold">{{ $products->firstItem() }}</span> to <span class="font-bold">{{ $products->lastItem() }}</span> of
                        <span class="font-bold">{{ $products->total() }}</span> products.
                    </p>

                    <div class="my-4">
                        {{ $products->links() }}
                    </div>
                </section>
            </div>
        </div>
    </div>
</x-app-layout>
