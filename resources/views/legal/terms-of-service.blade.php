@extends('layouts.app')

@section('title', $page->title ?? 'Terms of Service')

@section('content')
    {{-- Hero Section --}}
    <section class="bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-900 dark:to-gray-800 py-16 lg:py-20">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-gray-900 dark:text-white mb-4">
                {{ $page->title ?? 'Terms of Service' }}
            </h1>
            @if(isset($page) && $page->updated_at)
                <p class="text-gray-600 dark:text-gray-400">
                    Last updated: {{ $page->updated_at->format('F d, Y') }}
                </p>
            @endif
        </div>
    </section>

    {{-- Content Section --}}
    <section class="py-12 lg:py-16">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 p-8 lg:p-12">
                @if(isset($page) && $page->content)
                    <article class="prose prose-lg dark:prose-invert max-w-none
                        prose-headings:font-bold prose-headings:text-gray-900 dark:prose-headings:text-white
                        prose-h2:text-2xl prose-h2:mt-8 prose-h2:mb-4
                        prose-h3:text-xl prose-h3:mt-6 prose-h3:mb-3
                        prose-p:text-gray-600 dark:prose-p:text-gray-300 prose-p:leading-relaxed
                        prose-ul:text-gray-600 dark:prose-ul:text-gray-300
                        prose-ol:text-gray-600 dark:prose-ol:text-gray-300
                        prose-li:my-1
                        prose-a:text-green-600 dark:prose-a:text-green-400 prose-a:no-underline hover:prose-a:underline
                        prose-strong:text-gray-900 dark:prose-strong:text-white
                    ">
                        {!! $page->content !!}
                    </article>
                @else
                    <div class="text-center py-12">
                        <div class="w-16 h-16 rounded-full bg-gray-100 dark:bg-gray-700 flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                        <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Content Coming Soon</h2>
                        <p class="text-gray-600 dark:text-gray-400">Our terms of service are being prepared and will be available shortly.</p>
                    </div>
                @endif
            </div>

            {{-- Contact Section --}}
            <div class="mt-8 text-center">
                <p class="text-gray-600 dark:text-gray-400">
                    Questions about our terms?
                    <a href="{{ route('contact') }}" class="text-green-600 dark:text-green-400 hover:underline font-medium">Contact us</a>
                </p>
            </div>
        </div>
    </section>
@endsection
