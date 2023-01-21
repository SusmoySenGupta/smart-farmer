<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Users') }}
        </h2>
    </x-slot>

    <div class="pt-12 pb-4">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="p-4 overflow-hidden bg-white shadow sm:p-8 dark:bg-gray-800 sm:rounded-lg">
                <div class="flex flex-col h-full gap-4 mb-4 sm:flex-row sm:items-center sm:justify-between">
                    <p class="hidden text-sm text-gray-400 sm:block">Total users: <span class="font-bold">{{ $users->total() }}</span></p>
                    <div>
                        <label for="table-search" class="sr-only">Search</label>
                        <form action="{{ route('users.index') }}" method="GET" class="flex flex-col items-start gap-1">
                            <x-search-box name="search" route="{{ route('users.index') }}" value="{{ old('search', request()->get('search')) }}" placeholder="Search users..." class="w-full" required />
                        </form>
                    </div>
                </div>
                <!-- Users Table -->
                <div class="overflow-x-auto border rounded-lg dark:border-gray-700">
                    <table class="w-full overflow-hidden text-sm text-left text-gray-500 border rounded-lg dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Name
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Mobile No
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Role
                                </th>
                                <th scope="col" class="px-6 py-3 whitespace-nowrap">
                                    Created At
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <th scope="row" class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                                        <img class="w-10 h-10 rounded-full" src="https://ui-avatars.com/api/?name={{ $user->name }}" alt="{{ $user->name }}">
                                        <div class="pl-3">
                                            <div class="text-base font-semibold">
                                                {{ $user->name }}
                                                @if ($user->id == auth()->user()->id)
                                                    <span class="text-xs font-normal text-green-500">(You)</span>
                                                @endif
                                            </div>
                                            <div class="font-normal text-gray-500">{{ $user->email }}</div>
                                        </div>
                                    </th>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if ($user->mobile_no)
                                            +880
                                        @endif
                                        {{ $user?->mobile_no ?? 'N/A' }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="bg-blue-100 font-semibold capitalize text-blue-800 text-xs mr-2 px-2.5 py-0.5 rounded-full dark:bg-blue-900 dark:text-blue-300">
                                            {{ $user?->roles?->first()?->name ?? 'N/A' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="bg-gray-100 text-gray-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded mr-2 dark:bg-gray-700 dark:text-gray-400 border border-gray-200 dark:border-gray-600">
                                            <svg aria-hidden="true" class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                                            </svg>
                                            {{ $user->created_at->diffForHumans() }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        @if (auth()->user()->id != $user->id)
                                            <form action="{{ route('users.destroy', $user) }}" method="POST" onsubmit="return confirm('Are you sure you want to destroy this user?')">
                                                @csrf
                                                @method('DELETE')
                                                <x-danger-button>
                                                    {{ __('Delete') }}
                                                </x-danger-button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-4 text-center">
                                        No users found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <p class="block my-2 text-sm text-gray-400 sm:hidden ">
                    Showing <span class="font-bold">{{ $users->firstItem() }}</span> to <span class="font-bold">{{ $users->lastItem() }}</span> of
                    <span class="font-bold">{{ $users->total() }}</span> users
                </p>
                <div class="my-4">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
