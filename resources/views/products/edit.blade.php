<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Edit Product') }}
        </h2>
    </x-slot>
    <div class="pt-12 pb-4">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="p-4 overflow-hidden bg-white shadow sm:p-8 dark:bg-gray-800 sm:rounded-lg">
                <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    @include('products.form', ['product' => $product])

                    <x-primary-button type="submit" class="mt-4">
                        {{ __('Update') }}
                    </x-primary-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
