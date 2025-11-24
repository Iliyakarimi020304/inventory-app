@extends('layout.dashboard')

@section('title', 'Dashboard')

@section('content')
<h1 class="text-2xl font-semibold">Welcome, {{ auth()->user()->name }}</h1>
<p class="text-gray-600 mt-2">You're inside your dashboard.</p>
@endsection
