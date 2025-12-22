@extends('admin.layouts.app')

@section('title', 'Edit Media')
@section('page-title', 'Edit Media')

@section('page-header')
    <div class="sm:flex sm:items-center sm:justify-between">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.media.index') }}" class="inline-flex items-center justify-center w-10 h-10 rounded-lg bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 transition-colors shadow-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
            </a>
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Edit Media</h1>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ $media->file_name }}</p>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6" x-data="{ showDeleteModal: false, showCopied: false }">
        {{-- Preview Card --}}
        <div class="lg:col-span-1 space-y-6">
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
                <div class="aspect-square bg-gray-100 dark:bg-gray-900 flex items-center justify-center">
                    @if($media->isImage())
                        <img src="{{ $media->url }}" alt="{{ $media->alt_text ?? $media->name }}" class="w-full h-full object-contain">
                    @elseif($media->isVideo())
                        <video src="{{ $media->url }}" controls class="w-full h-full object-contain"></video>
                    @else
                        <div class="text-center p-8">
                            <div class="w-20 h-20 rounded-2xl bg-gradient-to-br from-gray-400 to-gray-600 flex items-center justify-center mx-auto mb-4">
                                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                            <p class="text-lg font-medium text-gray-700 dark:text-gray-300">{{ strtoupper(pathinfo($media->file_name, PATHINFO_EXTENSION)) }}</p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Document</p>
                        </div>
                    @endif
                </div>

                <div class="p-4 border-t border-gray-200 dark:border-gray-700">
                    <dl class="space-y-2 text-sm">
                        <div class="flex justify-between">
                            <dt class="text-gray-500 dark:text-gray-400">File</dt>
                            <dd class="text-gray-900 dark:text-white font-medium truncate max-w-[180px]" title="{{ $media->file_name }}">{{ $media->file_name }}</dd>
                        </div>
                        <div class="flex justify-between">
                            <dt class="text-gray-500 dark:text-gray-400">Type</dt>
                            <dd class="text-gray-900 dark:text-white">{{ $media->mime_type }}</dd>
                        </div>
                        <div class="flex justify-between">
                            <dt class="text-gray-500 dark:text-gray-400">Size</dt>
                            <dd class="text-gray-900 dark:text-white">{{ $media->human_readable_size }}</dd>
                        </div>
                        <div class="flex justify-between">
                            <dt class="text-gray-500 dark:text-gray-400">Uploaded</dt>
                            <dd class="text-gray-900 dark:text-white">{{ $media->created_at->format('M d, Y') }}</dd>
                        </div>
                        @if($media->user)
                            <div class="flex justify-between">
                                <dt class="text-gray-500 dark:text-gray-400">By</dt>
                                <dd class="text-gray-900 dark:text-white">{{ $media->user->name }}</dd>
                            </div>
                        @endif
                    </dl>
                </div>

                <div class="p-4 border-t border-gray-200 dark:border-gray-700 flex gap-2">
                    <a href="{{ $media->url }}" target="_blank" download class="flex-1 px-3 py-2 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 text-sm font-medium rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors text-center">
                        Download
                    </a>
                    <button
                        type="button"
                        @click="navigator.clipboard.writeText('{{ $media->url }}'); showCopied = true; setTimeout(() => showCopied = false, 2000)"
                        class="flex-1 px-3 py-2 bg-blue-100 dark:bg-blue-900 text-blue-700 dark:text-blue-300 text-sm font-medium rounded-lg hover:bg-blue-200 dark:hover:bg-blue-800 transition-colors text-center"
                    >
                        <span x-show="!showCopied">Copy URL</span>
                        <span x-show="showCopied" x-cloak>Copied!</span>
                    </button>
                </div>
            </div>
        </div>

        {{-- Form Card --}}
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Media Details</h3>
                </div>
                <form action="{{ route('admin.media.update', $media) }}" method="POST" class="p-6 space-y-5">
                    @csrf
                    @method('PUT')

                    {{-- Name --}}
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Name <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="text"
                            id="name"
                            name="name"
                            value="{{ old('name', $media->name) }}"
                            required
                            class="block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg focus:ring-green-500 focus:border-green-500 @error('name') border-red-500 @enderror"
                        >
                        @error('name')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Alt Text --}}
                    <div>
                        <label for="alt_text" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Alt Text
                        </label>
                        <input
                            type="text"
                            id="alt_text"
                            name="alt_text"
                            value="{{ old('alt_text', $media->alt_text) }}"
                            class="block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg focus:ring-green-500 focus:border-green-500 @error('alt_text') border-red-500 @enderror"
                            placeholder="Describe the image for accessibility"
                        >
                        @error('alt_text')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Important for accessibility and SEO</p>
                    </div>

                    {{-- Title --}}
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Title
                        </label>
                        <input
                            type="text"
                            id="title"
                            name="title"
                            value="{{ old('title', $media->title) }}"
                            class="block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg focus:ring-green-500 focus:border-green-500 @error('title') border-red-500 @enderror"
                        >
                        @error('title')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Description --}}
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Description
                        </label>
                        <textarea
                            id="description"
                            name="description"
                            rows="3"
                            class="block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg focus:ring-green-500 focus:border-green-500 @error('description') border-red-500 @enderror"
                            placeholder="Add a description..."
                        >{{ old('description', $media->description) }}</textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Collection --}}
                    <div>
                        <label for="collection" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Collection
                        </label>
                        <input
                            type="text"
                            id="collection"
                            name="collection"
                            value="{{ old('collection', $media->collection) }}"
                            class="block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg focus:ring-green-500 focus:border-green-500 @error('collection') border-red-500 @enderror"
                            placeholder="e.g., products, posts, gallery"
                        >
                        @error('collection')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-200 dark:border-gray-700">
                        <a href="{{ route('admin.media.index') }}" class="px-4 py-2.5 text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                            Cancel
                        </a>
                        <button type="submit" class="px-6 py-2.5 bg-green-600 text-white text-sm font-semibold rounded-lg hover:bg-green-700 transition-colors shadow-sm">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>

            {{-- Danger Zone --}}
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-red-200 dark:border-red-900 overflow-hidden">
                <div class="px-6 py-4 border-b border-red-200 dark:border-red-900 bg-red-50 dark:bg-red-900/20">
                    <h3 class="text-lg font-semibold text-red-600 dark:text-red-400">Danger Zone</h3>
                </div>
                <div class="p-6">
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">Permanently delete this file. This action cannot be undone.</p>
                    <button
                        type="button"
                        @click="showDeleteModal = true"
                        class="px-4 py-2.5 bg-red-50 dark:bg-red-900/30 text-red-600 dark:text-red-400 text-sm font-semibold rounded-lg border border-red-200 dark:border-red-800 hover:bg-red-100 dark:hover:bg-red-900/50 transition-colors"
                    >
                        Delete This File
                    </button>
                </div>
            </div>
        </div>

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
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Delete File</h3>
                            <p class="text-gray-600 dark:text-gray-400 mb-2">Are you sure you want to delete</p>
                            <p class="text-lg font-medium text-gray-900 dark:text-white mb-4">"{{ $media->name }}"?</p>
                            <p class="text-sm text-gray-500 dark:text-gray-500">This action cannot be undone.</p>
                        </div>
                        <div class="p-6 pt-0 flex gap-3">
                            <button type="button" @click="showDeleteModal = false" class="flex-1 px-4 py-2.5 text-sm font-medium text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors">
                                Cancel
                            </button>
                            <form action="{{ route('admin.media.destroy', $media) }}" method="POST" class="flex-1">
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
@endsection
