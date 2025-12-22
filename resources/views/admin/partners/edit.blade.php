@extends('admin.layouts.app')

@section('title', 'Edit Partner: ' . $partner->name)
@section('page-title', 'Edit Partner')

@section('page-header')
    <div class="sm:flex sm:items-center sm:justify-between">
        <div>
            <nav class="flex items-center gap-2 text-sm text-gray-500 mb-2">
                <a href="{{ route('admin.partners.index') }}" class="hover:text-gray-700">Partners</a>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <span class="text-gray-900">{{ $partner->name }}</span>
            </nav>
            <h1 class="text-2xl font-bold text-gray-900">Edit Partner</h1>
        </div>
        @if($partner->website)
            <div class="mt-4 sm:mt-0">
                <a href="{{ $partner->website }}" target="_blank" class="inline-flex items-center gap-2 rounded-lg bg-gray-100 px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-200 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                    </svg>
                    Visit Website
                </a>
            </div>
        @endif
    </div>
@endsection

@section('content')
    <form method="POST" action="{{ route('admin.partners.update', $partner) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="max-w-3xl">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="space-y-6">
                    {{-- Partner Name --}}
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                            Partner Name <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="text"
                            id="name"
                            name="name"
                            value="{{ old('name', $partner->name) }}"
                            required
                            class="block w-full @error('name') border-red-500 @enderror"
                        >
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Logo Upload --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Logo
                        </label>

                        {{-- Current Logo --}}
                        @if($partner->logo_url)
                            <div class="mb-4">
                                <p class="text-sm text-gray-500 mb-2">Current Logo:</p>
                                <div class="inline-flex items-center justify-center p-4 bg-gray-50 rounded-lg border border-gray-200">
                                    <img src="{{ $partner->logo_url }}" alt="{{ $partner->name }}" class="max-h-24 max-w-[200px] object-contain">
                                </div>
                            </div>
                        @endif

                        <div x-data="{ imagePreview: null }">
                            <p class="text-sm text-gray-500 mb-2">{{ $partner->logo_url ? 'Replace with new logo:' : 'Upload logo:' }}</p>
                            <div class="flex items-start gap-6">
                                {{-- Upload Area --}}
                                <div class="flex-1">
                                    <label
                                        for="logo"
                                        class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 transition-colors"
                                        x-show="!imagePreview"
                                    >
                                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                            <svg class="w-8 h-8 mb-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                            <p class="text-sm text-gray-500"><span class="font-semibold">Click to upload</span></p>
                                            <p class="text-xs text-gray-400">PNG, JPG, SVG up to 1MB</p>
                                        </div>
                                        <input
                                            id="logo"
                                            name="logo"
                                            type="file"
                                            class="hidden"
                                            accept="image/*"
                                            @change="const file = $event.target.files[0]; if(file) { const reader = new FileReader(); reader.onload = (e) => imagePreview = e.target.result; reader.readAsDataURL(file); }"
                                        >
                                    </label>

                                    {{-- Preview --}}
                                    <div x-show="imagePreview" class="relative w-full h-32 border-2 border-green-300 rounded-lg bg-green-50 flex items-center justify-center p-4">
                                        <span class="absolute top-2 left-2 px-2 py-0.5 bg-green-500 text-white text-xs font-medium rounded">New</span>
                                        <img :src="imagePreview" class="max-h-full max-w-full object-contain">
                                        <button
                                            type="button"
                                            @click="imagePreview = null; document.getElementById('logo').value = ''"
                                            class="absolute top-2 right-2 p-1.5 bg-red-500 text-white rounded-full hover:bg-red-600 transition-colors"
                                        >
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            @error('logo')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- Website URL --}}
                    <div>
                        <label for="website" class="block text-sm font-medium text-gray-700 mb-1">
                            Website URL <span class="text-gray-400 text-xs font-normal">(optional)</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/>
                                </svg>
                            </div>
                            <input
                                type="url"
                                id="website"
                                name="website"
                                value="{{ old('website', $partner->website) }}"
                                class="block w-full pl-10 @error('website') border-red-500 @enderror"
                                placeholder="https://example.com"
                            >
                        </div>
                        @error('website')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Description --}}
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">
                            Description <span class="text-gray-400 text-xs font-normal">(optional)</span>
                        </label>
                        <textarea
                            id="description"
                            name="description"
                            rows="3"
                            class="block w-full @error('description') border-red-500 @enderror"
                        >{{ old('description', $partner->description) }}</textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Type --}}
                    <div>
                        <label for="type" class="block text-sm font-medium text-gray-700 mb-1">
                            Type <span class="text-red-500">*</span>
                        </label>
                        <select id="type" name="type" required class="block w-full">
                            <option value="partner" {{ old('type', $partner->type) === 'partner' ? 'selected' : '' }}>Partner</option>
                            <option value="distributor" {{ old('type', $partner->type) === 'distributor' ? 'selected' : '' }}>Distributor</option>
                            <option value="supplier" {{ old('type', $partner->type) === 'supplier' ? 'selected' : '' }}>Supplier</option>
                        </select>
                    </div>

                    {{-- Toggles --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-4 border-t border-gray-200">
                        {{-- Active --}}
                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                            <div>
                                <p class="text-sm font-medium text-gray-900">Active</p>
                                <p class="text-xs text-gray-500">Show this partner on the website</p>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="hidden" name="is_active" value="0">
                                <input type="checkbox" name="is_active" value="1" class="sr-only peer" {{ old('is_active', $partner->is_active) ? 'checked' : '' }}>
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-green-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-green-600"></div>
                            </label>
                        </div>

                        {{-- Featured --}}
                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                            <div>
                                <p class="text-sm font-medium text-gray-900">Featured</p>
                                <p class="text-xs text-gray-500">Highlight this partner</p>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="hidden" name="is_featured" value="0">
                                <input type="checkbox" name="is_featured" value="1" class="sr-only peer" {{ old('is_featured', $partner->is_featured) ? 'checked' : '' }}>
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-yellow-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-yellow-500"></div>
                            </label>
                        </div>
                    </div>

                    {{-- Sort Order --}}
                    <div>
                        <label for="sort_order" class="block text-sm font-medium text-gray-700 mb-1">
                            Sort Order
                        </label>
                        <input
                            type="number"
                            id="sort_order"
                            name="sort_order"
                            value="{{ old('sort_order', $partner->sort_order) }}"
                            min="0"
                            class="block w-32"
                        >
                        <p class="mt-1 text-xs text-gray-500">Lower numbers appear first</p>
                    </div>

                    {{-- Meta Info --}}
                    <div class="pt-4 border-t border-gray-200 text-sm text-gray-500">
                        <p>Created: {{ $partner->created_at->format('M d, Y \a\t g:i A') }}</p>
                        <p>Updated: {{ $partner->updated_at->format('M d, Y \a\t g:i A') }}</p>
                    </div>
                </div>

                {{-- Actions --}}
                <div class="mt-8 pt-6 border-t border-gray-200 flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <button type="submit" class="inline-flex items-center gap-2 rounded-lg bg-green-600 px-6 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-green-700 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Update Partner
                        </button>
                        <a href="{{ route('admin.partners.index') }}" class="px-6 py-2.5 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors">
                            Cancel
                        </a>
                    </div>
                </div>
            </div>

            {{-- Danger Zone --}}
            <div class="mt-6 bg-white rounded-xl shadow-sm border border-red-200 p-6" x-data="{ showDeleteModal: false }">
                <h2 class="text-lg font-semibold text-red-600 mb-2">Danger Zone</h2>
                <p class="text-sm text-gray-600 mb-4">Once you delete a partner, there is no going back.</p>
                <button
                    type="button"
                    @click="showDeleteModal = true"
                    class="inline-flex items-center gap-2 rounded-lg bg-red-50 px-4 py-2.5 text-sm font-semibold text-red-600 hover:bg-red-100 transition-colors"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                    Delete Partner
                </button>

                {{-- Delete Modal --}}
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
                                <h3 class="text-xl font-semibold text-gray-900 mb-2">Delete Partner</h3>
                                <p class="text-gray-600 mb-2">Are you sure you want to delete</p>
                                <p class="text-lg font-medium text-gray-900 mb-4">"{{ $partner->name }}"?</p>
                                <p class="text-sm text-gray-500">This action cannot be undone.</p>
                            </div>
                            <div class="p-6 pt-0 flex gap-3">
                                <button type="button" @click="showDeleteModal = false" class="flex-1 px-4 py-2.5 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors">
                                    Cancel
                                </button>
                                <form action="{{ route('admin.partners.destroy', $partner) }}" method="POST" class="flex-1">
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
            </div>
        </div>
    </form>
@endsection
