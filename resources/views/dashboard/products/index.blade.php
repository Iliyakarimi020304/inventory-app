@extends('layouts.dashboard')

@section('title', 'Products')

@section('content')


    <div class="flex justify-between items-center mb-4">
        <h1 class="text-xl font-semibold">Products</h1>
        <a href="{{ route('products.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded">+ New Product</a>
    </div>

    <div class="bg-white shadow rounded p-4">
        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-gray-100 border-b">
                    <th class="p-2 text-left">Name</th>
                    <th class="p-2 text-left">Category</th>
                    <th class="p-2 text-left">SKU</th>
                    <th class="p-2 text-left">Quantity</th>
                    <th class="p-2 text-left">Min Stock</th>
                    <th class="p-2 text-left">Price</th>
                    <th class="p-2 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                    <tr class="border-b">
                        <td class="p-2">{{ $product->name }}</td>
                        <td class="p-2">{{ $product->category->name ?? '—' }}</td>
                        <td class="p-2">{{ $product->sku ?? '—' }}</td>
                        <td class="p-2">{{ $product->quantity }}</td>
                        <td class="p-2">{{ $product->min_stock }}</td>
                        <td class="p-2">{{ $product->sell_price }}</td>
                        <td class="p-2 flex gap-2">
                            <a href="{{ route('products.edit', $product) }}" class="text-blue-600">Edit</a>

                            <form action="{{ route('products.destroy', $product) }}" method="POST"
                                  onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-600">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="p-2 text-center" colspan="7">No products found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-4">
            {{ $products->links() }}
        </div>
    </div>
@endsection
