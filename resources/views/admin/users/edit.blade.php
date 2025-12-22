@extends('admin.layouts.app')

@section('title', 'Edit User')

@section('page-header')
    <h1>Edit User: {{ $user->name }}</h1>
@endsection

@section('content')
    <form method="POST" action="{{ route('admin.users.update', $user) }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required>
        </div>

        <div class="form-group">
            <label for="password">Password (leave blank to keep current)</label>
            <input type="password" id="password" name="password">
        </div>

        <div class="form-group">
            <label for="password_confirmation">Confirm Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation">
        </div>

        <div class="form-group">
            <label>Roles</label>
            @foreach($roles as $role)
                <label>
                    <input type="checkbox" name="roles[]" value="{{ $role->id }}"
                        {{ $user->roles->contains($role->id) ? 'checked' : '' }}>
                    {{ $role->name }}
                </label>
            @endforeach
        </div>

        <button type="submit">Update User</button>
        <a href="{{ route('admin.users.index') }}">Cancel</a>
    </form>
@endsection
