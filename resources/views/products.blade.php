@extends('layouts.public')
@section('content')
    <!-- If any errors are found, display them here -->
    @if ($errors->any())
        <div class="container px-5 py-4 mx-auto">
            <div class="flex flex-col w-full mb-12 text-center">
                <h1 class="text-2xl font-medium text-gray-900 sm:text-3xl title-font">Whoops!</h1>
                <h3 class="text-lg font-medium text-gray-700 sm:text-lg">Something went wrong</h3>
            </div>
            <div class="flex flex-col w-full mb-12 text-center">
                <ul class="text-sm text-red-500 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <!-- Latest Products -->
    <section class="text-gray-600 bg-gray-100 body-font">
        <div class="container px-5 pt-12 pb-10 mx-auto">
            <div class="flex flex-col w-full mb-20 text-center">
                <h1 class="text-2xl font-medium text-gray-900 sm:text-3xl title-font">{{ $farmer->name }}</h1>
                <h3 class="text-lg font-medium text-gray-700 sm:text-lg">All Products</h3>
            </div>
            <ul class="w-full space-y-2">
                @foreach ($products as $product)
                    <li class="pb-2 border-b">
                        <div class="flex flex-col gap-2 md:items-center md:justify-between md:flex-row">
                            <div class="flex items-center gap-6">
                                <img src="{{ Storage::url($product->image_url) }}" alt="{{ $product->title }}" class="w-24 h-24 rounded-md">
                                <div>
                                    <h3 class="text-lg font-medium text-gray-900">Title: {{ $product->title }}</h3>
                                    <p class="text-sm font-medium text-gray-700">Category: {{ $product->category->title }}</p>
                                    <p class="text-sm font-medium text-gray-700">Price: {{ $product->price }} Tk</p>
                                </div>
                            </div>
                            <div>
                                <form action="{{ route('cart.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="farmer_id" value="{{ $farmer->id }}">
                                    <button type="submit" class="inline-flex items-center px-3 py-2 mt-4 text-base text-white bg-pink-500 border-0 rounded focus:outline-none hover:bg-pink-700 md:mt-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-1">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                                        </svg>
                                        Add to cart
                                    </button>
                                </form>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </section>
@endsection
