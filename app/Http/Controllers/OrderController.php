<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        $request->validate([
            'address' => 'required|string|max:500',
        ]);

        $cart = auth()->user()->cart()->first();

        if (!$cart) {
            return redirect()->back()->withErrors('Your cart is empty.');
        }

        $totalPrice = $cart->products->sum(function ($product) {
            return $product->price * $product->pivot->quantity;
        });

        if ($totalPrice > auth()->user()->balance) {
            return redirect()->back()->withErrors('You do not have enough balance in your wallet to place this order.');
        }

        DB::beginTransaction();

        $order = Order::create([
            'farmer_id' => $cart->farmer_id,
            'customer_id' => auth()->id(),
            'address' => $request->address,
            'total' => $totalPrice,
        ]);

        $order->products()->attach($cart->products->mapWithKeys(function ($product) {
            return [$product->id => [
                'quantity' => $product->pivot->quantity,
                'amount' => $product->price,
            ]];
        }));

        $cart->delete();
        auth()->user()->update(['balance' => auth()->user()->balance - $totalPrice]);

        DB::commit();

        return redirect()->route('orders.show', $order)
            ->with('success', 'Order placed successfully.');
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
