<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @return \Illuminate\View\View
     */
    public function __invoke(): View
    {
        $user = auth()->user();

        $viewAndData = collect([
            'admin' => [
                'view' => 'dashboard.admin-dashboard',
                'data' => [
                    'latestUsers' => User::latest()->take(5)->get(),
                    'latestProducts' => Product::active()->with(['category', 'user'])->latest()->take(5)->get(),

                    'totalUserCount' => User::count(),
                    'totalProductCount' => Product::active()->count(),
                ],
            ],
            'farmer' => [
                'view' => 'dashboard.farmer-dashboard',
                'data' => [
                    'latestProducts' => $user->products()->with('category')->latest()->take(5)->get(),
                    'latestOrders' => Order::where('farmer_id', $user->id)->with('customer')->latest()->take(5)->get(),

                    'productsCount' => Product::active()->count(),
                    'pendingOrderCount' => Order::pending()->where('farmer_id', $user->id)->count(),
                ],
            ],
        ])->get($user?->roles?->first()?->name ?? 'guest');

        return view($viewAndData['view'], $viewAndData['data']);
    }
}
