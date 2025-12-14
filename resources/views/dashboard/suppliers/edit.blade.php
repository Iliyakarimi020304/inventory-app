@extends('layouts.dashboard')

@section('title', 'Edit Supplier')

@section('content')
    <h1 class="text-xl font-semibold mb-4">Edit Supplier</h1>

    <form action="{{ route('suppliers.update', $supplier) }}" method="POST" class="bg-white p-4 rounded shadow">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="block">Name</label>
            <input name="name" value="{{ old('name', $supplier->name) }}" class="w-full border p-2" required>
            @error('name') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

        <!-- email, phone, address same pattern using old(..., $supplier->field) -->

        <div class="flex justify-end">
            <button class="px-4 py-2 bg-blue-600 text-white rounded">Update</button>
        </div>
    </form>
@endsection
