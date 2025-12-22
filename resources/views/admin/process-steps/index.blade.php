@extends('admin.layouts.app')

@section('title', 'Process Steps')

@section('content')
<div class="content-header">
    <h1>Process Steps</h1>
    <a href="{{ route('admin.process-steps.create') }}" class="btn btn-primary">Add New Step</a>
</div>

@if($steps->isEmpty())
    <div class="empty-state">
        <p>No process steps found.</p>
    </div>
@else
    <table class="table">
        <thead>
            <tr>
                <th>Order</th>
                <th>Title</th>
                <th>Description</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($steps as $step)
                <tr>
                    <td>{{ $step->sort_order }}</td>
                    <td>{{ $step->title }}</td>
                    <td>{{ Str::limit($step->description, 50) }}</td>
                    <td>
                        <span class="badge {{ $step->is_active ? 'badge-success' : 'badge-secondary' }}">
                            {{ $step->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('admin.process-steps.edit', $step) }}" class="btn btn-sm btn-secondary">Edit</a>
                        <form action="{{ route('admin.process-steps.destroy', $step) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif
@endsection
