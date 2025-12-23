@extends('admin.layouts.app')

@section('title', 'Site Settings')
@section('page-title', 'Site Settings')

@section('page-header')
    <div class="sm:flex sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Site Settings</h1>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Manage your website configuration and preferences</p>
        </div>
        <div class="mt-4 sm:mt-0">
            <a href="{{ route('admin.settings.create') }}" class="inline-flex items-center gap-2 rounded-lg bg-green-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-green-700 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Add Setting
            </a>
        </div>
    </div>
@endsection

@section('content')
    {{-- Group Tabs --}}
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 mb-6">
        <div class="border-b border-gray-200 dark:border-gray-700">
            <nav class="flex overflow-x-auto scrollbar-hide" aria-label="Tabs">
                @foreach($groups as $group)
                    <a href="{{ route('admin.settings.index', ['group' => $group]) }}"
                       class="flex-shrink-0 px-6 py-4 text-sm font-medium border-b-2 transition-colors {{ $activeGroup === $group ? 'border-green-500 text-green-600 dark:text-green-400' : 'border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300' }}">
                        <span class="flex items-center gap-2">
                            @switch($group)
                                @case('general')
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    @break
                                @case('contact')
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                    @break
                                @case('social')
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                    </svg>
                                    @break
                                @case('seo')
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                    </svg>
                                    @break
                                @case('appearance')
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"/>
                                    </svg>
                                    @break
                                @default
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>
                                    </svg>
                            @endswitch
                            {{ ucfirst($group) }}
                        </span>
                    </a>
                @endforeach

                {{-- Legal Pages Tab --}}
                <a href="{{ route('admin.settings.index', ['group' => 'legal']) }}"
                   class="flex-shrink-0 px-6 py-4 text-sm font-medium border-b-2 transition-colors {{ $activeGroup === 'legal' ? 'border-green-500 text-green-600 dark:text-green-400' : 'border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300' }}">
                    <span class="flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                        Legal
                    </span>
                </a>
            </nav>
        </div>
    </div>

    {{-- Legal Tab Content --}}
    @if($activeGroup === 'legal')
        {{-- Info Banner --}}
        <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-xl p-4 mb-6">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-blue-700 dark:text-blue-300">
                        <strong>Important:</strong> Legal pages are essential for your website's compliance. Make sure to keep them updated and consult with a legal professional.
                    </p>
                </div>
            </div>
        </div>

        {{-- Legal Pages Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Privacy Policy Card --}}
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
                <div class="p-6">
                    <div class="flex items-start justify-between">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-purple-400 to-purple-600 flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Privacy Policy</h3>
                                <p class="text-sm text-gray-500 dark:text-gray-400">How you collect and use data</p>
                            </div>
                        </div>
                        @if(isset($privacyPolicy) && $privacyPolicy->status === 'published')
                            <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>
                                Published
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200">
                                <span class="w-1.5 h-1.5 rounded-full bg-yellow-500"></span>
                                Draft
                            </span>
                        @endif
                    </div>

                    <div class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                        <div class="flex items-center justify-between">
                            <div class="text-sm text-gray-500 dark:text-gray-400">
                                @if(isset($privacyPolicy) && $privacyPolicy->updated_at)
                                    <span class="flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        Updated {{ $privacyPolicy->updated_at->diffForHumans() }}
                                    </span>
                                @else
                                    <span class="text-amber-600 dark:text-amber-400">Not yet created</span>
                                @endif
                            </div>
                            <a href="{{ route('admin.legal.privacy') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 text-sm font-medium rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                                Edit
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Terms of Service Card --}}
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
                <div class="p-6">
                    <div class="flex items-start justify-between">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Terms of Service</h3>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Rules for using your website</p>
                            </div>
                        </div>
                        @if(isset($termsOfService) && $termsOfService->status === 'published')
                            <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>
                                Published
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200">
                                <span class="w-1.5 h-1.5 rounded-full bg-yellow-500"></span>
                                Draft
                            </span>
                        @endif
                    </div>

                    <div class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                        <div class="flex items-center justify-between">
                            <div class="text-sm text-gray-500 dark:text-gray-400">
                                @if(isset($termsOfService) && $termsOfService->updated_at)
                                    <span class="flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        Updated {{ $termsOfService->updated_at->diffForHumans() }}
                                    </span>
                                @else
                                    <span class="text-amber-600 dark:text-amber-400">Not yet created</span>
                                @endif
                            </div>
                            <a href="{{ route('admin.legal.terms') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 text-sm font-medium rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                                Edit
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Quick Links --}}
        <div class="mt-6 bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Public Links</h3>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">View your legal pages as visitors see them</p>
            </div>
            <div class="p-6">
                <div class="flex flex-wrap gap-4">
                    <a href="{{ route('legal.privacy') }}" target="_blank" class="inline-flex items-center gap-2 text-sm text-green-600 hover:text-green-700 dark:text-green-400 dark:hover:text-green-300">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                        </svg>
                        View Privacy Policy
                    </a>
                    <a href="{{ route('legal.terms') }}" target="_blank" class="inline-flex items-center gap-2 text-sm text-green-600 hover:text-green-700 dark:text-green-400 dark:hover:text-green-300">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                        </svg>
                        View Terms of Service
                    </a>
                </div>
            </div>
        </div>
    @else
    {{-- Regular Settings Form --}}
    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" name="group" value="{{ $activeGroup }}">

        <div class="space-y-6">
            @forelse($settings as $setting)
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
                    <div class="p-6">
                        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                            {{-- Setting Info --}}
                            <div class="lg:col-span-1">
                                <label for="settings_{{ $setting->key }}" class="block text-sm font-semibold text-gray-900 dark:text-white">
                                    {{ $setting->label ?: ucwords(str_replace('_', ' ', $setting->key)) }}
                                </label>
                                @if($setting->description)
                                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ $setting->description }}</p>
                                @endif
                                <div class="mt-2 flex items-center gap-2">
                                    <code class="text-xs text-gray-400 dark:text-gray-500 bg-gray-100 dark:bg-gray-700 px-2 py-1 rounded">{{ $setting->key }}</code>
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400">
                                        {{ $setting->type }}
                                    </span>
                                </div>
                            </div>

                            {{-- Setting Input --}}
                            <div class="lg:col-span-2">
                                @switch($setting->type)
                                    @case('textarea')
                                        <textarea
                                            name="settings[{{ $setting->key }}]"
                                            id="settings_{{ $setting->key }}"
                                            rows="4"
                                            class="block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:ring-green-500 focus:border-green-500 text-sm"
                                        >{{ old("settings.{$setting->key}", $setting->value) }}</textarea>
                                        @break

                                    @case('boolean')
                                        <div class="flex items-center">
                                            <input type="hidden" name="settings[{{ $setting->key }}]" value="0">
                                            <label class="relative inline-flex items-center cursor-pointer">
                                                <input
                                                    type="checkbox"
                                                    name="settings[{{ $setting->key }}]"
                                                    id="settings_{{ $setting->key }}"
                                                    value="1"
                                                    {{ old("settings.{$setting->key}", $setting->value) ? 'checked' : '' }}
                                                    class="sr-only peer"
                                                >
                                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-green-300 dark:peer-focus:ring-green-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-green-600"></div>
                                                <span class="ml-3 text-sm font-medium text-gray-700 dark:text-gray-300">
                                                    {{ old("settings.{$setting->key}", $setting->value) ? 'Enabled' : 'Disabled' }}
                                                </span>
                                            </label>
                                        </div>
                                        @break

                                    @case('number')
                                        <input
                                            type="number"
                                            name="settings[{{ $setting->key }}]"
                                            id="settings_{{ $setting->key }}"
                                            value="{{ old("settings.{$setting->key}", $setting->value) }}"
                                            step="any"
                                            class="block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:ring-green-500 focus:border-green-500 text-sm"
                                        >
                                        @break

                                    @case('email')
                                        <div class="relative">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                                </svg>
                                            </div>
                                            <input
                                                type="email"
                                                name="settings[{{ $setting->key }}]"
                                                id="settings_{{ $setting->key }}"
                                                value="{{ old("settings.{$setting->key}", $setting->value) }}"
                                                class="block w-full pl-10 rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:ring-green-500 focus:border-green-500 text-sm"
                                            >
                                        </div>
                                        @break

                                    @case('url')
                                        <div class="relative">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                                                </svg>
                                            </div>
                                            <input
                                                type="url"
                                                name="settings[{{ $setting->key }}]"
                                                id="settings_{{ $setting->key }}"
                                                value="{{ old("settings.{$setting->key}", $setting->value) }}"
                                                placeholder="https://"
                                                class="block w-full pl-10 rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:ring-green-500 focus:border-green-500 text-sm"
                                            >
                                        </div>
                                        @break

                                    @case('json')
                                        <textarea
                                            name="settings[{{ $setting->key }}]"
                                            id="settings_{{ $setting->key }}"
                                            rows="6"
                                            class="block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:ring-green-500 focus:border-green-500 font-mono text-xs"
                                            placeholder='{"key": "value"}'
                                        >{{ old("settings.{$setting->key}", is_array($setting->value) ? json_encode($setting->value, JSON_PRETTY_PRINT) : $setting->value) }}</textarea>
                                        <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">Enter valid JSON format</p>
                                        @break

                                    @case('image')
                                        <div x-data="{
                                            preview: '{{ $setting->value }}',
                                            fileSelected: false,
                                            removeImage() {
                                                if (confirm('Are you sure you want to remove this image?')) {
                                                    fetch('{{ route('admin.settings.remove-image') }}', {
                                                        method: 'POST',
                                                        headers: {
                                                            'Content-Type': 'application/json',
                                                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                                        },
                                                        body: JSON.stringify({ key: '{{ $setting->key }}' })
                                                    })
                                                    .then(response => response.json())
                                                    .then(data => {
                                                        if (data.success) {
                                                            this.preview = '';
                                                        }
                                                    });
                                                }
                                            }
                                        }" class="space-y-4">
                                            {{-- Current Image Preview --}}
                                            <div x-show="preview && !fileSelected" class="relative">
                                                <div class="flex items-start gap-4">
                                                    <div class="relative group">
                                                        <img
                                                            :src="preview"
                                                            alt="Current {{ $setting->label }}"
                                                            class="h-20 w-auto rounded-lg border border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 object-contain"
                                                        >
                                                        <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity rounded-lg flex items-center justify-center">
                                                            <button
                                                                type="button"
                                                                @click="removeImage()"
                                                                class="p-2 bg-red-500 text-white rounded-full hover:bg-red-600 transition-colors"
                                                            >
                                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                                </svg>
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <div class="text-sm text-gray-500 dark:text-gray-400">
                                                        <p class="font-medium text-gray-700 dark:text-gray-300">Current image</p>
                                                        <p class="text-xs mt-1">Hover to remove</p>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- Upload Input --}}
                                            <div class="relative">
                                                <label
                                                    for="images_{{ $setting->key }}"
                                                    class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-xl cursor-pointer bg-gray-50 dark:bg-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors"
                                                >
                                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                                        <svg class="w-8 h-8 mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                                        </svg>
                                                        <p class="mb-1 text-sm text-gray-500 dark:text-gray-400">
                                                            <span class="font-semibold">Click to upload</span> or drag and drop
                                                        </p>
                                                        <p class="text-xs text-gray-500 dark:text-gray-400">PNG, JPG, GIF, ICO (Max 2MB)</p>
                                                    </div>
                                                    <input
                                                        type="file"
                                                        name="images[{{ $setting->key }}]"
                                                        id="images_{{ $setting->key }}"
                                                        accept="image/*,.ico"
                                                        class="hidden"
                                                        @change="
                                                            fileSelected = true;
                                                            const file = $event.target.files[0];
                                                            if (file) {
                                                                const reader = new FileReader();
                                                                reader.onload = (e) => preview = e.target.result;
                                                                reader.readAsDataURL(file);
                                                            }
                                                        "
                                                    >
                                                </label>
                                            </div>

                                            {{-- New Image Preview --}}
                                            <div x-show="fileSelected && preview" class="flex items-center gap-4 p-3 bg-green-50 dark:bg-green-900/20 rounded-lg border border-green-200 dark:border-green-800">
                                                <img
                                                    :src="preview"
                                                    alt="New image preview"
                                                    class="h-12 w-auto rounded-lg object-contain"
                                                >
                                                <div class="flex-1">
                                                    <p class="text-sm font-medium text-green-700 dark:text-green-400">New image selected</p>
                                                    <p class="text-xs text-green-600 dark:text-green-500">Save to apply changes</p>
                                                </div>
                                                <button
                                                    type="button"
                                                    @click="fileSelected = false; preview = '{{ $setting->value }}'; document.getElementById('images_{{ $setting->key }}').value = ''"
                                                    class="p-1.5 text-green-600 hover:text-green-800 dark:text-green-400 dark:hover:text-green-300"
                                                >
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                        @break

                                    @default
                                        <input
                                            type="text"
                                            name="settings[{{ $setting->key }}]"
                                            id="settings_{{ $setting->key }}"
                                            value="{{ old("settings.{$setting->key}", $setting->value) }}"
                                            class="block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:ring-green-500 focus:border-green-500 text-sm"
                                        >
                                @endswitch
                            </div>
                        </div>
                    </div>

                    {{-- Setting Actions --}}
                    <div class="px-6 py-3 bg-gray-50 dark:bg-gray-700/50 border-t border-gray-200 dark:border-gray-700 flex items-center justify-end gap-4">
                        <a href="{{ route('admin.settings.edit', $setting) }}" class="inline-flex items-center gap-1 text-sm text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                            Edit
                        </a>
                        <div x-data="{ showDeleteModal: false }">
                            <button type="button" @click="showDeleteModal = true" class="inline-flex items-center gap-1 text-sm text-red-600 dark:text-red-400 hover:text-red-800 dark:hover:text-red-300">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                                Delete
                            </button>

                            {{-- Delete Modal --}}
                            <template x-teleport="body">
                                <div
                                    x-show="showDeleteModal"
                                    x-transition:enter="ease-out duration-300"
                                    x-transition:enter-start="opacity-0"
                                    x-transition:enter-end="opacity-100"
                                    x-transition:leave="ease-in duration-200"
                                    x-transition:leave-start="opacity-100"
                                    x-transition:leave-end="opacity-0"
                                    class="fixed inset-0 z-50 overflow-y-auto"
                                    x-cloak
                                >
                                    <div class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm" @click="showDeleteModal = false"></div>
                                    <div class="flex min-h-full items-center justify-center p-4">
                                        <div
                                            x-show="showDeleteModal"
                                            x-transition:enter="ease-out duration-300"
                                            x-transition:enter-start="opacity-0 scale-95"
                                            x-transition:enter-end="opacity-100 scale-100"
                                            x-transition:leave="ease-in duration-200"
                                            x-transition:leave-start="opacity-100 scale-100"
                                            x-transition:leave-end="opacity-0 scale-95"
                                            class="relative w-full max-w-md bg-white dark:bg-gray-800 rounded-2xl shadow-xl"
                                            @click.away="showDeleteModal = false"
                                        >
                                            <div class="p-6 pb-0">
                                                <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-full bg-red-100 dark:bg-red-900/50">
                                                    <svg class="h-7 w-7 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="p-6 text-center">
                                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Delete Setting</h3>
                                                <p class="text-gray-600 dark:text-gray-400 mb-2">Are you sure you want to delete</p>
                                                <p class="text-lg font-medium text-gray-900 dark:text-white mb-4">"{{ $setting->label ?: $setting->key }}"?</p>
                                                <p class="text-sm text-gray-500 dark:text-gray-500">This action cannot be undone.</p>
                                            </div>
                                            <div class="p-6 pt-0 flex gap-3">
                                                <button type="button" @click="showDeleteModal = false" class="flex-1 px-4 py-2.5 text-sm font-medium text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors">
                                                    Cancel
                                                </button>
                                                <form action="{{ route('admin.settings.destroy', $setting) }}" method="POST" class="flex-1">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="w-full px-4 py-2.5 text-sm font-semibold text-white bg-red-600 rounded-lg hover:bg-red-700 transition-colors">
                                                        Yes, Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
            @empty
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-12">
                    <div class="text-center">
                        <div class="mx-auto w-16 h-16 rounded-full bg-gray-100 dark:bg-gray-700 flex items-center justify-center mb-4">
                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">No settings in this group</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mb-6">Get started by creating your first setting in the "{{ ucfirst($activeGroup) }}" group.</p>
                        <a href="{{ route('admin.settings.create') }}" class="inline-flex items-center gap-2 rounded-lg bg-green-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-green-700 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            Add First Setting
                        </a>
                    </div>
                </div>
            @endforelse
        </div>

        {{-- Save Button --}}
        @if($settings->count() > 0)
            <div class="mt-6 flex items-center justify-end gap-4">
                <a href="{{ route('admin.settings.index', ['group' => $activeGroup]) }}" class="px-4 py-2.5 text-sm font-medium text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors">
                    Cancel
                </a>
                <button type="submit" class="inline-flex items-center gap-2 px-6 py-2.5 text-sm font-semibold text-white bg-green-600 rounded-lg shadow-sm hover:bg-green-700 focus:ring-4 focus:ring-green-300 dark:focus:ring-green-800 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Save All Settings
                </button>
            </div>
        @endif
    </form>
    @endif

    {{-- Quick Tips Card --}}
    <div class="mt-8 bg-gradient-to-br from-green-50 to-emerald-50 dark:from-green-900/20 dark:to-emerald-900/20 rounded-xl border border-green-200 dark:border-green-800 p-6">
        <div class="flex items-start gap-4">
            <div class="flex-shrink-0">
                <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div>
                <h4 class="text-sm font-semibold text-green-800 dark:text-green-200 mb-2">Quick Tips</h4>
                <ul class="text-sm text-green-700 dark:text-green-300 space-y-1">
                    <li>• Use the <code class="bg-green-100 dark:bg-green-800 px-1 rounded">setting('key')</code> helper to access settings in your code</li>
                    <li>• Group related settings together for easier management</li>
                    <li>• Boolean settings can be used for feature toggles</li>
                    <li>• JSON type is perfect for complex configurations like arrays or objects</li>
                </ul>
            </div>
        </div>
    </div>
@endsection
