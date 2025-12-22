@extends('admin.layouts.app')

@section('title', 'Create Page')

@section('page-header')
    <h1>Create Page</h1>
@endsection

@section('content')
    <form method="POST" action="{{ route('admin.pages.store') }}">
        @csrf

        <div class="form-group">
            <label for="title">Title *</label>
            <input type="text" id="title" name="title" value="{{ old('title') }}" required>
        </div>

        <div class="form-group">
            <label for="slug">Slug (leave empty to auto-generate)</label>
            <input type="text" id="slug" name="slug" value="{{ old('slug') }}">
            <small>URL-friendly version of the title</small>
        </div>

        <div class="form-group">
            <label for="status">Status *</label>
            <select id="status" name="status" required>
                <option value="draft" {{ old('status') === 'draft' ? 'selected' : '' }}>Draft</option>
                <option value="published" {{ old('status') === 'published' ? 'selected' : '' }}>Published</option>
            </select>
        </div>

        <div class="form-group">
            <label for="meta_description">Meta Description</label>
            <textarea id="meta_description" name="meta_description" rows="3">{{ old('meta_description') }}</textarea>
            <small>SEO description (max 500 characters)</small>
        </div>

        <button type="submit">Create Page</button>
        <a href="{{ route('admin.pages.index') }}">Cancel</a>
    </form>
@endsection
