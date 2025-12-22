@extends('admin.layouts.app')

@section('title', 'Create Product')

@section('page-header')
    <h1>Create Product</h1>
@endsection

@section('content')
    <form method="POST" action="{{ route('admin.products.store') }}">
        @csrf

        <div class="form-row">
            <div class="form-group">
                <label for="name">Name *</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required>
            </div>

            <div class="form-group">
                <label for="slug">Slug (auto-generated if empty)</label>
                <input type="text" id="slug" name="slug" value="{{ old('slug') }}">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="category_id">Category</label>
                <select id="category_id" name="category_id">
                    <option value="">No Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="type">Type *</label>
                <select id="type" name="type" required>
                    @foreach($types as $value => $label)
                        <option value="{{ $value }}" {{ old('type', 'natural') === $value ? 'selected' : '' }}>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="short_description">Short Description</label>
            <textarea id="short_description" name="short_description" rows="2">{{ old('short_description') }}</textarea>
        </div>

        <div class="form-group">
            <label for="description">Full Description</label>
            <textarea id="description" name="description" rows="6">{{ old('description') }}</textarea>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="sku">SKU</label>
                <input type="text" id="sku" name="sku" value="{{ old('sku') }}">
            </div>

            <div class="form-group">
                <label for="sort_order">Sort Order</label>
                <input type="number" id="sort_order" name="sort_order" value="{{ old('sort_order', 0) }}" min="0">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                    Active
                </label>
            </div>

            <div class="form-group">
                <label>
                    <input type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}>
                    Featured
                </label>
            </div>
        </div>

        <button type="submit">Create Product</button>
        <a href="{{ route('admin.products.index') }}">Cancel</a>
    </form>
@endsection
