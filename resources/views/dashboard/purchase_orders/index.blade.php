@extends('layouts.dashboard')

@section('title', 'Purchase Orders')

@section('content')
    <h1 class="text-xl font-semibold mb-4">Purchase Orders</h1>

    <div class="flex justify-end mb-4">
        <a href="{{ route('purchase-orders.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded">
            New Purchase Order
        </a>
    </div>

    <div class="bg-white shadow rounded p-4">
        <table class="w-full border">
            <thead>
                <tr class="bg-gray-100 border-b">
                    <th class="p-2 text-left">Order #</th>
                    <th class="p-2 text-left">Supplier</th>
                    <th class="p-2 text-left">Status</th>
                    <th class="p-2 text-left">Total</th>
                    <th class="p-2 text-left">Created At</th>
                    <th class="p-2 text-left">Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse($orders as $order)
                    <tr class="border-b">
                        <td class="p-2">{{ $order->order_number }}</td>
                        <td class="p-2">{{ $order->supplier->name }}</td>
                        <td class="p-2">{{ ucfirst($order->status) }}</td>
                        <td class="p-2">{{ $order->total }}</td>
                        <td class="p-2">{{ $order->created_at->format('Y-m-d') }}</td>
                        <td class="p-2">
                            <a href="{{ route('purchase-orders.show', $order->id) }}" class="text-blue-600">View</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="p-2 text-center" colspan="6">No purchase orders yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-4">
            {{ $orders->links() }}
        </div>
    </div>
@endsection
