@extends('admin.layouts.app')

@section('title', $post->title)
@section('page-title', 'View Post')

@section('page-header')
    <div class="sm:flex sm:items-center sm:justify-between">
        <div>
            <nav class="flex items-center gap-2 text-sm text-gray-500 mb-2">
                <a href="{{ route('admin.posts.index') }}" class="hover:text-gray-700">Blog Posts</a>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <span class="text-gray-900">{{ Str::limit($post->title, 40) }}</span>
            </nav>
            <h1 class="text-2xl font-bold text-gray-900">{{ $post->title }}</h1>
        </div>
        <div class="mt-4 sm:mt-0 flex items-center gap-3">
            <a href="{{ route('admin.posts.edit', $post) }}" class="inline-flex items-center gap-2 rounded-lg bg-green-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-green-700 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
                Edit Post
            </a>
            @if($post->isPublished())
                <a href="{{ route('blog.show', $post->slug) }}" target="_blank" class="inline-flex items-center gap-2 rounded-lg bg-gray-100 px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-200 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                    </svg>
                    View on Site
                </a>
            @endif
        </div>
    </div>
@endsection

@section('content')
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- Main Content --}}
        <div class="lg:col-span-2 space-y-6">
            {{-- Post Overview --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                {{-- Featured Image --}}
                @if($post->featured_image)
                    <div class="aspect-video bg-gray-100">
                        <img src="{{ $post->image_url }}" alt="{{ $post->title }}" class="w-full h-full object-cover">
                    </div>
                @else
                    <div class="aspect-video bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                        <svg class="w-20 h-20 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                @endif

                <div class="p-6">
                    {{-- Status Badges --}}
                    <div class="flex flex-wrap gap-2 mb-4">
                        @if($post->status === 'published')
                            <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>
                                Published
                            </span>
                        @elseif($post->status === 'draft')
                            <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                <span class="w-1.5 h-1.5 rounded-full bg-yellow-500"></span>
                                Draft
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-600">
                                <span class="w-1.5 h-1.5 rounded-full bg-gray-400"></span>
                                Archived
                            </span>
                        @endif

                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $post->type === 'blog' ? 'bg-purple-100 text-purple-800' : 'bg-blue-100 text-blue-800' }}">
                            {{ ucfirst($post->type) }}
                        </span>
                    </div>

                    {{-- Excerpt --}}
                    @if($post->excerpt)
                        <div class="mb-4 p-4 bg-gray-50 rounded-lg border-l-4 border-green-500">
                            <p class="text-gray-700 italic">{{ $post->excerpt }}</p>
                        </div>
                    @endif

                    {{-- Content --}}
                    @if($post->content)
                        <div class="prose prose-sm max-w-none text-gray-700">
                            {!! $post->content !!}
                        </div>
                    @else
                        <p class="text-gray-400 italic">No content provided.</p>
                    @endif
                </div>
            </div>

            {{-- Post Gallery (if any) --}}
            @if($post->images && $post->images->count() > 0)
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">
                        Gallery Images
                        <span class="text-sm font-normal text-gray-500">({{ $post->images->count() }})</span>
                    </h2>

                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                        @foreach($post->images as $image)
                            <div class="relative group aspect-square rounded-lg overflow-hidden bg-gray-100">
                                <img src="{{ asset('storage/' . $image->image_path) }}" alt="{{ $image->alt_text }}" class="w-full h-full object-cover transition-transform group-hover:scale-105">
                                @if($image->caption)
                                    <div class="absolute bottom-0 left-0 right-0 p-2 bg-gradient-to-t from-black/70 to-transparent">
                                        <p class="text-white text-xs truncate">{{ $image->caption }}</p>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- SEO Preview --}}
            @if($post->meta_title || $post->meta_description)
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">SEO Preview</h2>

                    <div class="p-4 bg-gray-50 rounded-lg">
                        <p class="text-blue-600 text-lg font-medium hover:underline cursor-pointer truncate">
                            {{ $post->meta_title ?? $post->title }}
                        </p>
                        <p class="text-green-700 text-sm truncate">
                            {{ url('/blog/' . $post->slug) }}
                        </p>
                        @if($post->meta_description)
                            <p class="text-gray-600 text-sm mt-1 line-clamp-2">
                                {{ $post->meta_description }}
                            </p>
                        @endif
                    </div>
                </div>
            @endif
        </div>

        {{-- Sidebar --}}
        <div class="space-y-6">
            {{-- Post Details --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Details</h2>

                <dl class="space-y-4">
                    {{-- Author --}}
                    <div class="flex items-center justify-between py-2 border-b border-gray-100">
                        <dt class="text-sm text-gray-500">Author</dt>
                        <dd class="text-sm font-medium text-gray-900">
                            @if($post->author)
                                <div class="flex items-center gap-2">
                                    <div class="w-6 h-6 rounded-full bg-green-100 flex items-center justify-center">
                                        <span class="text-xs font-medium text-green-700">{{ substr($post->author->name, 0, 1) }}</span>
                                    </div>
                                    {{ $post->author->name }}
                                </div>
                            @else
                                <span class="text-gray-400">—</span>
                            @endif
                        </dd>
                    </div>

                    {{-- Type --}}
                    <div class="flex items-center justify-between py-2 border-b border-gray-100">
                        <dt class="text-sm text-gray-500">Type</dt>
                        <dd class="text-sm font-medium text-gray-900">{{ ucfirst($post->type) }}</dd>
                    </div>

                    {{-- Status --}}
                    <div class="flex items-center justify-between py-2 border-b border-gray-100">
                        <dt class="text-sm text-gray-500">Status</dt>
                        <dd class="text-sm font-medium text-gray-900">{{ ucfirst($post->status) }}</dd>
                    </div>

                    {{-- Slug --}}
                    <div class="flex items-center justify-between py-2 border-b border-gray-100">
                        <dt class="text-sm text-gray-500">Slug</dt>
                        <dd class="text-sm font-mono text-gray-600 truncate max-w-[150px]" title="{{ $post->slug }}">{{ $post->slug }}</dd>
                    </div>

                    {{-- Published At --}}
                    <div class="flex items-center justify-between py-2 border-b border-gray-100">
                        <dt class="text-sm text-gray-500">Published</dt>
                        <dd class="text-sm font-medium text-gray-900">
                            {{ $post->published_at ? $post->published_at->format('M d, Y') : '—' }}
                        </dd>
                    </div>

                    {{-- Images Count --}}
                    <div class="flex items-center justify-between py-2">
                        <dt class="text-sm text-gray-500">Gallery Images</dt>
                        <dd class="text-sm font-medium text-gray-900">{{ $post->images ? $post->images->count() : 0 }}</dd>
                    </div>
                </dl>
            </div>

            {{-- Timeline --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Timeline</h2>

                <div class="space-y-4">
                    <div class="flex items-start gap-3">
                        <div class="flex-shrink-0 w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                            <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-900">Created</p>
                            <p class="text-sm text-gray-500">{{ $post->created_at->format('M d, Y \a\t g:i A') }}</p>
                            <p class="text-xs text-gray-400">{{ $post->created_at->diffForHumans() }}</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3">
                        <div class="flex-shrink-0 w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-900">Last Updated</p>
                            <p class="text-sm text-gray-500">{{ $post->updated_at->format('M d, Y \a\t g:i A') }}</p>
                            <p class="text-xs text-gray-400">{{ $post->updated_at->diffForHumans() }}</p>
                        </div>
                    </div>

                    @if($post->published_at)
                        <div class="flex items-start gap-3">
                            <div class="flex-shrink-0 w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center">
                                <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-900">Published</p>
                                <p class="text-sm text-gray-500">{{ $post->published_at->format('M d, Y \a\t g:i A') }}</p>
                                <p class="text-xs text-gray-400">{{ $post->published_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Quick Actions --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Actions</h2>

                <div class="space-y-3">
                    <a href="{{ route('admin.posts.edit', $post) }}" class="w-full inline-flex justify-center items-center gap-2 rounded-lg bg-green-600 px-4 py-2.5 text-sm font-semibold text-white hover:bg-green-700 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        Edit Post
                    </a>

                    <a href="{{ route('admin.posts.index') }}" class="w-full inline-flex justify-center items-center gap-2 rounded-lg bg-gray-100 px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-200 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Back to Posts
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
