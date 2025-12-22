@extends('admin.layouts.app')

@section('title', 'Pages')

@section('page-header')
    <h1>Pages</h1>
    <a href="{{ route('admin.pages.create') }}" class="btn btn-primary">Add Page</a>
@endsection

@section('content')
    <table class="data-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Slug</th>
                <th>Status</th>
                <th>Sections</th>
                <th>Updated</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pages as $page)
                <tr>
                    <td>{{ $page->id }}</td>
                    <td>{{ $page->title }}</td>
                    <td>{{ $page->slug }}</td>
                    <td>
                        <span class="badge {{ $page->status === 'published' ? 'badge-success' : 'badge-warning' }}">
                            {{ ucfirst($page->status) }}
                        </span>
                    </td>
                    <td>{{ $page->sections_count }}</td>
                    <td>{{ $page->updated_at->format('Y-m-d H:i') }}</td>
                    <td>
                        <a href="{{ route('admin.pages.edit', $page) }}">Edit</a>
                        @if($page->status === 'published')
                            <a href="{{ route('page.show', $page->slug) }}" target="_blank">View</a>
                        @endif
                        <form action="{{ route('admin.pages.destroy', $page) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Delete this page and all its sections?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">No pages found. <a href="{{ route('admin.pages.create') }}">Create one</a></td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $pages->links() }}
@endsection
