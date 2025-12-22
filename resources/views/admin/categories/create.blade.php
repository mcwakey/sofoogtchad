@extends('admin.layouts.app')

@section('title', 'Create Category')

@section('page-header')
    <h1>Create Category</h1>
@endsection

@section('content')
    <form method="POST" action="{{ route('admin.categories.store') }}">
        @csrf

        <div class="form-group">
            <label for="name">Name *</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required>
        </div>

        <div class="form-group">
            <label for="slug">Slug (auto-generated if empty)</label>
            <input type="text" id="slug" name="slug" value="{{ old('slug') }}">
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" name="description" rows="4">{{ old('description') }}</textarea>
        </div>

        <div class="form-group">
            <label for="image">Image URL</label>
            <input type="text" id="image" name="image" value="{{ old('image') }}">
        </div>

        <div class="form-group">
            <label for="sort_order">Sort Order</label>
            <input type="number" id="sort_order" name="sort_order" value="{{ old('sort_order', 0) }}" min="0">
        </div>

        <div class="form-group">
            <label>
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                Active
            </label>
        </div>

        <button type="submit">Create Category</button>
        <a href="{{ route('admin.categories.index') }}">Cancel</a>
    </form>
@endsection
