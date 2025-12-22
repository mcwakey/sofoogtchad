@extends('admin.layouts.app')

@section('title', 'Edit Process Step')

@section('content')
<div class="content-header">
    <h1>Edit Process Step</h1>
</div>

<form action="{{ route('admin.process-steps.update', $processStep) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label for="title">Title *</label>
        <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" 
               value="{{ old('title', $processStep->title) }}" required>
        @error('title')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="description">Description</label>
        <textarea name="description" id="description" rows="4" 
                  class="form-control @error('description') is-invalid @enderror">{{ old('description', $processStep->description) }}</textarea>
        @error('description')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="icon">Icon (CSS class or emoji)</label>
        <input type="text" name="icon" id="icon" class="form-control @error('icon') is-invalid @enderror" 
               value="{{ old('icon', $processStep->icon) }}" placeholder="e.g., 🌱 or fa-leaf">
        @error('icon')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="sort_order">Order</label>
        <input type="number" name="sort_order" id="sort_order" class="form-control @error('sort_order') is-invalid @enderror" 
               value="{{ old('sort_order', $processStep->sort_order) }}">
        @error('sort_order')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label class="checkbox-label">
            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $processStep->is_active) ? 'checked' : '' }}>
            Active
        </label>
    </div>

    <div class="form-actions">
        <button type="submit" class="btn btn-primary">Update Step</button>
        <a href="{{ route('admin.process-steps.index') }}" class="btn btn-secondary">Cancel</a>
    </div>
</form>
@endsection
