@extends('layouts.dashboard')

@section('title', 'Categories')

@section('content')
<h1 class="text-2xl font-bold mb-4">Categories</h1>

<a href="{{ route('categories.create') }}" class="btn btn-primary mb-4">Add New Category</a>

<table class="table-auto w-full border">
    <thead>
        <tr>
            <th class="border px-4 py-2">ID</th>
            <th class="border px-4 py-2">Name</th>
            <th class="border px-4 py-2">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($categories as $category)
        <tr>
            <td class="border px-4 py-2">{{ $category->id }}</td>
            <td class="border px-4 py-2">{{ $category->name }}</td>
            <td class="border px-4 py-2">
                <a href="{{ route('categories.edit', $category->id) }}" class="text-blue-500">Edit</a>
                <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-500 ml-2">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
