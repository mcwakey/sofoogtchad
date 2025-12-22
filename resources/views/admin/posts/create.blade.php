@extends('admin.layouts.app')

@section('title', 'Add Post')

@section('content')
<div class="content-header">
    <h1>Add Post</h1>
</div>

<form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="form-row">
        <div class="form-group" style="flex: 2;">
            <label for="title">Title *</label>
            <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror"
                   value="{{ old('title') }}" required>
            @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group" style="flex: 1;">
            <label for="slug">Slug (auto-generated if empty)</label>
            <input type="text" name="slug" id="slug" class="form-control @error('slug') is-invalid @enderror"
                   value="{{ old('slug') }}" placeholder="leave-empty-for-auto">
            @error('slug')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="form-group">
        <label for="excerpt">Excerpt</label>
        <textarea name="excerpt" id="excerpt" rows="2"
                  class="form-control @error('excerpt') is-invalid @enderror"
                  placeholder="Brief summary for listings...">{{ old('excerpt') }}</textarea>
        @error('excerpt')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="content">Content *</label>
        <textarea name="content" id="content" rows="12"
                  class="form-control @error('content') is-invalid @enderror" required>{{ old('content') }}</textarea>
        @error('content')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-row">
        <div class="form-group">
            <label for="type">Type *</label>
            <select name="type" id="type" class="form-control @error('type') is-invalid @enderror" required>
                <option value="blog" {{ old('type') === 'blog' ? 'selected' : '' }}>Blog</option>
                <option value="news" {{ old('type') === 'news' ? 'selected' : '' }}>News</option>
            </select>
            @error('type')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="status">Status *</label>
            <select name="status" id="status" class="form-control @error('status') is-invalid @enderror" required>
                <option value="draft" {{ old('status', 'draft') === 'draft' ? 'selected' : '' }}>Draft</option>
                <option value="published" {{ old('status') === 'published' ? 'selected' : '' }}>Published</option>
                <option value="archived" {{ old('status') === 'archived' ? 'selected' : '' }}>Archived</option>
            </select>
            @error('status')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="published_at">Publish Date</label>
            <input type="datetime-local" name="published_at" id="published_at"
                   class="form-control @error('published_at') is-invalid @enderror"
                   value="{{ old('published_at') }}">
            @error('published_at')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="form-group">
        <label for="featured_image">Featured Image</label>
        <input type="file" name="featured_image" id="featured_image"
               class="form-control @error('featured_image') is-invalid @enderror" accept="image/*">
        @error('featured_image')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <hr style="margin: 30px 0;">
    <h3>SEO Settings</h3>

    <div class="form-group">
        <label for="meta_title">Meta Title</label>
        <input type="text" name="meta_title" id="meta_title"
               class="form-control @error('meta_title') is-invalid @enderror"
               value="{{ old('meta_title') }}" placeholder="Defaults to post title if empty">
        @error('meta_title')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="meta_description">Meta Description</label>
        <textarea name="meta_description" id="meta_description" rows="2"
                  class="form-control @error('meta_description') is-invalid @enderror"
                  placeholder="Description for search engines...">{{ old('meta_description') }}</textarea>
        @error('meta_description')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-actions">
        <button type="submit" class="btn btn-primary">Create Post</button>
        <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary">Cancel</a>
    </div>
</form>
@endsection
