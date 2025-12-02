@extends('layouts.dashboard')

@section('title', 'Dashboard')

@section('content')
<div class="space-y-4">
    <h1 class="text-2xl font-semibold">Dashboard</h1>

    <div class="grid grid-cols-3 gap-4">
        <div class="p-4 bg-white shadow rounded">
            <div class="text-sm text-gray-500">Total products</div>
            <div class="text-2xl font-bold">{{ \App\Models\Product::count() }}</div>
        </div>

        <div class="p-4 bg-white shadow rounded">
            <div class="text-sm text-gray-500">Total categories</div>
            <div class="text-2xl font-bold">{{ \App\Models\Category::count() }}</div>
        </div>

        <div class="p-4 bg-white shadow rounded">
            <div class="text-sm text-gray-500">Low stock items</div>
            <div class="text-2xl font-bold">{{ \App\Models\Product::whereColumn('quantity','<','min_stock')->count() }}</div>
        </div>
    </div>
</div>
@endsection
