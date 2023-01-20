<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Categories') }}
        </h2>
    </x-slot>

    <div class="pt-12 pb-4">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="p-4 overflow-hidden bg-white shadow sm:p-8 dark:bg-gray-800 sm:rounded-lg">
                <div class="flex flex-col-reverse gap-4 mb-4 sm:flex-row sm:items-center sm:justify-between">
                    <a href="{{ route('admin.categories.create') }}" class="link-btn-secondary">
                        {{ __('Create Category') }}
                    </a>
                    <form action="{{ route('admin.categories.index') }}" method="GET">
                        <x-search-box name="search" route="{{ route('admin.categories.index') }}" value="{{ old('search', request()->get('search')) }}" placeholder="Search categories..." class="w-full" required />
                    </form>
                </div>
                <!-- Categories Table -->
                <div class="overflow-x-auto border rounded-lg dark:border-gray-700">
                    <table class="w-full overflow-hidden text-sm text-left text-gray-500 border rounded-lg dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Title
                                </th>
                                <th scope="col" class="px-6 py-3 text-center whitespace-nowrap">
                                    Created At
                                </th>
                                <th scope="col" class="px-6 py-3 text-center whitespace-nowrap">
                                    Updated At
                                </th>
                                <th scope="col" class="px-6 py-3 text-center">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($categories as $category)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <td scope="row" class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                                        <div class="text-base font-semibold">
                                            {{ $category->title }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-center whitespace-nowrap">
                                        <span class="bg-gray-100 text-gray-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded mr-2 dark:bg-gray-700 dark:text-gray-400 border border-gray-200 dark:border-gray-600">
                                            <svg aria-hidden="true" class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                                            </svg>
                                            {{ $category->created_at->diffForHumans() }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center whitespace-nowrap">
                                        <span class="bg-gray-100 text-gray-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded mr-2 dark:bg-gray-700 dark:text-gray-400 border border-gray-200 dark:border-gray-600">
                                            <svg aria-hidden="true" class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                                            </svg>
                                            {{ $category->updated_at->diffForHumans() }}
                                        </span>
                                    </td>

                                    <td class="flex items-center justify-center gap-4 px-6 py-4">
                                        <a href="{{ route('admin.categories.edit', $category) }}" class="link-btn">
                                            {{ __('Edit') }}
                                        </a>
                                        <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Are you sure you want to destroy this category?')">
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
                </div>

                <!-- Pagination -->
                <p class="block my-2 text-sm text-gray-400 sm:hidden ">
                    Showing <span class="font-bold">{{ $categories->firstItem() }}</span> to <span class="font-bold">{{ $categories->lastItem() }}</span> of
                    <span class="font-bold">{{ $categories->total() }}</span> categories
                </p>
                <div class="my-4">
                    {{ $categories->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
