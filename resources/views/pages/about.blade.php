@extends('layouts.app')

@section('title', $pageTitle ?? setting('site_name', 'Sofoodtchad') . ' - About Us')

@section('meta_description', $metaDescription ?? 'Learn about Sofoodtchad, our mission, vision, and the story behind Chad\'s premier food company.')

@section('content')
    {{-- ==================== PAGE HEADER ==================== --}}
    <section class="relative bg-gradient-to-br from-green-600 to-green-800 py-16 md:py-24">
        <div class="absolute inset-0 bg-black/20"></div>
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute -top-24 -right-24 w-96 h-96 bg-white/10 rounded-full blur-3xl"></div>
            <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-yellow-500/10 rounded-full blur-3xl"></div>
        </div>
        <div class="container mx-auto px-4 relative z-10">
            <div class="max-w-3xl mx-auto text-center">
                @if(isset($pageSubtitle) && $pageSubtitle)
                    <span class="inline-block text-green-200 font-semibold text-sm uppercase tracking-wider mb-4">
                        {{ $pageSubtitle }}
                    </span>
                @endif
                <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-white mb-4">
                    {{ $pageTitle ?? 'About Us' }}
                </h1>
                @if(isset($pageDescription) && $pageDescription)
                    <p class="text-lg text-green-100">
                        {{ $pageDescription }}
                    </p>
                @endif
            </div>
        </div>
    </section>

    {{-- ==================== ABOUT SECTIONS ==================== --}}
    @if(isset($aboutSections) && count($aboutSections) > 0)
        @foreach($aboutSections as $index => $section)
            <x-about-snippet
                :title="$section['title'] ?? ''"
                :subtitle="$section['subtitle'] ?? null"
                :description="$section['description'] ?? ''"
                :image="$section['image'] ?? null"
                :imageAlt="$section['image_alt'] ?? $section['title'] ?? ''"
                :reverse="$index % 2 !== 0"
                class="{{ $index === 0 ? 'pt-16' : '' }} {{ $loop->last ? 'pb-16' : '' }}"
            >
                @if(isset($section['features']) && is_array($section['features']) && count($section['features']) > 0)
                    <ul class="mt-6 space-y-3">
                        @foreach($section['features'] as $feature)
                            <li class="flex items-center gap-3">
                                <div class="flex-shrink-0 w-6 h-6 bg-green-100 rounded-full flex items-center justify-center">
                                    <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                                <span class="text-gray-700">{{ $feature }}</span>
                            </li>
                        @endforeach
                    </ul>
                @endif

                @if(isset($section['cta_text']) && isset($section['cta_url']))
                    <a href="{{ $section['cta_url'] }}" class="inline-flex items-center gap-2 mt-6 px-6 py-3 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition-colors duration-200">
                        {{ $section['cta_text'] }}
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                @endif
            </x-about-snippet>
        @endforeach
    @endif

    {{-- ==================== MISSION & VISION SECTION ==================== --}}
    @if((isset($mission) && $mission) || (isset($vision) && $vision))
        <section class="py-16 bg-gray-50">
            <div class="container mx-auto px-4">
                <div class="text-center mb-12">
                    <span class="inline-block text-green-600 font-semibold text-sm uppercase tracking-wider mb-2">
                        {{ $missionVisionSubtitle ?? 'What Drives Us' }}
                    </span>
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900">
                        {{ $missionVisionTitle ?? 'Our Mission & Vision' }}
                    </h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-5xl mx-auto">
                    {{-- Mission Card --}}
                    @if(isset($mission) && $mission)
                        <div class="bg-white rounded-2xl shadow-lg p-8 border-t-4 border-green-600">
                            <div class="w-16 h-16 bg-green-100 rounded-xl flex items-center justify-center mb-6">
                                <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900 mb-4">{{ $mission['title'] ?? 'Our Mission' }}</h3>
                            <p class="text-gray-600 leading-relaxed">
                                {{ $mission['description'] ?? $mission }}
                            </p>
                        </div>
                    @endif

                    {{-- Vision Card --}}
                    @if(isset($vision) && $vision)
                        <div class="bg-white rounded-2xl shadow-lg p-8 border-t-4 border-yellow-500">
                            <div class="w-16 h-16 bg-yellow-100 rounded-xl flex items-center justify-center mb-6">
                                <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900 mb-4">{{ $vision['title'] ?? 'Our Vision' }}</h3>
                            <p class="text-gray-600 leading-relaxed">
                                {{ $vision['description'] ?? $vision }}
                            </p>
                        </div>
                    @endif
                </div>

                {{-- Values (optional) --}}
                @if(isset($values) && is_array($values) && count($values) > 0)
                    <div class="mt-12">
                        <h3 class="text-2xl font-bold text-gray-900 text-center mb-8">{{ $valuesTitle ?? 'Our Core Values' }}</h3>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 max-w-4xl mx-auto">
                            @foreach($values as $value)
                                <div class="text-center">
                                    <div class="w-14 h-14 mx-auto bg-green-100 rounded-full flex items-center justify-center mb-3">
                                        @if(isset($value['icon']))
                                            {!! $value['icon'] !!}
                                        @else
                                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                        @endif
                                    </div>
                                    <h4 class="font-semibold text-gray-900">{{ is_array($value) ? ($value['title'] ?? $value['name'] ?? '') : $value }}</h4>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </section>
    @endif

    {{-- ==================== TEAM SECTION (Optional) ==================== --}}
    @if(isset($team) && is_array($team) && count($team) > 0)
        <section class="py-16 bg-white">
            <div class="container mx-auto px-4">
                <div class="text-center mb-12">
                    <span class="inline-block text-green-600 font-semibold text-sm uppercase tracking-wider mb-2">
                        {{ $teamSubtitle ?? 'The People Behind' }}
                    </span>
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900">
                        {{ $teamTitle ?? 'Meet Our Team' }}
                    </h2>
                    @if(isset($teamDescription))
                        <p class="mt-4 text-gray-600 max-w-2xl mx-auto">{{ $teamDescription }}</p>
                    @endif
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8 max-w-6xl mx-auto">
                    @foreach($team as $member)
                        <div class="text-center group">
                            <div class="relative mb-4 overflow-hidden rounded-2xl">
                                <img
                                    src="{{ $member['image'] ?? '/images/placeholder-person.jpg' }}"
                                    alt="{{ $member['name'] ?? '' }}"
                                    class="w-full h-64 object-cover transition-transform duration-300 group-hover:scale-105"
                                    onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($member['name'] ?? 'Team') }}&size=256&background=16a34a&color=fff'"
                                >
                            </div>
                            <h3 class="text-xl font-bold text-gray-900">{{ $member['name'] ?? '' }}</h3>
                            @if(isset($member['position']) || isset($member['role']))
                                <p class="text-green-600 font-medium">{{ $member['position'] ?? $member['role'] ?? '' }}</p>
                            @endif
                            @if(isset($member['bio']))
                                <p class="mt-2 text-gray-600 text-sm">{{ Str::limit($member['bio'], 100) }}</p>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- ==================== HISTORY/TIMELINE SECTION (Optional) ==================== --}}
    @if(isset($history) && is_array($history) && count($history) > 0)
        <section class="py-16 bg-gray-50">
            <div class="container mx-auto px-4">
                <div class="text-center mb-12">
                    <span class="inline-block text-green-600 font-semibold text-sm uppercase tracking-wider mb-2">
                        {{ $historySubtitle ?? 'Our Journey' }}
                    </span>
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900">
                        {{ $historyTitle ?? 'Our History' }}
                    </h2>
                </div>

                <div class="max-w-3xl mx-auto">
                    <div class="relative">
                        {{-- Timeline Line --}}
                        <div class="absolute left-4 md:left-1/2 top-0 bottom-0 w-0.5 bg-green-200 transform md:-translate-x-1/2"></div>

                        @foreach($history as $index => $milestone)
                            <div class="relative flex items-start mb-8 last:mb-0 {{ $index % 2 === 0 ? 'md:flex-row' : 'md:flex-row-reverse' }}">
                                {{-- Timeline Dot --}}
                                <div class="absolute left-4 md:left-1/2 w-4 h-4 bg-green-600 rounded-full transform -translate-x-1/2 mt-1.5 z-10 ring-4 ring-white"></div>

                                {{-- Content Card --}}
                                <div class="ml-12 md:ml-0 md:w-5/12 {{ $index % 2 === 0 ? 'md:pr-12 md:text-right' : 'md:pl-12' }}">
                                    <div class="bg-white rounded-xl shadow-md p-6">
                                        @if(isset($milestone['year']))
                                            <span class="inline-block px-3 py-1 bg-green-100 text-green-700 text-sm font-bold rounded-full mb-2">
                                                {{ $milestone['year'] }}
                                            </span>
                                        @endif
                                        <h3 class="text-lg font-bold text-gray-900 mb-2">{{ $milestone['title'] ?? '' }}</h3>
                                        <p class="text-gray-600 text-sm">{{ $milestone['description'] ?? '' }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif

    {{-- ==================== EXTRA SLOT SECTION ==================== --}}
    @hasSection('extra_content')
        @yield('extra_content')
    @endif

    {{-- ==================== CTA SECTION ==================== --}}
    @if(isset($cta) && $cta)
        <section class="py-20 bg-green-600">
            <div class="container mx-auto px-4 text-center">
                <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">
                    {{ $cta['title'] ?? 'Want to Learn More?' }}
                </h2>
                @if(isset($cta['description']))
                    <p class="text-green-100 text-lg mb-8 max-w-2xl mx-auto">
                        {{ $cta['description'] }}
                    </p>
                @endif
                <div class="flex flex-wrap justify-center gap-4">
                    @if(isset($cta['primary_text']) && isset($cta['primary_url']))
                        <a href="{{ $cta['primary_url'] }}" class="px-8 py-3 bg-white text-green-600 font-semibold rounded-lg hover:bg-gray-100 transition-colors duration-200">
                            {{ $cta['primary_text'] }}
                        </a>
                    @endif
                    @if(isset($cta['secondary_text']) && isset($cta['secondary_url']))
                        <a href="{{ $cta['secondary_url'] }}" class="px-8 py-3 border-2 border-white text-white font-semibold rounded-lg hover:bg-white hover:text-green-600 transition-colors duration-200">
                            {{ $cta['secondary_text'] }}
                        </a>
                    @endif
                </div>
            </div>
        </section>
    @endif
@endsection
