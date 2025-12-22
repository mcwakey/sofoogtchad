@extends('admin.layouts.app')

@section('title', 'Edit Process Step: ' . $processStep->title)
@section('page-title', 'Edit Step')

@section('page-header')
    <div class="sm:flex sm:items-center sm:justify-between">
        <div>
            <nav class="flex items-center gap-2 text-sm text-gray-500 mb-2">
                <a href="{{ route('admin.process-steps.index') }}" class="hover:text-gray-700">Process Steps</a>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <span class="text-gray-900">{{ $processStep->title }}</span>
            </nav>
            <h1 class="text-2xl font-bold text-gray-900">Edit Process Step</h1>
        </div>
    </div>
@endsection

@section('content')
    <form method="POST" action="{{ route('admin.process-steps.update', $processStep) }}">
        @csrf
        @method('PUT')

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
                                :model="$processStep"
                                :required="true"
                            />

                            <x-admin.translatable-textarea
                                name="description"
                                label="Description"
                                :model="$processStep"
                                :rows="4"
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
                        <div class="flex items-center gap-4">
                            @if($processStep->icon)
                                <div class="w-12 h-12 rounded-lg bg-green-100 flex items-center justify-center text-2xl">
                                    {{ $processStep->icon }}
                                </div>
                            @endif
                            <input
                                type="text"
                                id="icon"
                                name="icon"
                                value="{{ old('icon', $processStep->icon) }}"
                                class="block flex-1 @error('icon') border-red-500 @enderror"
                                placeholder="e.g., 🌱 🏭 📦 🚚"
                            >
                        </div>
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

                {{-- Danger Zone --}}
                <div class="bg-white rounded-xl shadow-sm border border-red-200 p-6" x-data="{ showDeleteModal: false }">
                    <h2 class="text-lg font-semibold text-red-600 mb-2">Danger Zone</h2>
                    <p class="text-sm text-gray-600 mb-4">Once you delete a step, there is no going back.</p>
                    <button
                        type="button"
                        @click="showDeleteModal = true"
                        class="inline-flex items-center gap-2 rounded-lg bg-red-50 px-4 py-2.5 text-sm font-semibold text-red-600 hover:bg-red-100 transition-colors"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                        Delete Step
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
                                    class="relative w-full max-w-md bg-white rounded-2xl shadow-xl"
                                    @click.away="showDeleteModal = false"
                                >
                                    <div class="p-6 pb-0">
                                        <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-full bg-red-100">
                                            <svg class="h-7 w-7 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="p-6 text-center">
                                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Delete Step</h3>
                                        <p class="text-gray-600 mb-2">Are you sure you want to delete</p>
                                        <p class="text-lg font-medium text-gray-900 mb-4">"{{ $processStep->title }}"?</p>
                                        <p class="text-sm text-gray-500">This action cannot be undone.</p>
                                    </div>
                                    <div class="p-6 pt-0 flex gap-3">
                                        <button type="button" @click="showDeleteModal = false" class="flex-1 px-4 py-2.5 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors">
                                            Cancel
                                        </button>
                                        <form action="{{ route('admin.process-steps.destroy', $processStep) }}" method="POST" class="flex-1">
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
                                value="{{ old('sort_order', $processStep->sort_order) }}"
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
                                    <input type="checkbox" name="is_active" value="1" class="sr-only peer" {{ old('is_active', $processStep->is_active) ? 'checked' : '' }}>
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
                            Update
                        </button>
                    </div>

                    <div class="mt-3">
                        <a href="{{ route('admin.process-steps.index') }}" class="block w-full text-center px-4 py-2.5 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors">
                            Cancel
                        </a>
                    </div>
                </div>

                {{-- Meta Info --}}
                <div class="bg-gray-50 rounded-xl border border-gray-200 p-6">
                    <h3 class="text-sm font-medium text-gray-900 mb-3">Information</h3>
                    <dl class="space-y-2 text-sm">
                        <div class="flex justify-between">
                            <dt class="text-gray-500">Created</dt>
                            <dd class="text-gray-900">{{ $processStep->created_at->format('M d, Y') }}</dd>
                        </div>
                        <div class="flex justify-between">
                            <dt class="text-gray-500">Updated</dt>
                            <dd class="text-gray-900">{{ $processStep->updated_at->format('M d, Y') }}</dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>
    </form>
@endsection
