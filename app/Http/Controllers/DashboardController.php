<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $latestUsers = User::latest()->take(5)->get();
        $latestProducts = Product::active()->with(['category', 'user'])->latest()->take(5)->get();

        $totalUserCount = User::count();
        $totalProductCount = Product::active()->count();
        $totalOrderCount = 0;

        return view('dashboard', compact(
            'latestUsers',
            'latestProducts',
            'totalUserCount',
            'totalProductCount',
            'totalOrderCount'
        ));
    }
}
