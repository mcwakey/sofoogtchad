@extends('admin.layouts.app')

@section('title', 'Roles')

@section('page-header')
    <h1>Roles</h1>
    <a href="{{ route('admin.roles.create') }}" class="btn btn-primary">Add Role</a>
@endsection

@section('content')
    <table class="data-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Users Count</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($roles as $role)
                <tr>
                    <td>{{ $role->id }}</td>
                    <td>{{ $role->name }}</td>
                    <td>{{ $role->users_count }}</td>
                    <td>
                        <a href="{{ route('admin.roles.edit', $role) }}">Edit</a>
                        <form action="{{ route('admin.roles.destroy', $role) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">No roles found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
