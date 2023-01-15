<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Users') }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
            <div class="p-4 overflow-hidden bg-white shadow sm:p-8 dark:bg-gray-800 sm:rounded-lg">
                <section class="overflow-x-auto rounded-lg">
                    <div class="flex flex-col gap-4 pb-4 sm:flex-row sm:items-center sm:justify-between">
                        <p class="hidden text-sm text-gray-400 sm:block">Total users: <span class="font-bold">{{ $users->total() }}</span></p>

                        <label for="table-search" class="sr-only">Search</label>
                        <!-- Search form -->
                        <form action="{{ route('users.index') }}" method="GET" class="flex flex-col items-start gap-1 mt-1">
                            <div class="flex items-center">
                                <x-search-box name="search" value="{{ old('search', request()->get('search')) }}" placeholder="Search users..." class="w-full" required />
                            </div>
                            @if (request()->has('search'))
                                <p class="mt-1 text-xs text-gray-500">
                                    Showing results for <span class="font-semibold"> {{ request()->get('search') }} </span>
                                    <a href="{{ route('users.index') }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="inline-block w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </a>
                                </p>
                            @endif
                        </form>
                    </div>

                    <!-- Users Table -->
                    <table class="w-full text-sm text-left text-gray-500 border rounded-lg dark:text-gray-400">
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
                                <th scope="col" class="px-6 py-3">
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
                                    <td class="px-6 py-4">
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
                                    <td class="px-6 py-4">
                                        {{ $user->created_at->diffForHumans() }}
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
                                    <td colspan="4" class="px-6 py-4 text-center">
                                        No users found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <p class="block my-2 text-sm text-gray-400 sm:hidden ">
                        Showing <span class="font-bold">{{ $users->firstItem() }}</span> to <span class="font-bold">{{ $users->lastItem() }}</span> of
                        <span class="font-bold">{{ $users->total() }}</span> users
                    </p>

                    <div class="my-4">
                        {{ $users->links() }}
                    </div>
                </section>
            </div>
        </div>
    </div>
</x-app-layout>
