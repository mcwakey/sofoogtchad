@extends('admin.layouts.app')

@section('title', 'Create Category')
@section('page-title', 'Create Category')

@section('page-header')
    <div class="sm:flex sm:items-center sm:justify-between">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.categories.index') }}" class="inline-flex items-center justify-center w-10 h-10 rounded-lg bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 transition-colors shadow-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
            </a>
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Create Category</h1>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Add a new product category</p>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="max-w-2xl">
        <form method="POST" action="{{ route('admin.categories.store') }}" class="space-y-6">
            @csrf

            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Category Details</h3>
                </div>
                <div class="p-6 space-y-5">
                    {{-- Slug --}}
                    <div>
                        <label for="slug" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            URL Slug
                        </label>
                        <div class="flex rounded-lg overflow-hidden">
                            <span class="inline-flex items-center px-3 bg-gray-50 dark:bg-gray-600 border border-r-0 border-gray-300 dark:border-gray-600 text-gray-500 dark:text-gray-400 text-sm">
                                /categories/
                            </span>
                            <input
                                type="text"
                                id="slug"
                                name="slug"
                                value="{{ old('slug') }}"
                                class="block flex-1 border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-green-500 focus:border-green-500 @error('slug') border-red-500 @enderror"
                                placeholder="auto-generated-from-french-name"
                            >
                        </div>
                        @error('slug')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Leave empty to auto-generate from French name</p>
                    </div>

                    {{-- Translatable Fields --}}
                    <x-admin.language-tabs>
                        <div class="space-y-4">
                            <x-admin.translatable-input
                                name="name"
                                label="Category Name"
                                :required="true"
                                placeholder="e.g., Fruits, Vegetables, Dairy"
                            />

                            <x-admin.translatable-textarea
                                name="description"
                                label="Description"
                                :rows="4"
                                placeholder="Brief description of the category..."
                            />
                        </div>
                    </x-admin.language-tabs>

                    {{-- Image URL --}}
                    <div>
                        <label for="image" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Image URL
                        </label>
                        <input
                            type="text"
                            id="image"
                            name="image"
                            value="{{ old('image') }}"
                            class="block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg focus:ring-green-500 focus:border-green-500 @error('image') border-red-500 @enderror"
                            placeholder="https://example.com/image.jpg"
                        >
                        @error('image')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-5">
                        {{-- Sort Order --}}
                        <div>
                            <label for="sort_order" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Sort Order
                            </label>
                            <input
                                type="number"
                                id="sort_order"
                                name="sort_order"
                                value="{{ old('sort_order', 0) }}"
                                min="0"
                                class="block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg focus:ring-green-500 focus:border-green-500 @error('sort_order') border-red-500 @enderror"
                            >
                            @error('sort_order')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Status --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Status
                            </label>
                            <label class="relative inline-flex items-center cursor-pointer mt-2">
                                <input
                                    type="checkbox"
                                    name="is_active"
                                    value="1"
                                    class="sr-only peer"
                                    {{ old('is_active', true) ? 'checked' : '' }}
                                >
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-green-300 dark:peer-focus:ring-green-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-green-600"></div>
                                <span class="ml-3 text-sm font-medium text-gray-700 dark:text-gray-300">Active</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Form Actions --}}
            <div class="flex items-center justify-end gap-3">
                <a href="{{ route('admin.categories.index') }}" class="px-4 py-2.5 text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                    Cancel
                </a>
                <button type="submit" class="px-6 py-2.5 bg-green-600 text-white text-sm font-semibold rounded-lg hover:bg-green-700 transition-colors shadow-sm">
                    Create Category
                </button>
            </div>
        </form>
    </div>
@endsection
