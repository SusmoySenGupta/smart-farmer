<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    const PUBLIC_PATH = 'public/images';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $searchCallBacks = [
            'title' => function ($query, $search) {
                $query->where('title', 'like', "%{$search}%");
            },
            'category' => function ($query, $search) {
                $query->whereHas('category', function ($query) use ($search) {
                    $query->where('title', 'like', "%{$search}%");
                });
            },
            'created_by' => function ($query, $search) {
                $query->whereHas('user', function ($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%");
                });
            },
        ];

        $products = Product::query()
            ->with(['category', 'user'])
            ->when(auth()->user()->isFarmer(), function ($query) {
                $query->where('user_id', auth()->id());
            })
            ->when($request->search_by, function ($query) use ($request, $searchCallBacks) {
                $searchCallBacks[$request->search_by]($query, $request->search);
            })
            ->latest()
            ->paginate(10);

        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!auth()->user()->isFarmer()) {
            return redirect()->route('products.index')->with('error', 'You are not allowed to create a product.');
        }

        $categories = Category::all();

        return view('products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Requests\ProductStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductStoreRequest $request)
    {
        $imagePath = null;

        try {
            DB::beginTransaction();

            $imagePath = $this->saveImage($request->file('image'));
            auth()->user()->products()->create($request->validated() + ['image_url' => $imagePath]);

            DB::commit();
        } catch (\Exception$e) {
            DB::rollBack();

            if (Storage::exists($imagePath)) {
                Storage::delete($imagePath);
            }

            return redirect()->back()->with('error', $e->getMessage())->withInput();
        }

        return redirect()->route('products.index')->with('success', 'Product created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        if (!auth()->user()->isFarmer()) {
            return redirect()->route('products.index')->with('error', 'You are not allowed to create a product.');
        }

        $categories = Category::all();

        return view('products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductUpdateRequest $request, Product $product)
    {
        $imagePath = null;

        try {
            DB::beginTransaction();

            if ($request->hasFile('image')) {
                $imagePath = $this->saveImage($request->file('image'));
            }

            $product->update($request->validated() + ['image_url' => $imagePath ?? $product->image_url]);

            DB::commit();
        } catch (\Exception$e) {
            DB::rollBack();

            if (Storage::exists($imagePath)) {
                Storage::delete($imagePath);
            }

            return redirect()->back()->with('error', $e->getMessage())->withInput();
        }

        return redirect()->route('products.index')->with('success', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully');
    }

    /**
     * Save image to storage.
     *
     * @param Object $file
     * @param Element $element
     * @return string $imagePath
     */
    private function saveImage(Object $file): string
    {
        $extension = $file->extension();
        $filename = uniqid() . '.' . $extension;
        $imagePath = $file->storeAs(self::PUBLIC_PATH, $filename);

        return $imagePath;
    }
}
