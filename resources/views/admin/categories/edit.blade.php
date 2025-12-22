@extends('admin.layouts.app')

@section('title', 'Edit Category: ' . $category->name)

@section('page-header')
    <h1>Edit Category: {{ $category->name }}</h1>
@endsection

@section('content')
    <form method="POST" action="{{ route('admin.categories.update', $category) }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Name *</label>
            <input type="text" id="name" name="name" value="{{ old('name', $category->name) }}" required>
        </div>

        <div class="form-group">
            <label for="slug">Slug *</label>
            <input type="text" id="slug" name="slug" value="{{ old('slug', $category->slug) }}" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" name="description" rows="4">{{ old('description', $category->description) }}</textarea>
        </div>

        <div class="form-group">
            <label for="image">Image URL</label>
            <input type="text" id="image" name="image" value="{{ old('image', $category->image) }}">
        </div>

        <div class="form-group">
            <label for="sort_order">Sort Order</label>
            <input type="number" id="sort_order" name="sort_order" value="{{ old('sort_order', $category->sort_order) }}" min="0">
        </div>

        <div class="form-group">
            <label>
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $category->is_active) ? 'checked' : '' }}>
                Active
            </label>
        </div>

        <button type="submit">Update Category</button>
        <a href="{{ route('admin.categories.index') }}">Cancel</a>
    </form>
@endsection
