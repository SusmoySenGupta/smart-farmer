<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $orders = Order::query()
            ->with(['products', 'farmer', 'customer'])
            ->when(auth()->user()->isFarmer(), fn($query) => $query->where('farmer_id', auth()->id()))
            ->when(auth()->user()->isCustomer(), fn($query) => $query->where('customer_id', auth()->id()))
            ->when($request->search, fn($query) => $query->where('id', $request->search))
            ->latest()
            ->paginate(10);

        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\View\View
     */
    public function show(Order $order): View
    {
        $order->load(['products', 'farmer', 'customer']);

        return view('orders.show', compact('order'));
    }

    /**
     * Mark the specified order as delivered.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function markAsDelivered(Order $order)
    {
        $order->update(['is_delivered' => true]);

        return redirect()->route('orders.index')
            ->with('success', 'Order marked as delivered.');
    }
}
