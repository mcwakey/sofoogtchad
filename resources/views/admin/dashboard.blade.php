@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('page-header')
    <h1>Dashboard</h1>
@endsection

@section('content')
    <div class="dashboard-welcome">
        <p>Welcome back, <strong>{{ $user->name }}</strong>!</p>
        <p>Your roles: {{ $roles->implode(', ') }}</p>
    </div>

    <div class="dashboard-stats">
        {{-- Stats widgets will go here --}}
    </div>
@endsection
