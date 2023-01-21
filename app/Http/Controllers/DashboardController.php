<?php

namespace App\Http\Controllers;

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
        $view = 'dashboard';
        $viewData = [];

        if (auth()->user()->hasRole('admin')) {
            $view = 'admin-dashboard';
            $viewData = [
                'latestUsers' => User::latest()->take(5)->get(),
                'latestProducts' => Product::active()->with(['category', 'user'])->latest()->take(5)->get(),

                'totalUserCount' => User::count(),
                'totalProductCount' => Product::active()->count(),
            ];
        }

        return view($view, $viewData);
    }
}
