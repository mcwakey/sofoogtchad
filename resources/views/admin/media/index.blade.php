@extends('admin.layouts.app')

@section('title', 'Media Library')

@section('content')
<div class="content-header">
    <h1>Media Library</h1>
    <a href="{{ route('admin.media.create') }}" class="btn btn-primary">Upload Files</a>
</div>

<div class="filters" style="margin-bottom: 20px;">
    <form method="GET" action="{{ route('admin.media.index') }}" style="display: flex; gap: 10px; flex-wrap: wrap;">
        <input type="text" name="search" class="form-control" style="width: 200px;"
               placeholder="Search..." value="{{ request('search') }}">
        <select name="type" class="form-control" style="width: auto;">
            <option value="">All Types</option>
            <option value="images" {{ request('type') === 'images' ? 'selected' : '' }}>Images</option>
            <option value="videos" {{ request('type') === 'videos' ? 'selected' : '' }}>Videos</option>
            <option value="documents" {{ request('type') === 'documents' ? 'selected' : '' }}>Documents</option>
        </select>
        <select name="collection" class="form-control" style="width: auto;">
            <option value="">All Collections</option>
            @foreach($collections as $collection)
                <option value="{{ $collection }}" {{ request('collection') === $collection ? 'selected' : '' }}>
                    {{ ucfirst($collection) }}
                </option>
            @endforeach
        </select>
        <button type="submit" class="btn btn-secondary">Filter</button>
        @if(request()->hasAny(['search', 'type', 'collection']))
            <a href="{{ route('admin.media.index') }}" class="btn btn-secondary">Clear</a>
        @endif
    </form>
</div>

@if($media->isEmpty())
    <div class="empty-state">
        <p>No media files found.</p>
        <a href="{{ route('admin.media.create') }}" class="btn btn-primary">Upload your first file</a>
    </div>
@else
    <div class="media-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(180px, 1fr)); gap: 20px;">
        @foreach($media as $item)
            <div class="media-card" style="background: white; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
                <div class="media-preview" style="height: 140px; background: #f5f5f5; display: flex; align-items: center; justify-content: center; overflow: hidden;">
                    @if($item->isImage())
                        <img src="{{ $item->url }}" alt="{{ $item->alt_text ?? $item->name }}"
                             style="width: 100%; height: 100%; object-fit: cover;">
                    @elseif($item->isVideo())
                        <span style="font-size: 3rem;">🎬</span>
                    @else
                        <span style="font-size: 3rem;">📄</span>
                    @endif
                </div>
                <div class="media-info" style="padding: 12px;">
                    <p style="font-weight: 500; margin: 0 0 5px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;" title="{{ $item->name }}">
                        {{ $item->name }}
                    </p>
                    <p style="font-size: 0.8rem; color: #666; margin: 0;">
                        {{ $item->human_readable_size }} • {{ strtoupper(pathinfo($item->file_name, PATHINFO_EXTENSION)) }}
                    </p>
                    <div style="margin-top: 10px; display: flex; gap: 5px;">
                        <a href="{{ route('admin.media.edit', $item) }}" class="btn btn-sm btn-secondary">Edit</a>
                        <button type="button" class="btn btn-sm btn-info" onclick="copyToClipboard('{{ $item->url }}')">Copy URL</button>
                        <form action="{{ route('admin.media.destroy', $item) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this file?')">×</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="pagination-wrapper" style="margin-top: 30px;">
        {{ $media->withQueryString()->links() }}
    </div>
@endif

<script>
function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(function() {
        alert('URL copied to clipboard!');
    });
}
</script>
@endsection
