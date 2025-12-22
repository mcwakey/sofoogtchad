@extends('admin.layouts.app')

@section('title', 'Edit Media')

@section('content')
<div class="content-header">
    <h1>Edit Media</h1>
</div>

<div class="media-edit-container" style="display: grid; grid-template-columns: 1fr 2fr; gap: 30px;">
    <div class="media-preview-card" style="background: white; padding: 20px; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
        <div class="preview" style="background: #f5f5f5; border-radius: 8px; overflow: hidden; margin-bottom: 20px;">
            @if($media->isImage())
                <img src="{{ $media->url }}" alt="{{ $media->alt_text ?? $media->name }}"
                     style="width: 100%; display: block;">
            @elseif($media->isVideo())
                <video src="{{ $media->url }}" controls style="width: 100%;"></video>
            @else
                <div style="padding: 60px; text-align: center;">
                    <span style="font-size: 5rem;">📄</span>
                    <p style="margin-top: 10px;">{{ strtoupper(pathinfo($media->file_name, PATHINFO_EXTENSION)) }} Document</p>
                </div>
            @endif
        </div>

        <div class="file-info" style="font-size: 0.9rem; color: #666;">
            <p><strong>File:</strong> {{ $media->file_name }}</p>
            <p><strong>Type:</strong> {{ $media->mime_type }}</p>
            <p><strong>Size:</strong> {{ $media->human_readable_size }}</p>
            <p><strong>Uploaded:</strong> {{ $media->created_at->format('M d, Y H:i') }}</p>
            @if($media->user)
                <p><strong>By:</strong> {{ $media->user->name }}</p>
            @endif
        </div>

        <div style="margin-top: 20px;">
            <a href="{{ $media->url }}" class="btn btn-secondary" download target="_blank">Download</a>
            <button type="button" class="btn btn-info" onclick="copyToClipboard('{{ $media->url }}')">Copy URL</button>
        </div>
    </div>

    <div class="media-form-card" style="background: white; padding: 30px; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
        <form action="{{ route('admin.media.update', $media) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Name *</label>
                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                       value="{{ old('name', $media->name) }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="alt_text">Alt Text</label>
                <input type="text" name="alt_text" id="alt_text" class="form-control @error('alt_text') is-invalid @enderror"
                       value="{{ old('alt_text', $media->alt_text) }}" placeholder="Describe the image for accessibility">
                @error('alt_text')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror"
                       value="{{ old('title', $media->title) }}">
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" rows="3"
                          class="form-control @error('description') is-invalid @enderror">{{ old('description', $media->description) }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="collection">Collection</label>
                <input type="text" name="collection" id="collection" class="form-control @error('collection') is-invalid @enderror"
                       value="{{ old('collection', $media->collection) }}">
                @error('collection')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Save Changes</button>
                <a href="{{ route('admin.media.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>

        <hr style="margin: 30px 0;">

        <h4 style="color: #e74c3c;">Danger Zone</h4>
        <form action="{{ route('admin.media.destroy', $media) }}" method="POST" style="margin-top: 15px;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this file? This cannot be undone.')">
                Delete This File
            </button>
        </form>
    </div>
</div>

<script>
function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(function() {
        alert('URL copied to clipboard!');
    });
}
</script>
@endsection
