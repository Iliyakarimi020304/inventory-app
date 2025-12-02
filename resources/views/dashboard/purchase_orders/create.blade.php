@extends('layouts.dashboard')

@section('title','Create Purchase Order')

@section('content')
<h2>Create Purchase Order</h2>

<form action="{{ route('purchase-orders.store') }}" method="POST">
    @csrf

    <div class="mb-2">
        <label>Supplier</label>
        <select name="supplier_id" class="w-full border p-2" required>
            @foreach($suppliers as $s)
                <option value="{{ $s->id }}">{{ $s->name }}</option>
            @endforeach
        </select>
    </div>

    <p class="mb-2 text-sm text-gray-500">Enter items (product id, quantity, unit price). Submit minimal 1 item.</p>

    <div class="mb-2">
        <label>Item 1 - Product ID</label>
        <input name="items[0][product_id]" class="w-full border p-2" required>
    </div>
    <div class="mb-2">
        <label>Item 1 - Quantity</label>
        <input name="items[0][quantity]" class="w-full border p-2" value="1" required>
    </div>
    <div class="mb-2">
        <label>Item 1 - Unit price</label>
        <input name="items[0][unit_price]" class="w-full border p-2" value="0" required>
    </div>

    <div class="mt-4">
        <button class="px-4 py-2 bg-blue-600 text-white">Create & Receive</button>
    </div>
</form>
@endsection
