@extends('layouts.dashboard')

@section('title', 'Create Product')

@section('content')
    <h1 class="text-xl font-semibold mb-4">Create Product</h1>

    <div class="bg-white shadow rounded p-4">

        {{-- Global success/error --}}
        {{-- @include('partials.alerts') --}}

        <form action="{{ route('products.store') }}" method="POST">
            @csrf

            <div class="grid grid-cols-2 gap-4">

                <div>
                    <label class="block mb-1">Name</label>
                    <input name="name"
                           class="w-full border rounded p-2"
                           value="{{ old('name') }}" required>

                    @error('name')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block mb-1">SKU</label>
                    <input name="sku"
                           class="w-full border rounded p-2"
                           value="{{ old('sku') }}">

                    @error('sku')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block mb-1">Category</label>
                    <select name="category_id" class="w-full border rounded p-2">
                        <option value="">None</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}"
                                {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>

                    @error('category_id')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block mb-1">Purchase Price</label>
                    <input type="number"
                           name="purchase_price"
                           step="0.01"
                           class="w-full border rounded p-2"
                           value="{{ old('purchase_price') }}">

                    @error('purchase_price')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block mb-1">Sell Price</label>
                    <input type="number"
                           name="sell_price"
                           step="0.01"
                           class="w-full border rounded p-2"
                           value="{{ old('sell_price') }}">

                    @error('sell_price')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block mb-1">Quantity</label>
                    <input type="number"
                           name="quantity"
                           class="w-full border rounded p-2"
                           value="{{ old('quantity') }}">

                    @error('quantity')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block mb-1">Min Stock</label>
                    <input type="number"
                           name="min_stock"
                           class="w-full border rounded p-2"
                           value="{{ old('min_stock') }}">

                    @error('min_stock')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="col-span-2">
                    <label class="block mb-1">Description</label>
                    <textarea name="description"
                              class="w-full border rounded p-2 h-24">{{ old('description') }}</textarea>

                    @error('description')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

            </div>

            <div class="mt-4 flex justify-end">
                <button class="px-4 py-2 bg-blue-600 text-white rounded">
                    Save
                </button>
            </div>
        </form>
    </div>
@endsection
