@extends('layouts.dashboard')

@section('title', 'New Purchase Order')

@section('content')
<div class="bg-white p-4 rounded shadow space-y-4">

    <h1 class="text-xl font-semibold">New Purchase Order</h1>

    <form action="{{ route('purchase-orders.store') }}" method="POST">
        @csrf

        {{-- Supplier --}}
        <div>
            <label class="block text-sm font-medium mb-1">Supplier</label>
            <select name="supplier_id" class="border p-2 w-full">
                <option value="">-- Select supplier --</option>
                @foreach($suppliers as $sup)
                    <option value="{{ $sup->id }}">{{ $sup->name }}</option>
                @endforeach
            </select>
        </div>

        {{-- Items container --}}
        <div id="items">
            <h2 class="text-lg font-semibold mt-4">Items</h2>

            <div class="item-row flex gap-2 mb-2">
                <select name="items[0][product_id]" class="border p-2">
                    @foreach($products as $p)
                        <option value="{{ $p->id }}">{{ $p->name }}</option>
                    @endforeach
                </select>

                <input type="number" name="items[0][quantity]" class="border p-2 w-20" placeholder="Qty">

                <input type="number" step="0.01" name="items[0][unit_price]" class="border p-2 w-28" placeholder="Price">
            </div>
        </div>

        <button
            type="button"
            id="addRow"
            class="px-2 py-1 bg-gray-700 text-white rounded">
            + Add Item
        </button>

        {{-- Status --}}
        <div class="mt-4">
            <label class="block text-sm font-medium mb-1">Status</label>
            <select name="status" class="border p-2 w-full">
                <option value="received">received</option>
                <option value="pending">pending</option>
                <option value="cancelled">cancelled</option>
            </select>
        </div>

        <button
            class="mt-4 px-4 py-2 bg-blue-600 text-white rounded">
            Save Order
        </button>

    </form>
</div>

<script>
    let index = 1;

    document.getElementById('addRow').addEventListener('click', () => {
        const container = document.getElementById('items');

        const row = document.createElement('div');
        row.classList.add('item-row', 'flex', 'gap-2', 'mb-2');

        row.innerHTML = `
            <select name="items[${index}][product_id]" class="border p-2">
                @foreach($products as $p)
                    <option value="{{ $p->id }}">{{ $p->name }}</option>
                @endforeach
            </select>

            <input type="number" name="items[${index}][quantity]" class="border p-2 w-20" placeholder="Qty">

            <input type="number" step="0.01" name="items[${index}][unit_price]" class="border p-2 w-28" placeholder="Price">
        `;

        container.appendChild(row);
        index++;
    });
</script>

@endsection
