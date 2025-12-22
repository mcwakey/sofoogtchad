@props([
    'title' => '',
    'summary' => '',
    'description' => null,
    'image' => null,
    'link' => null,
    'publishedDate' => null,
    'published_date' => null,
    'author' => null,
    'category' => null,
    'categoryLink' => null,
    'layout' => 'vertical',
    'featured' => false,
])

@php
    $date = $publishedDate ?? $published_date;
    $desc = $summary ?: $description;
    $formattedDate = $date ? \Carbon\Carbon::parse($date)->format('M d, Y') : null;
@endphp

@if($layout === 'horizontal')
    {{-- Horizontal Layout --}}
    <article {{ $attributes->merge(['class' => 'post-card bg-white dark:bg-gray-800 rounded-xl overflow-hidden shadow-md dark:shadow-gray-900/30 hover:shadow-xl dark:hover:shadow-gray-900/50 transition-all duration-300 flex flex-col md:flex-row']) }}>
        {{-- Image --}}
        @if($image)
            <div class="md:w-2/5 flex-shrink-0">
                @if($link)
                    <a href="{{ $link }}" class="block h-full">
                @endif
                <img
                    src="{{ $image }}"
                    alt="{{ $title }}"
                    class="w-full h-48 md:h-full object-cover"
                    loading="lazy"
                >
                @if($link)
                    </a>
                @endif
            </div>
        @endif

        {{-- Content --}}
        <div class="p-5 md:p-6 flex flex-col justify-center flex-1">
            {{-- Meta --}}
            <div class="flex flex-wrap items-center gap-3 text-sm text-gray-500 dark:text-gray-400 mb-3">
                @if($category)
                    @if($categoryLink)
                        <a href="{{ $categoryLink }}" class="text-green-600 dark:text-green-400 hover:text-green-700 dark:hover:text-green-300 font-medium">
                            {{ $category }}
                        </a>
                    @else
                        <span class="text-green-600 dark:text-green-400 font-medium">{{ $category }}</span>
                    @endif
                    <span>•</span>
                @endif
                @if($formattedDate)
                    <time datetime="{{ $date }}">{{ $formattedDate }}</time>
                @endif
                @if($author)
                    <span>•</span>
                    <span>{{ $author }}</span>
                @endif
            </div>

            {{-- Title --}}
            <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2 line-clamp-2">
                @if($link)
                    <a href="{{ $link }}" class="hover:text-green-600 dark:hover:text-green-400 transition-colors">
                        {{ $title }}
                    </a>
                @else
                    {{ $title }}
                @endif
            </h3>

            {{-- Summary --}}
            @if($desc)
                <p class="text-gray-600 dark:text-gray-300 line-clamp-2 mb-4">{{ $desc }}</p>
            @endif

            {{-- Read More --}}
            @if($link)
                <a href="{{ $link }}" class="inline-flex items-center text-green-600 dark:text-green-400 font-medium hover:text-green-700 dark:hover:text-green-300 transition-colors mt-auto">
                    Read More
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            @endif
        </div>
    </article>
@else
    {{-- Vertical Layout (default) --}}
    <article {{ $attributes->merge(['class' => 'post-card bg-white dark:bg-gray-800 rounded-xl overflow-hidden shadow-md dark:shadow-gray-900/30 hover:shadow-xl dark:hover:shadow-gray-900/50 transition-all duration-300 hover:-translate-y-1' . ($featured ? ' md:col-span-2' : '')]) }}>
        {{-- Image --}}
        @if($image)
            <div class="relative">
                @if($link)
                    <a href="{{ $link }}" class="block">
                @endif
                <img
                    src="{{ $image }}"
                    alt="{{ $title }}"
                    class="w-full h-48 {{ $featured ? 'md:h-64' : '' }} object-cover"
                    loading="lazy"
                >
                @if($category)
                    <span class="absolute top-3 left-3 px-3 py-1 bg-green-600 text-white text-xs font-semibold rounded-full">
                        {{ $category }}
                    </span>
                @endif
                @if($link)
                    </a>
                @endif
            </div>
        @endif

        {{-- Content --}}
        <div class="p-5">
            {{-- Meta --}}
            <div class="flex items-center gap-3 text-sm text-gray-500 dark:text-gray-400 mb-3">
                @if($formattedDate)
                    <time datetime="{{ $date }}" class="flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        {{ $formattedDate }}
                    </time>
                @endif
                @if($author)
                    <span class="flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        {{ $author }}
                    </span>
                @endif
            </div>

            {{-- Title --}}
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2 line-clamp-2">
                @if($link)
                    <a href="{{ $link }}" class="hover:text-green-600 dark:hover:text-green-400 transition-colors">
                        {{ $title }}
                    </a>
                @else
                    {{ $title }}
                @endif
            </h3>

            {{-- Summary --}}
            @if($desc)
                <p class="text-gray-600 dark:text-gray-300 text-sm line-clamp-3 mb-4">{{ $desc }}</p>
            @endif

            {{-- Extra Content Slot --}}
            @if($slot->isNotEmpty())
                <div class="mb-4">
                    {{ $slot }}
                </div>
            @endif

            {{-- Read More --}}
            @if($link)
                <a href="{{ $link }}" class="inline-flex items-center text-green-600 dark:text-green-400 font-medium text-sm hover:text-green-700 dark:hover:text-green-300 transition-colors">
                    Read More
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            @endif
        </div>
    </article>
@endif
