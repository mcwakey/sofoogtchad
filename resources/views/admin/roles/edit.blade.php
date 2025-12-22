@extends('admin.layouts.app')

@section('title', 'Edit Role')

@section('page-header')
    <h1>Edit Role: {{ $role->name }}</h1>
@endsection

@section('content')
    <form method="POST" action="{{ route('admin.roles.update', $role) }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Role Name</label>
            <input type="text" id="name" name="name" value="{{ old('name', $role->name) }}" required>
        </div>

        <button type="submit">Update Role</button>
        <a href="{{ route('admin.roles.index') }}">Cancel</a>
    </form>
@endsection
