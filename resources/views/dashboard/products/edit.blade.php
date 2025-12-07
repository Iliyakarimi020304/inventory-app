@extends('layouts.dashboard')

@section('title', 'Edit Product')

@section('content')
    <h1 class="text-xl font-semibold mb-4">Edit Product</h1>

    <div class="bg-white shadow rounded p-4">
        <form action="{{ route('products.update', $product->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-2 gap-4">

                <div>
                    <label class="block mb-1">Name</label>
                    <input name="name"
                           value="{{ old('name', $product->name) }}"
                           class="w-full border rounded p-2" required>
                </div>

                <div>
                    <label class="block mb-1">SKU</label>
                    <input name="sku"
                           value="{{ old('sku', $product->sku) }}"
                           class="w-full border rounded p-2">
                </div>

                <div>
                    <label class="block mb-1">Category</label>
                    <select name="category_id" class="w-full border rounded p-2">
                        <option value="">None</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}"
                                {{ old('category_id', $product->category_id) == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block mb-1">Purchase Price</label>
                    <input type="number" step="0.01" name="purchase_price"
                           value="{{ old('purchase_price', $product->purchase_price) }}"
                           class="w-full border rounded p-2">
                </div>

                <div>
                    <label class="block mb-1">Sell Price</label>
                    <input type="number" step="0.01" name="sell_price"
                           value="{{ old('sell_price', $product->sell_price) }}"
                           class="w-full border rounded p-2">
                </div>

                <div>
                    <label class="block mb-1">Quantity</label>
                    <input type="number" name="quantity"
                           value="{{ old('quantity', $product->quantity) }}"
                           class="w-full border rounded p-2">
                </div>

                <div>
                    <label class="block mb-1">Min Stock</label>
                    <input type="number" name="min_stock"
                           value="{{ old('min_stock', $product->min_stock) }}"
                           class="w-full border rounded p-2">
                </div>

                <div class="col-span-2">
                    <label class="block mb-1">Description</label>
                    <textarea name="description"
                              class="w-full border rounded p-2 h-24">{{ old('description', $product->description) }}</textarea>
                </div>
            </div>

            <div class="mt-4 flex justify-end">
                <button class="px-4 py-2 bg-blue-600 text-white rounded">
                    Update
                </button>
            </div>
        </form>
    </div>
@endsection
