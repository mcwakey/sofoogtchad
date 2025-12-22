@extends('admin.layouts.app')

@section('title', 'Edit Post')

@section('content')
<div class="content-header">
    <h1>Edit Post</h1>
</div>

<form action="{{ route('admin.posts.update', $post) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="form-row">
        <div class="form-group" style="flex: 2;">
            <label for="title">Title *</label>
            <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" 
                   value="{{ old('title', $post->title) }}" required>
            @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group" style="flex: 1;">
            <label for="slug">Slug</label>
            <input type="text" name="slug" id="slug" class="form-control @error('slug') is-invalid @enderror" 
                   value="{{ old('slug', $post->slug) }}">
            @error('slug')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="form-group">
        <label for="excerpt">Excerpt</label>
        <textarea name="excerpt" id="excerpt" rows="2" 
                  class="form-control @error('excerpt') is-invalid @enderror">{{ old('excerpt', $post->excerpt) }}</textarea>
        @error('excerpt')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="content">Content *</label>
        <textarea name="content" id="content" rows="12" 
                  class="form-control @error('content') is-invalid @enderror" required>{{ old('content', $post->content) }}</textarea>
        @error('content')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-row">
        <div class="form-group">
            <label for="type">Type *</label>
            <select name="type" id="type" class="form-control @error('type') is-invalid @enderror" required>
                <option value="blog" {{ old('type', $post->type) === 'blog' ? 'selected' : '' }}>Blog</option>
                <option value="news" {{ old('type', $post->type) === 'news' ? 'selected' : '' }}>News</option>
            </select>
            @error('type')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="status">Status *</label>
            <select name="status" id="status" class="form-control @error('status') is-invalid @enderror" required>
                <option value="draft" {{ old('status', $post->status) === 'draft' ? 'selected' : '' }}>Draft</option>
                <option value="published" {{ old('status', $post->status) === 'published' ? 'selected' : '' }}>Published</option>
                <option value="archived" {{ old('status', $post->status) === 'archived' ? 'selected' : '' }}>Archived</option>
            </select>
            @error('status')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="published_at">Publish Date</label>
            <input type="datetime-local" name="published_at" id="published_at" 
                   class="form-control @error('published_at') is-invalid @enderror" 
                   value="{{ old('published_at', $post->published_at?->format('Y-m-d\TH:i')) }}">
            @error('published_at')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="form-group">
        <label for="featured_image">Featured Image</label>
        @if($post->featured_image)
            <div style="margin-bottom: 10px;">
                <img src="{{ $post->image_url }}" alt="Featured" style="max-width: 200px; border-radius: 4px;">
            </div>
        @endif
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
               value="{{ old('meta_title', $post->meta_title) }}">
        @error('meta_title')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="meta_description">Meta Description</label>
        <textarea name="meta_description" id="meta_description" rows="2" 
                  class="form-control @error('meta_description') is-invalid @enderror">{{ old('meta_description', $post->meta_description) }}</textarea>
        @error('meta_description')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-actions">
        <button type="submit" class="btn btn-primary">Update Post</button>
        <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary">Cancel</a>
    </div>
</form>

<hr style="margin: 40px 0;">

<h3>Gallery Images</h3>
<form action="{{ route('admin.posts.images.store', $post) }}" method="POST" enctype="multipart/form-data" style="margin-bottom: 20px;">
    @csrf
    <div class="form-row">
        <div class="form-group">
            <input type="file" name="image" class="form-control" accept="image/*" required>
        </div>
        <div class="form-group">
            <input type="text" name="alt_text" class="form-control" placeholder="Alt text">
        </div>
        <div class="form-group">
            <input type="text" name="caption" class="form-control" placeholder="Caption">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-secondary">Add Image</button>
        </div>
    </div>
</form>

@if($post->images->count())
    <div class="image-gallery" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(150px, 1fr)); gap: 15px;">
        @foreach($post->images as $image)
            <div class="gallery-item" style="position: relative;">
                <img src="{{ $image->url }}" alt="{{ $image->alt_text }}" style="width: 100%; height: 120px; object-fit: cover; border-radius: 4px;">
                <form action="{{ route('admin.posts.images.destroy', [$post, $image]) }}" method="POST" 
                      style="position: absolute; top: 5px; right: 5px;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this image?')">×</button>
                </form>
            </div>
        @endforeach
    </div>
@else
    <p style="color: #666;">No gallery images yet.</p>
@endif
@endsection
