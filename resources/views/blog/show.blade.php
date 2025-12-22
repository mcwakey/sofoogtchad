@extends('layouts.app')

@section('title', ($post->meta_title ?? $post->title) . ' - ' . setting('site_name', 'Sofoodtchad'))
@section('meta_description', $post->meta_description ?? $post->excerpt ?? Str::limit(strip_tags($post->content), 160))
@section('og_title', $post->meta_title ?? $post->title)
@section('og_description', $post->meta_description ?? $post->excerpt)
@if($post->featured_image)
    @section('og_image', $post->image_url)
@endif

@section('content')
    {{-- Page Header --}}
    <section class="relative bg-gradient-to-br from-green-800 via-green-700 to-green-600 text-white overflow-hidden">
        {{-- Background Pattern --}}
        <div class="absolute inset-0 opacity-10">
            <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,<svg width=\"60\" height=\"60\" viewBox=\"0 0 60 60\" xmlns=\"http://www.w3.org/2000/svg\"><g fill=\"none\" fill-rule=\"evenodd\"><g fill=\"%23ffffff\" fill-opacity=\"0.4\"><path d=\"M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\"/></g></g></svg>');"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 md:py-28">
            <div class="text-center max-w-4xl mx-auto">
                {{-- Breadcrumb --}}
                <nav class="mb-6">
                    <ol class="flex items-center justify-center text-sm text-green-100 gap-2">
                        <li>
                            <a href="{{ url('/') }}" class="hover:text-white transition-colors">
                                {{ __('navigation.home') }}
                            </a>
                        </li>
                        <li>/</li>
                        <li>
                            <a href="{{ route('blog.index') }}" class="hover:text-white transition-colors">
                                {{ __('navigation.blog') }}
                            </a>
                        </li>
                        <li>/</li>
                        <li class="text-white font-medium truncate max-w-xs">
                            {{ Str::limit($post->title, 30) }}
                        </li>
                    </ol>
                </nav>

                {{-- Post Type Badge --}}
                <span class="inline-block px-4 py-1.5 text-xs font-semibold uppercase tracking-wider rounded-full mb-4
                    {{ $post->type === 'news' ? 'bg-blue-500/80 text-white' : 'bg-white/20 text-white' }}">
                    {{ ucfirst($post->type) }}
                </span>

                {{-- Title --}}
                <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-6 leading-tight">
                    {{ $post->title }}
                </h1>

                {{-- Meta --}}
                <div class="flex items-center justify-center gap-4 text-green-100 text-sm">
                    <span>{{ $post->published_at->format('F d, Y') }}</span>
                    <span class="w-1.5 h-1.5 rounded-full bg-green-300"></span>
                    <span>{{ __('blog.by') }} {{ $post->author->name ?? 'Admin' }}</span>
                </div>
            </div>
        </div>

        {{-- Wave Divider --}}
        <div class="absolute bottom-0 left-0 right-0">
            <svg viewBox="0 0 1440 60" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full h-auto">
                <path d="M0 60V30C240 50 480 10 720 30C960 50 1200 10 1440 30V60H0Z" class="fill-white dark:fill-gray-900"/>
            </svg>
        </div>
    </section>

    <article class="py-12 lg:py-16 bg-white dark:bg-gray-900 transition-colors duration-200">
        {{-- Featured Image --}}
        @if($post->featured_image)
            <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 mb-12 -mt-20 relative z-10">
                <div class="relative aspect-video rounded-2xl overflow-hidden shadow-2xl">
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
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="prose prose-lg dark:prose-invert prose-green max-w-none
                        prose-headings:font-bold prose-headings:text-gray-900 dark:prose-headings:text-white
                        prose-p:text-gray-700 dark:prose-p:text-gray-300 prose-p:leading-relaxed
                        prose-a:text-green-600 dark:prose-a:text-green-400
                        prose-blockquote:border-l-4 prose-blockquote:border-green-500 prose-blockquote:pl-6 prose-blockquote:italic prose-blockquote:text-gray-600 dark:prose-blockquote:text-gray-400
                        prose-img:rounded-xl prose-img:shadow-lg
                        prose-li:text-gray-700 dark:prose-li:text-gray-300">
                {!! nl2br(e($post->content)) !!}
            </div>

            {{-- Post Gallery --}}
            @if($post->images->count())
                <div class="mt-12 pt-8 border-t border-gray-200 dark:border-gray-700">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-6">{{ __('blog.gallery') }}</h3>
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                        @foreach($post->images as $image)
                            <div class="relative aspect-square rounded-xl overflow-hidden group cursor-pointer shadow-md hover:shadow-xl transition-shadow duration-300">
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
                <a href="{{ route('blog.index') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-green-600 text-white font-semibold rounded-xl hover:bg-green-700 transition-colors shadow-md hover:shadow-lg">
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
        <section class="py-16 bg-gray-50 dark:bg-gray-800 transition-colors duration-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-2xl lg:text-3xl font-bold text-gray-900 dark:text-white text-center mb-10">
                    {{ __('blog.related_posts') }}
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
                    @foreach($relatedPosts as $related)
                        <article class="bg-white dark:bg-gray-900 rounded-2xl shadow-sm overflow-hidden hover:shadow-xl transition-all duration-300 group">
                            @if($related->featured_image)
                                <a href="{{ route('blog.show', $related->slug) }}" class="block relative aspect-video overflow-hidden">
                                    <img
                                        src="{{ $related->image_url }}"
                                        alt="{{ $related->title }}"
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                        loading="lazy"
                                    >
                                    <span class="absolute top-3 left-3 px-3 py-1 text-xs font-semibold uppercase tracking-wider rounded-full
                                        {{ $related->type === 'news' ? 'bg-blue-500 text-white' : 'bg-green-500 text-white' }}">
                                        {{ ucfirst($related->type) }}
                                    </span>
                                </a>
                            @endif
                            <div class="p-6">
                                <span class="text-sm text-gray-500 dark:text-gray-400">
                                    {{ $related->published_at->format('M d, Y') }}
                                </span>
                                <h3 class="mt-2 text-lg font-bold text-gray-900 dark:text-white line-clamp-2 group-hover:text-green-600 dark:group-hover:text-green-400 transition-colors">
                                    <a href="{{ route('blog.show', $related->slug) }}">
                                        {{ $related->title }}
                                    </a>
                                </h3>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endsection
