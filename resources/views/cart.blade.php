@extends('layouts.public')
@section('content')
    <section class="text-gray-600 bg-gray-100 body-font">
        <div class="container px-5 pt-4 pb-10 mx-auto">
            <div class="flex flex-col my-10 md:flex-row">
                <div class="w-full px-10 py-10 bg-white md:w-3/4">
                    <div class="flex justify-between pb-8 border-b">
                        <h1 class="text-2xl font-semibold">Shopping Cart</h1>
                        <h2 class="text-2xl font-semibold">{{ $itemsCount }} Items</h2>
                    </div>
                    <div class="flex mt-10 mb-5">
                        <h3 class="w-2/5 text-xs font-semibold text-gray-600 uppercase">Product Details</h3>
                        <h3 class="w-1/5 text-xs font-semibold text-center text-gray-600 uppercase">Quantity (Kg)</h3>
                        <h3 class="w-1/5 text-xs font-semibold text-center text-gray-600 uppercase">Price (Tk)</h3>
                        <h3 class="w-1/5 text-xs font-semibold text-center text-gray-600 uppercase">Action</h3>
                    </div>
                    @forelse ($cart->products as $product)
                        <form id="destroy-product-{{ $product->id }}" action="{{ route('cart.destroy-product', $product) }}" method="POST">
                            @csrf
                            @method('DELETE')
                        </form>
                        <!-- product -->
                        <form action="{{ route('cart.update', $product) }}" method="POST" class="flex items-center px-6 py-5 -mx-8 hover:bg-gray-100">
                            @csrf
                            @method('PUT')
                            <div class="flex w-2/5">
                                <div class="w-24">
                                    <img class="w-24 h-24" src="{{ Storage::url($product->image_url) }}" alt="{{ $product->title }}">
                                </div>
                                <div class="flex flex-col items-start justify-between flex-grow ml-4">
                                    <span class="text-sm font-bold">{{ $product->title }}</span>
                                    <button type="submit" form="destroy-product-{{ $product->id }}" class="text-xs font-semibold text-gray-500 hover:text-red-500">Remove</button>
                                </div>
                            </div>
                            <div class="flex justify-center w-1/5">
                                <x-text-input type="number" name="quantity" min="0" :value="$product->pivot->quantity" class="w-24" />
                            </div>
                            <span class="w-1/5 text-sm font-semibold text-center">{{ $product->price }}</span>

                            <button type="submit" class="w-1/5 text-sm font-semibold text-center text-blue-500 hover:text-blue-600">Update</button>
                        </form>
                    @empty
                        <div class="flex justify-center w-full mt-8">
                            <p class="text-xl font-semibold">No items in cart</p>
                        </div>
                    @endforelse
                    @if ($cart->products->count() > 0)
                        <form action="{{ route('cart.destroy', $cart) }}" method="POST" class="flex justify-center w-full mt-8">
                            @csrf
                            @method('DELETE')
                            <x-primary-button>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>

                                Clear Cart
                            </x-primary-button>
                        </form>
                    @endif
                </div>

                <form action="{{ route('orders.store') }}" method="POST" id="summary" class="w-full px-8 py-10 bg-gray-200 md:w-1/4">
                    @csrf
                    <h1 class="pb-8 text-2xl font-semibold border-b">Order Summary</h1>

                    <div class="border-t ">
                        <div class="flex justify-between py-6 text-sm font-semibold uppercase">
                            <span>Total cost</span>
                            <span>{{ $totalPrice }} Tk</span>
                        </div>
                    </div>
                    <div class="mt-4 mb-6">
                        <label for="promo" class="inline-block mb-3 text-sm font-semibold uppercase">Shipping Address</label>
                        <x-textarea-input name="address" rows="3" class="w-full h-24" required />
                    </div>
                    <button type="submit" class="w-full py-3 text-sm font-semibold text-white uppercase bg-indigo-500 hover:bg-indigo-600">Place Order</button>
                </form>
            </div>
        </div>
    </section>
@endsection
