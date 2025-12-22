@extends('admin.layouts.app')

@section('title', 'Edit Page: ' . $page->title)
@section('page-title', 'Edit Page')

@section('page-header')
    <div class="sm:flex sm:items-center sm:justify-between">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.pages.index') }}" class="inline-flex items-center justify-center w-10 h-10 rounded-lg bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 transition-colors shadow-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
            </a>
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Edit Page</h1>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ $page->title }}</p>
            </div>
        </div>
        <div class="mt-4 sm:mt-0 flex items-center gap-2">
            @if($page->status === 'published')
                <a href="{{ route('page.show', $page->slug) }}" target="_blank" class="inline-flex items-center gap-2 px-4 py-2.5 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 text-sm font-medium rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                    </svg>
                    View Page
                </a>
            @endif
            @if($page->status === 'published')
                <span class="inline-flex items-center gap-1 px-3 py-2 rounded-lg text-sm font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                    <span class="w-2 h-2 rounded-full bg-green-500"></span>
                    Published
                </span>
            @else
                <span class="inline-flex items-center gap-1 px-3 py-2 rounded-lg text-sm font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200">
                    <span class="w-2 h-2 rounded-full bg-yellow-500"></span>
                    Draft
                </span>
            @endif
        </div>
    </div>
@endsection

@section('content')
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- Main Content --}}
        <div class="lg:col-span-2 space-y-6">
            {{-- Page Details Form --}}
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Page Details</h3>
                </div>
                <form method="POST" action="{{ route('admin.pages.update', $page) }}" class="p-6 space-y-5">
                    @csrf
                    @method('PUT')

                    {{-- Title --}}
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Page Title <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="text"
                            id="title"
                            name="title"
                            value="{{ old('title', $page->title) }}"
                            required
                            class="block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg focus:ring-green-500 focus:border-green-500 @error('title') border-red-500 @enderror"
                        >
                        @error('title')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Slug --}}
                    <div>
                        <label for="slug" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            URL Slug <span class="text-red-500">*</span>
                        </label>
                        <div class="flex rounded-lg overflow-hidden">
                            <span class="inline-flex items-center px-3 bg-gray-50 dark:bg-gray-600 border border-r-0 border-gray-300 dark:border-gray-600 text-gray-500 dark:text-gray-400 text-sm">
                                /page/
                            </span>
                            <input
                                type="text"
                                id="slug"
                                name="slug"
                                value="{{ old('slug', $page->slug) }}"
                                required
                                class="block flex-1 border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-green-500 focus:border-green-500 @error('slug') border-red-500 @enderror"
                            >
                        </div>
                        @error('slug')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-5">
                        {{-- Status --}}
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Status <span class="text-red-500">*</span>
                            </label>
                            <select
                                id="status"
                                name="status"
                                required
                                class="block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg focus:ring-green-500 focus:border-green-500 @error('status') border-red-500 @enderror"
                            >
                                <option value="draft" {{ old('status', $page->status) === 'draft' ? 'selected' : '' }}>📝 Draft</option>
                                <option value="published" {{ old('status', $page->status) === 'published' ? 'selected' : '' }}>✅ Published</option>
                            </select>
                            @error('status')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Last Updated --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Last Updated
                            </label>
                            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                                {{ $page->updated_at->format('M d, Y \a\t H:i') }}
                            </p>
                        </div>
                    </div>

                    {{-- Meta Description --}}
                    <div>
                        <label for="meta_description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Meta Description
                        </label>
                        <textarea
                            id="meta_description"
                            name="meta_description"
                            rows="3"
                            maxlength="500"
                            class="block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg focus:ring-green-500 focus:border-green-500 @error('meta_description') border-red-500 @enderror"
                            placeholder="Brief description for search engines..."
                        >{{ old('meta_description', $page->meta_description) }}</textarea>
                        @error('meta_description')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Recommended: 150-160 characters for optimal SEO</p>
                    </div>

                    <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-200 dark:border-gray-700">
                        <a href="{{ route('admin.pages.index') }}" class="px-4 py-2.5 text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                            Cancel
                        </a>
                        <button type="submit" class="px-6 py-2.5 bg-green-600 text-white text-sm font-semibold rounded-lg hover:bg-green-700 transition-colors shadow-sm">
                            Update Page
                        </button>
                    </div>
                </form>
            </div>

            {{-- Page Sections --}}
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Page Sections</h3>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                            {{ $page->sections->count() }} section(s)
                        </p>
                    </div>
                </div>

                @if($page->sections->count() > 0)
                    <div class="divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach($page->sections as $section)
                            <div class="p-4 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors" x-data="{ expanded: false, showDeleteModal: false }">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        <div class="flex-shrink-0 w-10 h-10 rounded-lg bg-gradient-to-br from-purple-400 to-purple-600 flex items-center justify-center">
                                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-gray-900 dark:text-white">{{ ucfirst($section->section_type) }}</p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">Order: {{ $section->order }}</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <button @click="expanded = !expanded" class="p-2 text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 transition-colors">
                                            <svg class="w-5 h-5 transform transition-transform" :class="{ 'rotate-180': expanded }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                            </svg>
                                        </button>
                                        <button @click="showDeleteModal = true" class="p-2 text-red-500 hover:text-red-700 transition-colors">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </button>
                                    </div>
                                </div>

                                {{-- Expanded Content --}}
                                <div x-show="expanded" x-collapse class="mt-4">
                                    <pre class="p-4 bg-gray-50 dark:bg-gray-900 rounded-lg text-xs text-gray-700 dark:text-gray-300 overflow-x-auto">{{ json_encode($section->content, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
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
                                                <div class="p-6 text-center">
                                                    <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-full bg-red-100 dark:bg-red-900/50 mb-4">
                                                        <svg class="h-7 w-7 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                                        </svg>
                                                    </div>
                                                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Delete Section</h3>
                                                    <p class="text-gray-600 dark:text-gray-400 mb-4">Are you sure you want to delete this {{ $section->section_type }} section?</p>
                                                </div>
                                                <div class="p-6 pt-0 flex gap-3">
                                                    <button type="button" @click="showDeleteModal = false" class="flex-1 px-4 py-2.5 text-sm font-medium text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors">
                                                        Cancel
                                                    </button>
                                                    <form action="{{ route('admin.pages.sections.destroy', [$page, $section]) }}" method="POST" class="flex-1">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="w-full px-4 py-2.5 text-sm font-semibold text-white bg-red-600 rounded-lg hover:bg-red-700 transition-colors">
                                                            Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </template>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="p-8 text-center">
                        <div class="w-14 h-14 rounded-full bg-gray-100 dark:bg-gray-700 flex items-center justify-center mx-auto mb-4">
                            <svg class="w-7 h-7 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"/>
                            </svg>
                        </div>
                        <p class="text-gray-500 dark:text-gray-400">No sections yet. Add your first section below.</p>
                    </div>
                @endif
            </div>
        </div>

        {{-- Sidebar - Add Section --}}
        <div class="space-y-6">
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden sticky top-6">
                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Add Section</h3>
                </div>
                <form method="POST" action="{{ route('admin.pages.sections.store', $page) }}" id="addSectionForm" class="p-6 space-y-4">
                    @csrf

                    {{-- Section Type --}}
                    <div>
                        <label for="section_type" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Section Type <span class="text-red-500">*</span>
                        </label>
                        <select
                            id="section_type"
                            name="section_type"
                            required
                            class="block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg focus:ring-green-500 focus:border-green-500"
                            onchange="updateContentFields()"
                        >
                            <option value="">Select type...</option>
                            <option value="hero">🎯 Hero Section</option>
                            <option value="text">📝 Text Content</option>
                            <option value="image">🖼️ Image</option>
                            <option value="cta">📢 Call to Action</option>
                            <option value="features">✨ Features List</option>
                        </select>
                    </div>

                    {{-- Dynamic Content Fields --}}
                    <div id="content-fields" class="space-y-4">
                        {{-- Populated by JavaScript --}}
                    </div>

                    {{-- Order --}}
                    <div>
                        <label for="order" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Order
                        </label>
                        <input
                            type="number"
                            id="order"
                            name="order"
                            value="{{ $page->sections->max('order') + 1 }}"
                            min="0"
                            class="block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg focus:ring-green-500 focus:border-green-500"
                        >
                    </div>

                    <button type="submit" class="w-full px-4 py-2.5 bg-green-600 text-white text-sm font-semibold rounded-lg hover:bg-green-700 transition-colors shadow-sm">
                        Add Section
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
function updateContentFields() {
    const sectionType = document.getElementById('section_type').value;
    const contentFields = document.getElementById('content-fields');
    const inputClass = 'block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg focus:ring-green-500 focus:border-green-500';
    const labelClass = 'block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2';

    let html = '';

    switch(sectionType) {
        case 'hero':
            html = `
                <div>
                    <label class="${labelClass}">Title <span class="text-red-500">*</span></label>
                    <input type="text" name="content[title]" required class="${inputClass}" placeholder="Hero title...">
                </div>
                <div>
                    <label class="${labelClass}">Subtitle</label>
                    <input type="text" name="content[subtitle]" class="${inputClass}" placeholder="Hero subtitle...">
                </div>
                <div>
                    <label class="${labelClass}">Button Text</label>
                    <input type="text" name="content[button_text]" class="${inputClass}" placeholder="Learn More">
                </div>
                <div>
                    <label class="${labelClass}">Button URL</label>
                    <input type="text" name="content[button_url]" class="${inputClass}" placeholder="/contact">
                </div>
            `;
            break;
        case 'text':
            html = `
                <div>
                    <label class="${labelClass}">Heading</label>
                    <input type="text" name="content[heading]" class="${inputClass}" placeholder="Section heading...">
                </div>
                <div>
                    <label class="${labelClass}">Body <span class="text-red-500">*</span></label>
                    <textarea name="content[body]" rows="6" required class="${inputClass}" placeholder="Write your content here..."></textarea>
                </div>
            `;
            break;
        case 'image':
            html = `
                <div>
                    <label class="${labelClass}">Image URL <span class="text-red-500">*</span></label>
                    <input type="text" name="content[image_url]" required class="${inputClass}" placeholder="https://example.com/image.jpg">
                </div>
                <div>
                    <label class="${labelClass}">Alt Text</label>
                    <input type="text" name="content[alt_text]" class="${inputClass}" placeholder="Image description...">
                </div>
                <div>
                    <label class="${labelClass}">Caption</label>
                    <input type="text" name="content[caption]" class="${inputClass}" placeholder="Image caption...">
                </div>
            `;
            break;
        case 'cta':
            html = `
                <div>
                    <label class="${labelClass}">Title <span class="text-red-500">*</span></label>
                    <input type="text" name="content[title]" required class="${inputClass}" placeholder="Ready to get started?">
                </div>
                <div>
                    <label class="${labelClass}">Description</label>
                    <textarea name="content[description]" rows="3" class="${inputClass}" placeholder="CTA description..."></textarea>
                </div>
                <div>
                    <label class="${labelClass}">Button Text <span class="text-red-500">*</span></label>
                    <input type="text" name="content[button_text]" required class="${inputClass}" placeholder="Get Started">
                </div>
                <div>
                    <label class="${labelClass}">Button URL <span class="text-red-500">*</span></label>
                    <input type="text" name="content[button_url]" required class="${inputClass}" placeholder="/signup">
                </div>
            `;
            break;
        case 'features':
            html = `
                <div>
                    <label class="${labelClass}">Heading</label>
                    <input type="text" name="content[heading]" class="${inputClass}" placeholder="Our Features">
                </div>
                <div>
                    <label class="${labelClass}">Features (one per line) <span class="text-red-500">*</span></label>
                    <textarea name="content[features]" rows="6" required class="${inputClass}" placeholder="Feature 1&#10;Feature 2&#10;Feature 3"></textarea>
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Each line will be a separate feature</p>
                </div>
            `;
            break;
    }

    contentFields.innerHTML = html;
}
</script>
@endpush
