@extends('layouts.dashboard')

@section('title', 'Create Supplier')

@section('content')
    <h1 class="text-xl font-semibold mb-4">Create Supplier</h1>

    <form action="{{ route('suppliers.store') }}" method="POST" class="bg-white p-4 rounded shadow">
        @csrf

        <div class="mb-3">
            <label class="block">Name</label>
            <input name="name" value="{{ old('name') }}" class="w-full border p-2" required>
            @error('name') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="mb-3">
            <label class="block">Email</label>
            <input name="email" value="{{ old('email') }}" class="w-full border p-2">
            @error('email') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="mb-3">
            <label class="block">Phone</label>
            <input name="phone" value="{{ old('phone') }}" class="w-full border p-2">
        </div>

        <div class="mb-3">
            <label class="block">Address</label>
            <textarea name="address" class="w-full border p-2">{{ old('address') }}</textarea>
        </div>

        <div class="flex justify-end">
            <button class="px-4 py-2 bg-blue-600 text-white rounded">Save</button>
        </div>
    </form>
@endsection
