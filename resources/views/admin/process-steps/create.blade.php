@extends('admin.layouts.app')

@section('title', 'Add Process Step')
@section('page-title', 'Add Step')

@section('page-header')
    <div class="sm:flex sm:items-center sm:justify-between">
        <div>
            <nav class="flex items-center gap-2 text-sm text-gray-500 mb-2">
                <a href="{{ route('admin.process-steps.index') }}" class="hover:text-gray-700">Process Steps</a>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <span class="text-gray-900">Add Step</span>
            </nav>
            <h1 class="text-2xl font-bold text-gray-900">Add New Process Step</h1>
        </div>
    </div>
@endsection

@section('content')
    <form method="POST" action="{{ route('admin.process-steps.store') }}">
        @csrf

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            {{-- Main Content --}}
            <div class="lg:col-span-2 space-y-6">
                {{-- Step Info --}}
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Step Information</h2>

                    {{-- Translatable Fields --}}
                    <x-admin.language-tabs>
                        <div class="space-y-4">
                            <x-admin.translatable-input
                                name="title"
                                label="Title"
                                :required="true"
                                placeholder="e.g., Sourcing Raw Materials"
                            />

                            <x-admin.translatable-textarea
                                name="description"
                                label="Description"
                                :rows="4"
                                placeholder="Describe what happens in this step..."
                            />
                        </div>
                    </x-admin.language-tabs>
                </div>

                {{-- Icon/Emoji --}}
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Step Icon</h2>

                    <div>
                        <label for="icon" class="block text-sm font-medium text-gray-700 mb-1">
                            Icon / Emoji
                        </label>
                        <input
                            type="text"
                            id="icon"
                            name="icon"
                            value="{{ old('icon') }}"
                            class="block w-full @error('icon') border-red-500 @enderror"
                            placeholder="e.g., 🌱 🏭 📦 🚚"
                        >
                        @error('icon')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-2 text-xs text-gray-500">Enter an emoji to represent this step. If empty, the step number will be displayed.</p>
                    </div>

                    {{-- Icon Suggestions --}}
                    <div class="mt-4">
                        <p class="text-sm font-medium text-gray-700 mb-2">Quick Select:</p>
                        <div class="flex flex-wrap gap-2" x-data>
                            @foreach(['🌱', '🏭', '📦', '🚚', '✅', '🔬', '⚙️', '🌾', '🍃', '💧', '🔥', '❄️'] as $emoji)
                                <button
                                    type="button"
                                    @click="document.getElementById('icon').value = '{{ $emoji }}'"
                                    class="w-10 h-10 text-xl flex items-center justify-center rounded-lg border border-gray-200 hover:border-green-500 hover:bg-green-50 transition-colors"
                                >
                                    {{ $emoji }}
                                </button>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            {{-- Sidebar --}}
            <div class="space-y-6">
                {{-- Settings --}}
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Settings</h2>

                    <div class="space-y-4">
                        {{-- Sort Order --}}
                        <div>
                            <label for="sort_order" class="block text-sm font-medium text-gray-700 mb-1">
                                Step Number
                            </label>
                            <input
                                type="number"
                                id="sort_order"
                                name="sort_order"
                                value="{{ old('sort_order', 0) }}"
                                min="0"
                                class="block w-full"
                            >
                            <p class="mt-1 text-xs text-gray-500">Determines the order in the process flow</p>
                        </div>

                        {{-- Active Toggle --}}
                        <div class="pt-4 border-t border-gray-200">
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                <div>
                                    <p class="text-sm font-medium text-gray-900">Active</p>
                                    <p class="text-xs text-gray-500">Show in process flow</p>
                                </div>
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="hidden" name="is_active" value="0">
                                    <input type="checkbox" name="is_active" value="1" class="sr-only peer" {{ old('is_active', true) ? 'checked' : '' }}>
                                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-green-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-green-600"></div>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 flex gap-3">
                        <button type="submit" class="flex-1 inline-flex justify-center items-center gap-2 rounded-lg bg-green-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-green-700 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Save Step
                        </button>
                    </div>

                    <div class="mt-3">
                        <a href="{{ route('admin.process-steps.index') }}" class="block w-full text-center px-4 py-2.5 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors">
                            Cancel
                        </a>
                    </div>
                </div>

                {{-- Tips --}}
                <div class="bg-blue-50 rounded-xl border border-blue-200 p-6">
                    <div class="flex items-start gap-3">
                        <div class="flex-shrink-0">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-blue-900">Tips</h3>
                            <ul class="mt-2 text-sm text-blue-800 space-y-1">
                                <li>• Use clear, concise titles</li>
                                <li>• Add descriptive text</li>
                                <li>• Choose relevant emojis</li>
                                <li>• Number steps sequentially</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
