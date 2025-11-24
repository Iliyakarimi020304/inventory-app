@extends('layout.auth')

@section('title', 'Login')

@section('content')
<form action="/login" method="POST">
    @csrf

    <h2 class="text-xl font-semibold mb-4">Login</h2>

    @if ($errors->any())
        <div class="bg-red-100 text-red-600 p-2 mb-3 rounded">
            {{ $errors->first() }}
        </div>
    @endif

    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="w-full border p-2 rounded" required>
    </div>

    <div class="mb-3">
        <label>Password</label>
        <input type="password" name="password" class="w-full border p-2 rounded" required>
    </div>

    <button class="w-full bg-blue-600 text-white p-2 rounded">Login</button>

    <p class="mt-3 text-sm">
        Don’t have an account? <a href="/register" class="text-blue-600">Register</a>
    </p>
</form>
@endsection
