@extends('layouts.dashboard')

@section('title', 'Create Product')

@section('content')
<h2 class="text-xl mb-4">New Product</h2>

<form action="{{ route('products.store') }}" method="POST">
    @csrf

    <div class="mb-2">
        <label>SKU</label>
        <input name="sku" class="w-full border p-2" value="{{ old('sku') }}">
    </div>

    <div class="mb-2">
        <label>Name</label>
        <input name="name" class="w-full border p-2" value="{{ old('name') }}" required>
    </div>

    <div class="mb-2">
        <label>Category</label>
        <select name="category_id" class="w-full border p-2">
            <option value="">-- none --</option>
            @foreach($categories as $c)
                <option value="{{ $c->id }}" @selected(old('category_id')==$c->id)>{{ $c->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="grid grid-cols-3 gap-2 mb-2">
        <input name="purchase_price" placeholder="Purchase price" class="border p-2" value="{{ old('purchase_price',0) }}">
        <input name="sell_price" placeholder="Sell price" class="border p-2" value="{{ old('sell_price',0) }}">
        <input name="quantity" placeholder="Quantity" type="number" class="border p-2" value="{{ old('quantity',0) }}">
    </div>

    <div class="mb-2">
        <label>Min stock</label>
        <input name="min_stock" type="number" class="w-full border p-2" value="{{ old('min_stock',0) }}">
    </div>

    <div>
        <button class="px-4 py-2 bg-green-600 text-white rounded">Create</button>
    </div>
</form>
@endsection
