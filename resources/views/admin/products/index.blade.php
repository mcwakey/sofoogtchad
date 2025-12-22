@extends('admin.layouts.app')

@section('title', 'Products')

@section('page-header')
    <h1>Products</h1>
    <a href="{{ route('admin.products.create') }}" class="btn btn-primary">Add Product</a>
@endsection

@section('content')
    {{-- Filters --}}
    <form method="GET" action="{{ route('admin.products.index') }}" class="filters-form">
        <select name="category">
            <option value="">All Categories</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>

        <select name="type">
            <option value="">All Types</option>
            @foreach($types as $value => $label)
                <option value="{{ $value }}" {{ request('type') === $value ? 'selected' : '' }}>
                    {{ $label }}
                </option>
            @endforeach
        </select>

        <select name="status">
            <option value="">All Status</option>
            <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active</option>
            <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
        </select>

        <button type="submit">Filter</button>
        <a href="{{ route('admin.products.index') }}">Reset</a>
    </form>

    <table class="data-table">
        <thead>
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Category</th>
                <th>Type</th>
                <th>Status</th>
                <th>Featured</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($products as $product)
                <tr>
                    <td>
                        @if($product->image_url)
                            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" style="width:50px;height:50px;object-fit:cover;">
                        @else
                            <span>No image</span>
                        @endif
                    </td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->category?->name ?? 'Uncategorized' }}</td>
                    <td>{{ $product->type_label }}</td>
                    <td>
                        <span class="badge {{ $product->is_active ? 'badge-success' : 'badge-warning' }}">
                            {{ $product->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                    <td>{{ $product->is_featured ? 'Yes' : 'No' }}</td>
                    <td>
                        <a href="{{ route('admin.products.edit', $product) }}">Edit</a>
                        @if($product->is_active)
                            <a href="{{ route('products.show', $product->slug) }}" target="_blank">View</a>
                        @endif
                        <form action="{{ route('admin.products.destroy', $product) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Delete this product?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">No products found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $products->withQueryString()->links() }}
@endsection
