@extends('admin.layouts.app')

@section('title', 'Partners')

@section('content')
<div class="content-header">
    <h1>Partners</h1>
    <a href="{{ route('admin.partners.create') }}" class="btn btn-primary">Add New Partner</a>
</div>

<div class="filters" style="margin-bottom: 20px;">
    <form method="GET" action="{{ route('admin.partners.index') }}" style="display: flex; gap: 10px;">
        <select name="type" class="form-control" style="width: auto;">
            <option value="">All Types</option>
            <option value="partner" {{ request('type') === 'partner' ? 'selected' : '' }}>Partner</option>
            <option value="distributor" {{ request('type') === 'distributor' ? 'selected' : '' }}>Distributor</option>
            <option value="supplier" {{ request('type') === 'supplier' ? 'selected' : '' }}>Supplier</option>
        </select>
        <button type="submit" class="btn btn-secondary">Filter</button>
        @if(request('type'))
            <a href="{{ route('admin.partners.index') }}" class="btn btn-secondary">Clear</a>
        @endif
    </form>
</div>

@if($partners->isEmpty())
    <div class="empty-state">
        <p>No partners found.</p>
    </div>
@else
    <table class="table">
        <thead>
            <tr>
                <th>Order</th>
                <th>Logo</th>
                <th>Name</th>
                <th>Type</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($partners as $partner)
                <tr>
                    <td>{{ $partner->sort_order }}</td>
                    <td>
                        @if($partner->logo)
                            <img src="{{ $partner->logo_url }}" alt="{{ $partner->name }}" style="max-width: 60px; max-height: 40px;">
                        @else
                            <span style="color: #999;">No logo</span>
                        @endif
                    </td>
                    <td>
                        {{ $partner->name }}
                        @if($partner->is_featured)
                            <span class="badge badge-warning">Featured</span>
                        @endif
                    </td>
                    <td>{{ ucfirst($partner->type) }}</td>
                    <td>
                        <span class="badge {{ $partner->is_active ? 'badge-success' : 'badge-secondary' }}">
                            {{ $partner->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('admin.partners.edit', $partner) }}" class="btn btn-sm btn-secondary">Edit</a>
                        <form action="{{ route('admin.partners.destroy', $partner) }}" method="POST" style="display:inline;">
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
