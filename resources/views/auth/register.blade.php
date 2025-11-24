@extends('layout.auth')

@section('title', 'Register')

@section('content')
<form action="/register" method="POST">
    @csrf

    <h2 class="text-xl font-semibold mb-4">Register</h2>

    @if ($errors->any())
        <div class="bg-red-100 text-red-600 p-2 mb-3 rounded">
            {{ $errors->first() }}
        </div>
    @endif

    <div class="mb-3">
        <label>Name</label>
        <input type="text" name="name" class="w-full border p-2 rounded" required>
    </div>

    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="w-full border p-2 rounded" required>
    </div>

    <div class="mb-3">
        <label>Password</label>
        <input type="password" name="password" class="w-full border p-2 rounded" required>
    </div>

    <div class="mb-3">
        <label>Confirm Password</label>
        <input type="password" name="password_confirmation" class="w-full border p-2 rounded" required>
    </div>

    <button class="w-full bg-green-600 text-white p-2 rounded">Register</button>

    <p class="mt-3 text-sm">
        Already have an account? <a href="/login" class="text-blue-600">Login</a>
    </p>
</form>
@endsection
