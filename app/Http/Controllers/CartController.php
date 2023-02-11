<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cart = auth()->user()->cart()->first()->load('products');
        $itemsCount = $cart->products->count();
        $totalPrice = $cart->products->sum(function ($product) {
            return $product->price * $product->pivot->quantity;
        });

        return view('cart', compact('cart', 'itemsCount', 'totalPrice'));
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
            'product_id' => 'required|exists:products,id',
            'farmer_id' => 'required|exists:users,id',
            'quantity' => 'sometimes|numeric|min:1',
        ]);

        $cart = $request->user()->cart()->first();

        if (!$cart) {
            $cart = $request->user()->cart()->create(['farmer_id' => $request->farmer_id]);
        } else if ($cart->farmer_id != $request->farmer_id) {
            return redirect()->back()->withErrors('You can only add products from one farmer at a time. Clear your cart to add products from another farmer.');
        }

        $product = $cart->products()->where('product_id', $request->product_id)->first();

        if ($product) {
            $product->pivot->quantity = $request->quantity ?? $product->pivot->quantity + 1;
            $product->pivot->save();
        } else {
            $cart->products()->attach($request->product_id, [
                'quantity' => $request->quantity ?? 1,
            ]);
        }

        return redirect()->back()->with('success', 'Product added to cart.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'quantity' => 'required|numeric|min:0',
        ]);

        $cart = $request->user()->cart()->first();
        $product = $cart->products()->where('product_id', $product->id)->first();

        if ($request->quantity == 0) {
            $product->pivot->delete();

            return redirect()->back()->with('success', 'Product removed from cart.');
        }

        if ($product) {
            $product->pivot->quantity = $request->quantity;
            $product->pivot->save();
        }

        return redirect()->back()->with('success', 'Product quantity updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cart $cart)
    {
        $cart->products()->detach();

        return redirect()->back()->with('success', 'Cart cleared.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyProduct(Product $product)
    {
        $cart = auth()->user()->cart()->first();
        $product = $cart->products()->where('product_id', $product->id)->first();

        $product->pivot->delete();

        return redirect()->back()->with('success', 'Product removed from cart.');
    }
}
