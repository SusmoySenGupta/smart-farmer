<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Products') }}
        </h2>
    </x-slot>

    <div class="pt-12 pb-4">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="p-4 overflow-hidden bg-white shadow sm:p-8 dark:bg-gray-800 sm:rounded-lg">
                <div class="flex flex-col-reverse gap-4 mb-4 sm:flex-row sm:items-center sm:justify-between">
                    @hasrole('farmer')
                        <a href="{{ route('products.create') }}" class="link-btn-secondary">
                            {{ __('Create Product') }}
                        </a>
                    @endhasrole
                    @hasrole('admin')
                        <p class="hidden text-sm text-gray-400 sm:block">Total products: <span class="font-bold">{{ $products->total() }}</span></p>
                    @endhasrole

                    <label for="table-search" class="sr-only">Search</label>
                    <!-- Search form -->
                    <form action="{{ route('products.index') }}" method="GET">
                        @php
                            $searchByOptions = [
                                'title' => 'Title',
                                'category' => 'Category',
                                'created_by' => 'Created By',
                            ];
                        @endphp
                        <x-search-with-dropdown name="search" route="{{ route('products.index') }}" value="{{ old('search', request()->get('search')) }}" placeholder="Search products..." class="w-full" required>
                            @foreach ($searchByOptions as $value => $label)
                                <option value="{{ $value }}" {{ request()->get('search_by') == $value ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </x-search-with-dropdown>
                    </form>
                </div>
                <!-- Products Table -->
                <div class="overflow-x-auto border rounded-lg dark:border-gray-700">
                    <table class="w-full overflow-hidden text-sm text-left text-gray-500 rounded-lg dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
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
                                <th scope="col" class="px-6 py-3 whitespace-nowrap">
                                    Stock (Kg)
                                </th>
                                <th scope="col" class="px-6 py-3 whitespace-nowrap">
                                    Status
                                </th>
                                @hasrole('admin')
                                    <th scope="col" class="px-6 py-3 whitespace-nowrap">
                                        Created By
                                    </th>
                                @endhasrole
                                <th scope="col" class="px-6 py-3 whitespace-nowrap">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($products as $product)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <!-- Title -->
                                    <td scope="row" class="px-6 py-4 whitespace-nowrap">
                                        <p class="text-base font-semibold text-gray-900 dark:text-gray-100">{{ $product->title }}</p>
                                    </td>
                                    <!-- Image -->
                                    <td class="px-6 py-4">
                                        @if ($product->image_url == null)
                                            <img src="https://dummyimage.com/200x200/000000/ffffff.png&text=No+Image" alt="{{ $product->title }}" class="object-cover w-20 h-20">
                                        @else
                                            <img src="{{ Storage::url($product->image_url) }}" alt="{{ $product->title }}" class="object-cover w-20 h-20">
                                        @endif
                                    </td>
                                    <!-- Price -->
                                    <td class="px-6 py-4">
                                        <span class="text-base">{{ $product->price }}</span>
                                    </td>
                                    <!-- Category -->
                                    <td class="px-6 py-4">
                                        <span class="text-base">{{ $product->category->title }}</span>
                                    </td>
                                    <!-- Stock -->
                                    <td class="px-6 py-4">
                                        <span class="text-base">{{ $product->stock }}</span>
                                    </td>
                                    <!-- Status -->
                                    <td class="px-6 py-4">
                                        @if ($product->is_active)
                                            <span class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300">Active</span>
                                        @else
                                            <span class="bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full dark:bg-red-900 dark:text-red-300">Inactive</span>
                                        @endif
                                    </td>
                                    @hasrole('admin')
                                        <!-- Created By -->
                                        <td class="px-6 py-4">
                                            <span class="text-base">{{ $product->user->name }}</span>
                                        </td>
                                    @endhasrole
                                    <!-- Action -->
                                    <td class="px-6 py-4">
                                        <div class="flex gap-4">
                                            @hasrole('farmer')
                                                <a href="{{ route('products.edit', $product) }}" class="link-btn">
                                                    {{ __('Edit') }}
                                                </a>
                                            @endhasrole
                                            <form action="{{ route('products.destroy', $product) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?')">
                                                @csrf
                                                @method('DELETE')
                                                <x-danger-button>
                                                    {{ __('Delete') }}
                                                </x-danger-button>
                                            </form>
                                        </div>
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

                </div>
                <!-- Pagination -->
                <p class="block my-2 text-sm text-gray-400 sm:hidden">
                    Showing <span class="font-bold">{{ $products->firstItem() }}</span> to <span class="font-bold">{{ $products->lastItem() }}</span> of
                    <span class="font-bold">{{ $products->total() }}</span> products.
                </p>

                <div class="my-4">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
