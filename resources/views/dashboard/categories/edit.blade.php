@extends('layouts.dashboard')

@section('title', 'Edit Category')

@section('content')
<h1 class="text-2xl font-bold mb-4">Edit Category</h1>

<form action="{{ route('categories.update', $category->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-4">
        <label for="name" class="block font-medium">Name</label>
        <input type="text" name="name" id="name" class="border p-2 w-full" value="{{ $category->name }}" required>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>
@endsection
