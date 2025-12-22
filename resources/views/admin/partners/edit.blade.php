@extends('admin.layouts.app')

@section('title', 'Edit Partner')

@section('content')
<div class="content-header">
    <h1>Edit Partner</h1>
</div>

<form action="{{ route('admin.partners.update', $partner) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label for="name">Name *</label>
        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
               value="{{ old('name', $partner->name) }}" required>
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="logo">Logo</label>
        @if($partner->logo)
            <div style="margin-bottom: 10px;">
                <img src="{{ $partner->logo_url }}" alt="{{ $partner->name }}" style="max-width: 150px; border-radius: 4px;">
            </div>
        @endif
        <input type="file" name="logo" id="logo" class="form-control @error('logo') is-invalid @enderror" accept="image/*">
        @error('logo')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="description">Description</label>
        <textarea name="description" id="description" rows="3"
                  class="form-control @error('description') is-invalid @enderror">{{ old('description', $partner->description) }}</textarea>
        @error('description')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="website">Website URL</label>
        <input type="url" name="website" id="website" class="form-control @error('website') is-invalid @enderror"
               value="{{ old('website', $partner->website) }}" placeholder="https://example.com">
        @error('website')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-row">
        <div class="form-group">
            <label for="type">Type *</label>
            <select name="type" id="type" class="form-control @error('type') is-invalid @enderror" required>
                <option value="partner" {{ old('type', $partner->type) === 'partner' ? 'selected' : '' }}>Partner</option>
                <option value="distributor" {{ old('type', $partner->type) === 'distributor' ? 'selected' : '' }}>Distributor</option>
                <option value="supplier" {{ old('type', $partner->type) === 'supplier' ? 'selected' : '' }}>Supplier</option>
            </select>
            @error('type')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="sort_order">Order</label>
            <input type="number" name="sort_order" id="sort_order" class="form-control @error('sort_order') is-invalid @enderror"
                   value="{{ old('sort_order', $partner->sort_order) }}">
            @error('sort_order')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="form-group">
        <label class="checkbox-label">
            <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $partner->is_featured) ? 'checked' : '' }}>
            Featured Partner
        </label>
    </div>

    <div class="form-group">
        <label class="checkbox-label">
            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $partner->is_active) ? 'checked' : '' }}>
            Active
        </label>
    </div>

    <div class="form-actions">
        <button type="submit" class="btn btn-primary">Update Partner</button>
        <a href="{{ route('admin.partners.index') }}" class="btn btn-secondary">Cancel</a>
    </div>
</form>
@endsection
