@extends('layouts.dashboard')

@section('title', 'Create Category')

@section('content')
<h1 class="text-2xl font-bold mb-4">Add New Category</h1>

<form action="{{ route('categories.store') }}" method="POST">
    @csrf
    <div class="mb-4">
        <label for="name" class="block font-medium">Name</label>
        <input type="text" name="name" id="name" class="border p-2 w-full" required>
    </div>
    <button type="submit" class="btn btn-primary">Save</button>
</form>
@endsection
