@extends('admin.layouts.app')

@section('title', 'Add Process Step')

@section('content')
<div class="content-header">
    <h1>Add Process Step</h1>
</div>

<form action="{{ route('admin.process-steps.store') }}" method="POST">
    @csrf

    <div class="form-group">
        <label for="title">Title *</label>
        <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" 
               value="{{ old('title') }}" required>
        @error('title')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="description">Description</label>
        <textarea name="description" id="description" rows="4" 
                  class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
        @error('description')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="icon">Icon (CSS class or emoji)</label>
        <input type="text" name="icon" id="icon" class="form-control @error('icon') is-invalid @enderror" 
               value="{{ old('icon') }}" placeholder="e.g., 🌱 or fa-leaf">
        @error('icon')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="sort_order">Order</label>
        <input type="number" name="sort_order" id="sort_order" class="form-control @error('sort_order') is-invalid @enderror" 
               value="{{ old('sort_order', 0) }}">
        @error('sort_order')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label class="checkbox-label">
            <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
            Active
        </label>
    </div>

    <div class="form-actions">
        <button type="submit" class="btn btn-primary">Create Step</button>
        <a href="{{ route('admin.process-steps.index') }}" class="btn btn-secondary">Cancel</a>
    </div>
</form>
@endsection
