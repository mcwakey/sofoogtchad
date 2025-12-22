@extends('layouts.app')

@section('title', setting('blog_page_title', 'Blog & News') . ' - ' . setting('site_name', 'Sofoodtchad'))
@section('description', setting('blog_page_description', 'Stay updated with our latest stories, recipes, and announcements from Sofoodtchad.'))

@section('content')
    {{-- Page Header --}}
    <section class="relative bg-gradient-to-br from-green-800 via-green-700 to-green-600 text-white overflow-hidden">
        {{-- Background Pattern --}}
        <div class="absolute inset-0 opacity-10">
            <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,<svg width=\"60\" height=\"60\" viewBox=\"0 0 60 60\" xmlns=\"http://www.w3.org/2000/svg\"><g fill=\"none\" fill-rule=\"evenodd\"><g fill=\"%23ffffff\" fill-opacity=\"0.4\"><path d=\"M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\"/></g></g></svg>');"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-24">
            <div class="text-center">
                <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-4">
                    {{ setting('blog_page_title', 'Blog & News') }}
                </h1>
                <p class="text-lg md:text-xl text-green-100 max-w-2xl mx-auto">
                    {{ setting('blog_page_subtitle', 'Stay updated with our latest stories and announcements') }}
                </p>
            </div>
        </div>

        {{-- Wave Divider --}}
        <div class="absolute bottom-0 left-0 right-0">
            <svg viewBox="0 0 1440 60" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full h-auto">
                <path d="M0 60V30C240 50 480 10 720 30C960 50 1200 10 1440 30V60H0Z" fill="white"/>
            </svg>
        </div>
    </section>

    {{-- Category Filter --}}
    <section class="bg-gray-50 border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <div class="flex flex-wrap items-center gap-3">
                <span class="text-sm font-medium text-gray-600 mr-2">Filter:</span>
                <a href="{{ route('blog.index') }}"
                   class="px-4 py-2 rounded-full text-sm font-medium transition-all duration-200 {{ !request('type') ? 'bg-green-600 text-white shadow-md' : 'bg-white text-gray-700 hover:bg-green-50 hover:text-green-700 border border-gray-200' }}">
                    All Posts
                </a>
                <a href="{{ route('blog.index', ['type' => 'blog']) }}"
                   class="px-4 py-2 rounded-full text-sm font-medium transition-all duration-200 {{ request('type') === 'blog' ? 'bg-green-600 text-white shadow-md' : 'bg-white text-gray-700 hover:bg-green-50 hover:text-green-700 border border-gray-200' }}">
                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                    </svg>
                    Blog
                </a>
                <a href="{{ route('blog.index', ['type' => 'news']) }}"
                   class="px-4 py-2 rounded-full text-sm font-medium transition-all duration-200 {{ request('type') === 'news' ? 'bg-green-600 text-white shadow-md' : 'bg-white text-gray-700 hover:bg-green-50 hover:text-green-700 border border-gray-200' }}">
                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                    </svg>
                    News
                </a>
            </div>
        </div>
    </section>

    {{-- Posts Grid --}}
    <section class="py-12 md:py-16 lg:py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if($posts->isEmpty())
                {{-- Empty State --}}
                <div class="text-center py-16">
                    <div class="w-20 h-20 mx-auto mb-6 bg-gray-100 rounded-full flex items-center justify-center">
                        <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">No Posts Yet</h3>
                    <p class="text-gray-600 max-w-md mx-auto">
                        We're working on exciting content for you. Check back soon for updates!
                    </p>
                </div>
            @else
                {{-- Featured Post (First Post) --}}
                @if(!request('type') && $posts->first())
                    @php $featuredPost = $posts->first(); @endphp
                    <div class="mb-12">
                        <x-post-card
                            :title="$featuredPost->title"
                            :summary="$featuredPost->excerpt ?? Str::limit(strip_tags($featuredPost->content), 200)"
                            :image="$featuredPost->image_url"
                            :link="route('blog.show', $featuredPost->slug)"
                            :published-date="$featuredPost->published_at"
                            :author="$featuredPost->author->name ?? 'Admin'"
                            :category="ucfirst($featuredPost->type)"
                            layout="horizontal"
                            featured
                        />
                    </div>
                @endif

                {{-- Posts Grid --}}
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
                    @foreach($posts->skip(!request('type') ? 1 : 0) as $post)
                        <x-post-card
                            :title="$post->title"
                            :summary="$post->excerpt ?? Str::limit(strip_tags($post->content), 120)"
                            :image="$post->image_url"
                            :link="route('blog.show', $post->slug)"
                            :published-date="$post->published_at"
                            :author="$post->author->name ?? 'Admin'"
                            :category="ucfirst($post->type)"
                        />
                    @endforeach
                </div>

                {{-- Pagination --}}
                @if($posts->hasPages())
                    <div class="mt-12 flex justify-center">
                        <nav class="flex items-center gap-2">
                            {{-- Previous --}}
                            @if($posts->onFirstPage())
                                <span class="px-4 py-2 text-gray-400 cursor-not-allowed">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                                    </svg>
                                </span>
                            @else
                                <a href="{{ $posts->previousPageUrl() }}" class="px-4 py-2 text-gray-700 hover:text-green-600 transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                                    </svg>
                                </a>
                            @endif

                            {{-- Page Numbers --}}
                            @foreach($posts->getUrlRange(1, $posts->lastPage()) as $page => $url)
                                @if($page == $posts->currentPage())
                                    <span class="px-4 py-2 bg-green-600 text-white rounded-lg font-medium">{{ $page }}</span>
                                @else
                                    <a href="{{ $url }}" class="px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-lg transition-colors">{{ $page }}</a>
                                @endif
                            @endforeach

                            {{-- Next --}}
                            @if($posts->hasMorePages())
                                <a href="{{ $posts->nextPageUrl() }}" class="px-4 py-2 text-gray-700 hover:text-green-600 transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </a>
                            @else
                                <span class="px-4 py-2 text-gray-400 cursor-not-allowed">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </span>
                            @endif
                        </nav>
                    </div>
                @endif
            @endif
        </div>
    </section>

    {{-- Newsletter CTA --}}
    <section class="py-16 bg-gradient-to-r from-green-700 to-green-600">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-2xl md:text-3xl font-bold text-white mb-4">
                {{ setting('blog_newsletter_title', 'Stay in the Loop') }}
            </h2>
            <p class="text-green-100 mb-8 max-w-xl mx-auto">
                {{ setting('blog_newsletter_description', 'Subscribe to our newsletter for the latest recipes, tips, and news from Sofoodtchad.') }}
            </p>
            <form action="{{ route('home') }}" method="GET" class="flex flex-col sm:flex-row gap-4 justify-center max-w-md mx-auto">
                <input type="email" name="email" placeholder="Enter your email"
                       class="flex-1 px-5 py-3 rounded-full text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-white">
                <button type="submit"
                        class="px-8 py-3 bg-white text-green-700 font-semibold rounded-full hover:bg-green-50 transition-colors duration-200 shadow-lg">
                    Subscribe
                </button>
            </form>
        </div>
    </section>
@endsection
