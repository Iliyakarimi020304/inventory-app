<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\StockLog;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('category')->paginate(25);
        return view('dashboard.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('dashboard.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'sku'=>'nullable|string|unique:products,sku',
            'name'=>'required|string|max:255',
            'category_id'=>'nullable|exists:categories,id',
            'purchase_price'=>'numeric|min:0',
            'sell_price'=>'numeric|min:0',
            'quantity'=>'integer|min:0',
            'min_stock'=>'integer|min:0',
            'description'=>'nullable|string',
        ]);

        $product = Product::create($data);

        // create initial stock log if quantity > 0
        if (!empty($data['quantity']) && $data['quantity'] > 0) {
            StockLog::create([
                'product_id'=>$product->id,
                'change'=>$data['quantity'],
                'type'=>'adjustment_in',
                'user_id'=>auth()->id(),
                'note'=>'Initial stock on product creation'
            ]);
        }

        return redirect()->route('products.index')->with('success','Product created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('dashboard.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::all();

        return view('dashboard.products.edit', [
            'product' => $product,
            'categories' => $categories,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'sku' => 'nullable|string|unique:products,sku,' . $product->id,
            'name' => 'required|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'purchase_price' => 'numeric|min:0',
            'sell_price' => 'numeric|min:0',
            'quantity' => 'integer|min:0',
            'min_stock' => 'integer|min:0',
            'description' => 'nullable|string',
        ]);

        $oldQuantity = $product->quantity;
        $newQuantity = $data['quantity'];

        $product->update($data);

        $difference = $newQuantity - $oldQuantity;

        if ($difference !== 0) {
            StockLog::create([
                'product_id' => $product->id,
                'change' => $difference,
                'type' => $difference > 0 ? 'adjustment_in' : 'adjustment_out',
                'user_id' => auth()->id(),
                'note' => 'Manual quantity update via product edit',
            ]);
        }

        return redirect()->route('products.index')->with('success', 'Product updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')->with('success', 'product deleted');
    }
}
