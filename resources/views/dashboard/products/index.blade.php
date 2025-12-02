@extends('layouts.dashboard')

@section('title', 'Products')

@section('content')
<div class="flex justify-between items-center mb-4">
    <h2 class="text-xl font-semibold">Products</h2>
    <a href="{{ route('products.create') }}" class="px-3 py-1 bg-blue-600 text-white rounded">New Product</a>
</div>

<table class="min-w-full bg-white">
    <thead>
        <tr>
            <th class="px-2 py-1">SKU</th>
            <th class="px-2 py-1">Name</th>
            <th class="px-2 py-1">Category</th>
            <th class="px-2 py-1">Qty</th>
            <th class="px-2 py-1">Min</th>
            <th class="px-2 py-1">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($products as $p)
            <tr class="border-t">
                <td class="px-2 py-1">{{ $p->sku }}</td>
                <td class="px-2 py-1">{{ $p->name }}</td>
                <td class="px-2 py-1">{{ optional($p->category)->name }}</td>
                <td class="px-2 py-1">{{ $p->quantity }}</td>
                <td class="px-2 py-1">{{ $p->min_stock }}</td>
                <td class="px-2 py-1">
                    <a href="{{ route('products.edit', $p) }}" class="text-blue-600">Edit</a>
                    <form action="{{ route('products.destroy', $p) }}" method="POST" class="inline-block" onsubmit="return confirm('Delete?')">
                        @csrf @method('DELETE')
                        <button class="text-red-600 ml-2">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="mt-4">
    {{ $products->links() }}
</div>
@endsection
