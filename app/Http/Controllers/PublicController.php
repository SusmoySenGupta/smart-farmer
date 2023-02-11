<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PublicController extends Controller
{
    /**
     * Show the application welcome page.
     *
     * @return Illuminate\View\View
     */
    public function welcome(): View
    {
        $farmers = User::farmer()
            ->withCount('farmerOrders')
            ->orderBy('farmer_orders_count', 'desc')->take(8)->get();

        return view('welcome', compact('farmers'));
    }

    /**
     * Show the application farmers page.
     *
     * @return Illuminate\View\View
     */
    public function farmer(Request $request): View
    {
        $farmers = User::farmer()
            ->when($request->has('search'), function ($query) use ($request) {
                $query->where('name', 'like', "%{$request->search}%");
            })
            ->withCount('farmerOrders')
            ->orderBy('farmer_orders_count', 'desc')
            ->paginate(12);

        return view('farmers', compact('farmers'));
    }

    /**
     * Show products of a farmer.
     *
     * @return Illuminate\View\View
     */
    public function product(User $farmer): View
    {
        $products = $farmer->productsInStock()
            ->active()
            ->with('category')
            ->latest()->get();

        return view('products', compact('products', 'farmer'));
    }
}
