@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<h1 class="text-2xl font-semibold">Welcome, {{ auth()->user()->name }}</h1>
@endsection
