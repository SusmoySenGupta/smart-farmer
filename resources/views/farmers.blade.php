@extends('layouts.public')
@section('content')
    <section class="text-gray-600 bg-gray-100 body-font">
        <div class="container px-5 pt-12 pb-10 mx-auto">
            <div class="flex flex-col w-full mb-20 text-center">
                <h1 class="text-2xl font-medium text-gray-900 sm:text-3xl title-font">All Farmers</h1>
                <form action="{{ route('farmers') }}" method="GET" class="mt-4">
                    <x-search-box name="search" placeholder="Search Farmer..." :route="route('farmers')" />
                </form>
            </div>
            <div class="grid grid-cols-1 gap-4 -m-4 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                @foreach ($farmers as $farmer)
                    <div class="p-4 border rounded-md w-72">
                        <a class="relative block overflow-hidden rounded h-30">
                            <img alt="ecommerce" class="block object-cover object-center w-full h-full" src="https://ui-avatars.com/api/?background=a5b4fc&color=f1f5f9&name={{ $farmer?->name }}">
                        </a>
                        <div class="flex items-center justify-between gap-6 mt-4">
                            <div>
                                <h2 class="font-medium text-gray-900 text-md title-font">{{ $farmer->name }}</h2>
                                <p class="mt-1 text-sm">Total sales: {{ $farmer->farmer_orders_count }}</p>
                            </div>
                            <div>
                                <a href="{{ route('farmer.products', $farmer) }}" class="inline-flex items-center px-3 py-1 mt-4 text-xs font-medium text-white bg-indigo-500 border-0 rounded focus:outline-none hover:bg-indigo-600">
                                    Order
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="flex flex-col w-full mt-20 text-center">
                {{ $farmers->links() }}
            </div>
        </div>
    </section>
@endsection
