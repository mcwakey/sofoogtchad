@extends('admin.layouts.app')

@section('title', 'Create Blog Post')
@section('page-title', 'Create Post')

@section('page-header')
    <div class="sm:flex sm:items-center sm:justify-between">
        <div>
            <nav class="flex items-center gap-2 text-sm text-gray-500 mb-2">
                <a href="{{ route('admin.posts.index') }}" class="hover:text-gray-700">Blog Posts</a>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <span class="text-gray-900">Create Post</span>
            </nav>
            <h1 class="text-2xl font-bold text-gray-900">Create New Post</h1>
        </div>
    </div>
@endsection

@section('content')
    <form method="POST" action="{{ route('admin.posts.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            {{-- Main Content --}}
            <div class="lg:col-span-2 space-y-6">
                {{-- Basic Info --}}
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Post Content</h2>

                    {{-- Slug --}}
                    <div class="mb-6">
                        <label for="slug" class="block text-sm font-medium text-gray-700 mb-1">
                            Slug <span class="text-gray-400 text-xs font-normal">(auto-generated from French title if empty)</span>
                        </label>
                        <input
                            type="text"
                            id="slug"
                            name="slug"
                            value="{{ old('slug') }}"
                            class="block w-full @error('slug') border-red-500 @enderror"
                            placeholder="post-url-slug"
                        >
                        @error('slug')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Translatable Fields --}}
                    <x-admin.language-tabs>
                        <div class="space-y-4">
                            <x-admin.translatable-input
                                name="title"
                                label="Title"
                                :required="true"
                                placeholder="Enter post title"
                            />

                            <x-admin.translatable-textarea
                                name="excerpt"
                                label="Summary / Excerpt"
                                :rows="3"
                                placeholder="Brief summary for listings and SEO"
                            />

                            <x-admin.translatable-textarea
                                name="content"
                                label="Content"
                                :required="true"
                                :rows="15"
                                placeholder="Write your post content here... HTML is supported."
                            />
                        </div>
                    </x-admin.language-tabs>
                    <p class="mt-2 text-xs text-gray-500">You can use HTML for formatting. A rich text editor can be integrated later.</p>
                </div>

                {{-- Featured Image --}}
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Featured Image</h2>

                    <div x-data="{ imagePreview: null }">
                        <div class="flex items-center justify-center w-full">
                            <label
                                for="featured_image"
                                class="flex flex-col items-center justify-center w-full h-48 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 transition-colors"
                                x-show="!imagePreview"
                            >
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <svg class="w-10 h-10 mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                                    <p class="text-xs text-gray-400">PNG, JPG, GIF up to 2MB</p>
                                </div>
                                <input
                                    id="featured_image"
                                    name="featured_image"
                                    type="file"
                                    class="hidden"
                                    accept="image/*"
                                    @change="const file = $event.target.files[0]; if(file) { const reader = new FileReader(); reader.onload = (e) => imagePreview = e.target.result; reader.readAsDataURL(file); }"
                                >
                            </label>

                            {{-- Preview --}}
                            <div x-show="imagePreview" class="relative w-full">
                                <img :src="imagePreview" class="w-full h-48 object-cover rounded-lg">
                                <button
                                    type="button"
                                    @click="imagePreview = null; document.getElementById('featured_image').value = ''"
                                    class="absolute top-2 right-2 p-1.5 bg-red-500 text-white rounded-full hover:bg-red-600 transition-colors"
                                >
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        @error('featured_image')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- SEO Settings --}}
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">SEO Settings</h2>

                    <x-admin.language-tabs>
                        <div class="space-y-4">
                            <x-admin.translatable-input
                                name="meta_title"
                                label="Meta Title"
                                placeholder="SEO title (defaults to post title)"
                            />

                            <x-admin.translatable-textarea
                                name="meta_description"
                                label="Meta Description"
                                :rows="2"
                                placeholder="SEO description for search engines"
                            />
                        </div>
                    </x-admin.language-tabs>
                </div>
            </div>

            {{-- Sidebar --}}
            <div class="space-y-6">
                {{-- Publish Settings --}}
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Publish Settings</h2>

                    <div class="space-y-4">
                        {{-- Status --}}
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-1">
                                Status
                            </label>
                            <select id="status" name="status" class="block w-full">
                                <option value="draft" {{ old('status', 'draft') === 'draft' ? 'selected' : '' }}>Draft</option>
                                <option value="published" {{ old('status') === 'published' ? 'selected' : '' }}>Published</option>
                                <option value="archived" {{ old('status') === 'archived' ? 'selected' : '' }}>Archived</option>
                            </select>
                        </div>

                        {{-- Type --}}
                        <div>
                            <label for="type" class="block text-sm font-medium text-gray-700 mb-1">
                                Type
                            </label>
                            <select id="type" name="type" class="block w-full">
                                <option value="blog" {{ old('type', 'blog') === 'blog' ? 'selected' : '' }}>Blog</option>
                                <option value="news" {{ old('type') === 'news' ? 'selected' : '' }}>News</option>
                            </select>
                        </div>

                        {{-- Publish Date --}}
                        <div>
                            <label for="published_at" class="block text-sm font-medium text-gray-700 mb-1">
                                Publish Date
                            </label>
                            <input
                                type="datetime-local"
                                id="published_at"
                                name="published_at"
                                value="{{ old('published_at') }}"
                                class="block w-full"
                            >
                            <p class="mt-1 text-xs text-gray-500">Leave empty for immediate publish</p>
                        </div>
                    </div>

                    <div class="mt-6 flex gap-3">
                        <button type="submit" class="flex-1 inline-flex justify-center items-center gap-2 rounded-lg bg-green-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-green-700 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Save Post
                        </button>
                    </div>

                    <div class="mt-3">
                        <a href="{{ route('admin.posts.index') }}" class="block w-full text-center px-4 py-2.5 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors">
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
                            <h3 class="text-sm font-medium text-blue-900">Writing Tips</h3>
                            <ul class="mt-2 text-sm text-blue-800 space-y-1">
                                <li>• Use a compelling headline</li>
                                <li>• Add a featured image</li>
                                <li>• Write a clear summary</li>
                                <li>• Include relevant keywords</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
