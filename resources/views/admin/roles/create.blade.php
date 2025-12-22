@extends('admin.layouts.app')

@section('title', 'Create Role')

@section('page-header')
    <h1>Create Role</h1>
@endsection

@section('content')
    <form method="POST" action="{{ route('admin.roles.store') }}">
        @csrf

        <div class="form-group">
            <label for="name">Role Name</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required>
        </div>

        <button type="submit">Create Role</button>
        <a href="{{ route('admin.roles.index') }}">Cancel</a>
    </form>
@endsection
