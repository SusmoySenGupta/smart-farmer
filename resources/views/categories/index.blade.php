<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Categories') }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
            <div class="p-4 overflow-hidden bg-white shadow sm:p-8 dark:bg-gray-800 sm:rounded-lg">
                <section class="overflow-x-auto rounded-lg">
                    <div class="flex flex-col gap-4 pb-4 sm:flex-row sm:items-center sm:justify-between">
                        <a href="{{ route('categories.create') }}" class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-blue-600 border border-transparent rounded-lg active:bg-blue-600 hover:bg-blue-700 focus:outline-none focus:shadow-outline-blue">
                            Create Category
                        </a>

                        <label for="table-search" class="sr-only">Search</label>
                        <!-- Search form -->
                        <form action="{{ route('categories.index') }}" method="GET" class="flex flex-col items-start gap-1 mt-1">
                            <div class="flex items-center">
                                <x-search-box name="search" value="{{ old('search', request()->get('search')) }}" placeholder="Search categories..." class="w-full" required />
                            </div>
                            @if (request()->has('search'))
                                <p class="mt-1 text-xs text-gray-500">
                                    Showing results for <span class="font-semibold"> {{ request()->get('search') }} </span>
                                    <a href="{{ route('categories.index') }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="inline-block w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </a>
                                </p>
                            @endif
                        </form>
                    </div>

                    <!-- Categories Table -->
                    <table class="w-full overflow-hidden text-sm text-left text-gray-500 rounded-lg dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    #SL
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Name
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Created At
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Updated At
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($categories as $category)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <td class="px-6 py-4">
                                        {{ $categories->firstItem() + $loop->index }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="text-base font-semibold">{{ $category->title }}</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $category->created_at->diffForHumans() }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $category->updated_at->diffForHumans() }}
                                    </td>
                                    <td class="flex items-center gap-2 px-6 py-4">
                                        <a href="{{ route('categories.edit', $category) }}" class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-blue-600 border border-transparent rounded-lg active:bg-blue-600 hover:bg-blue-700 focus:outline-none focus:shadow-outline-blue">
                                            Edit
                                        </a>
                                        <form action="{{ route('categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Are you sure you want to destroy this category?')">
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
                                    <td colspan="4" class="px-6 py-4 text-center">
                                        No categories found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <p class="block my-2 text-sm text-gray-400 sm:hidden ">
                        Showing <span class="font-bold">{{ $categories->firstItem() }}</span> to <span class="font-bold">{{ $categories->lastItem() }}</span> of
                        <span class="font-bold">{{ $categories->total() }}</span> categories.
                    </p>

                    <div class="my-4">
                        {{ $categories->links() }}
                    </div>
                </section>
            </div>
        </div>
    </div>
</x-app-layout>
