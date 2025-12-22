@extends('layouts.app')

@section('title', ($post->meta_title ?? $post->title) . ' - ' . setting('site_name', 'Sofoodtchad'))
@section('meta_description', $post->meta_description ?? $post->excerpt ?? Str::limit(strip_tags($post->content), 160))
@section('og_title', $post->meta_title ?? $post->title)
@section('og_description', $post->meta_description ?? $post->excerpt)
@if($post->featured_image)
    @section('og_image', $post->image_url)
@endif

@section('content')
    {{-- Spacer for fixed navbar --}}
    <div class="h-16 lg:h-20"></div>

    {{-- Breadcrumb --}}
    <nav class="bg-gray-50 dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
        <div class="container mx-auto px-4 py-4">
            <ol class="flex items-center text-sm text-gray-600 dark:text-gray-400">
                <li>
                    <a href="{{ url('/') }}" class="hover:text-green-600 dark:hover:text-green-400 transition-colors">
                        {{ __('navigation.home') }}
                    </a>
                </li>
                <li class="mx-2">/</li>
                <li>
                    <a href="{{ route('blog.index') }}" class="hover:text-green-600 dark:hover:text-green-400 transition-colors">
                        {{ __('navigation.blog') }}
                    </a>
                </li>
                <li class="mx-2">/</li>
                <li class="text-gray-900 dark:text-white font-medium truncate max-w-xs">
                    {{ $post->title }}
                </li>
            </ol>
        </div>
    </nav>

    <article class="py-12 lg:py-16">
        {{-- Post Header --}}
        <header class="container mx-auto px-4 max-w-4xl text-center mb-10">
            <span class="inline-block px-4 py-1.5 text-xs font-semibold uppercase tracking-wider rounded-full mb-4
                {{ $post->type === 'news' ? 'bg-blue-100 text-blue-700 dark:bg-blue-900 dark:text-blue-300' : 'bg-green-100 text-green-700 dark:bg-green-900 dark:text-green-300' }}">
                {{ ucfirst($post->type) }}
            </span>
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-gray-900 dark:text-white leading-tight mb-6">
                {{ $post->title }}
            </h1>
            <div class="flex items-center justify-center gap-4 text-gray-600 dark:text-gray-400 text-sm">
                <span>{{ $post->published_at->format('F d, Y') }}</span>
                <span class="w-1 h-1 rounded-full bg-gray-400"></span>
                <span>{{ __('blog.by') }} {{ $post->author->name ?? 'Admin' }}</span>
            </div>
        </header>

        {{-- Featured Image --}}
        @if($post->featured_image)
            <div class="container mx-auto px-4 max-w-5xl mb-12">
                <div class="relative aspect-video rounded-2xl overflow-hidden shadow-xl">
                    <img
                        src="{{ $post->image_url }}"
                        alt="{{ $post->title }}"
                        class="w-full h-full object-cover"
                        loading="eager"
                    >
                </div>
            </div>
        @endif

        {{-- Post Content --}}
        <div class="container mx-auto px-4 max-w-4xl">
            <div class="prose prose-lg dark:prose-invert prose-green max-w-none
                        prose-headings:font-bold prose-headings:text-gray-900 dark:prose-headings:text-white
                        prose-p:text-gray-700 dark:prose-p:text-gray-300
                        prose-a:text-green-600 dark:prose-a:text-green-400
                        prose-blockquote:border-l-green-500 prose-blockquote:text-gray-600 dark:prose-blockquote:text-gray-400
                        prose-img:rounded-xl prose-img:shadow-lg">
                {!! nl2br(e($post->content)) !!}
            </div>

            {{-- Post Gallery --}}
            @if($post->images->count())
                <div class="mt-12 pt-8 border-t border-gray-200 dark:border-gray-700">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-6">{{ __('blog.gallery') }}</h3>
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                        @foreach($post->images as $image)
                            <div class="relative aspect-square rounded-lg overflow-hidden group cursor-pointer">
                                <img
                                    src="{{ $image->url }}"
                                    alt="{{ $image->alt_text ?? $post->title }}"
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300"
                                    loading="lazy"
                                >
                                <div class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition-colors duration-300"></div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- Back Link --}}
            <div class="mt-12 pt-8 border-t border-gray-200 dark:border-gray-700">
                <a href="{{ route('blog.index') }}" class="inline-flex items-center gap-2 text-green-600 dark:text-green-400 font-semibold hover:text-green-700 dark:hover:text-green-300 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    {{ __('blog.back_to_blog') }}
                </a>
            </div>
        </div>
    </article>

    {{-- Related Posts --}}
    @if($relatedPosts->count())
        <section class="py-16 bg-gray-50 dark:bg-gray-800">
            <div class="container mx-auto px-4">
                <h2 class="text-2xl lg:text-3xl font-bold text-gray-900 dark:text-white text-center mb-10">
                    {{ __('blog.related_posts') }}
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-6xl mx-auto">
                    @foreach($relatedPosts as $related)
                        <article class="bg-white dark:bg-gray-900 rounded-xl shadow-sm overflow-hidden hover:shadow-lg transition-shadow duration-300 group">
                            @if($related->featured_image)
                                <div class="relative aspect-video overflow-hidden">
                                    <img
                                        src="{{ $related->image_url }}"
                                        alt="{{ $related->title }}"
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                                        loading="lazy"
                                    >
                                </div>
                            @endif
                            <div class="p-6">
                                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2 line-clamp-2 group-hover:text-green-600 dark:group-hover:text-green-400 transition-colors">
                                    <a href="{{ route('blog.show', $related->slug) }}">
                                        {{ $related->title }}
                                    </a>
                                </h3>
                                <span class="text-sm text-gray-500 dark:text-gray-400">
                                    {{ $related->published_at->format('M d, Y') }}
                                </span>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endsection
