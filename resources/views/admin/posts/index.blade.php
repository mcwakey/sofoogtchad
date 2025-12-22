@extends('admin.layouts.app')

@section('title', 'Posts')

@section('content')
<div class="content-header">
    <h1>Posts</h1>
    <a href="{{ route('admin.posts.create') }}" class="btn btn-primary">Add New Post</a>
</div>

<div class="filters" style="margin-bottom: 20px;">
    <form method="GET" action="{{ route('admin.posts.index') }}" style="display: flex; gap: 10px;">
        <select name="type" class="form-control" style="width: auto;">
            <option value="">All Types</option>
            <option value="blog" {{ request('type') === 'blog' ? 'selected' : '' }}>Blog</option>
            <option value="news" {{ request('type') === 'news' ? 'selected' : '' }}>News</option>
        </select>
        <select name="status" class="form-control" style="width: auto;">
            <option value="">All Status</option>
            <option value="draft" {{ request('status') === 'draft' ? 'selected' : '' }}>Draft</option>
            <option value="published" {{ request('status') === 'published' ? 'selected' : '' }}>Published</option>
            <option value="archived" {{ request('status') === 'archived' ? 'selected' : '' }}>Archived</option>
        </select>
        <button type="submit" class="btn btn-secondary">Filter</button>
        @if(request()->hasAny(['type', 'status']))
            <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary">Clear</a>
        @endif
    </form>
</div>

@if($posts->isEmpty())
    <div class="empty-state">
        <p>No posts found.</p>
    </div>
@else
    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Type</th>
                <th>Status</th>
                <th>Author</th>
                <th>Published</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($posts as $post)
                <tr>
                    <td>
                        {{ $post->title }}
                        <br><small style="color: #666;">{{ $post->slug }}</small>
                    </td>
                    <td>
                        <span class="badge {{ $post->type === 'news' ? 'badge-info' : 'badge-primary' }}">
                            {{ ucfirst($post->type) }}
                        </span>
                    </td>
                    <td>
                        @php
                            $statusClass = match($post->status) {
                                'published' => 'badge-success',
                                'draft' => 'badge-warning',
                                'archived' => 'badge-secondary',
                            };
                        @endphp
                        <span class="badge {{ $statusClass }}">
                            {{ ucfirst($post->status) }}
                        </span>
                    </td>
                    <td>{{ $post->author->name ?? 'Unknown' }}</td>
                    <td>{{ $post->published_at?->format('M d, Y') ?? '-' }}</td>
                    <td>
                        <a href="{{ route('admin.posts.edit', $post) }}" class="btn btn-sm btn-secondary">Edit</a>
                        @if($post->isPublished())
                            <a href="{{ route('blog.show', $post->slug) }}" class="btn btn-sm btn-info" target="_blank">View</a>
                        @endif
                        <form action="{{ route('admin.posts.destroy', $post) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="pagination-wrapper">
        {{ $posts->withQueryString()->links() }}
    </div>
@endif
@endsection
