@extends('admin.layouts.app')

@section('title', 'Add Partner')
@section('page-title', 'Add Partner')

@section('page-header')
    <div class="sm:flex sm:items-center sm:justify-between">
        <div>
            <nav class="flex items-center gap-2 text-sm text-gray-500 mb-2">
                <a href="{{ route('admin.partners.index') }}" class="hover:text-gray-700">Partners</a>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <span class="text-gray-900">Add Partner</span>
            </nav>
            <h1 class="text-2xl font-bold text-gray-900">Add New Partner</h1>
        </div>
    </div>
@endsection

@section('content')
    <form method="POST" action="{{ route('admin.partners.store') }}" enctype="multipart/form-data">
        @csrf

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
                            value="{{ old('name') }}"
                            required
                            class="block w-full @error('name') border-red-500 @enderror"
                            placeholder="Enter partner name"
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
                        <div x-data="{ imagePreview: null }">
                            <div class="flex items-start gap-6">
                                {{-- Upload Area --}}
                                <div class="flex-1">
                                    <label
                                        for="logo"
                                        class="flex flex-col items-center justify-center w-full h-40 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 transition-colors"
                                        x-show="!imagePreview"
                                    >
                                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                            <svg class="w-10 h-10 mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                            <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Click to upload</span></p>
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
                                    <div x-show="imagePreview" class="relative w-full h-40 border-2 border-gray-200 rounded-lg bg-gray-50 flex items-center justify-center p-4">
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
                                value="{{ old('website') }}"
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
                            placeholder="Brief description about this partner"
                        >{{ old('description') }}</textarea>
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
                            <option value="partner" {{ old('type', 'partner') === 'partner' ? 'selected' : '' }}>Partner</option>
                            <option value="distributor" {{ old('type') === 'distributor' ? 'selected' : '' }}>Distributor</option>
                            <option value="supplier" {{ old('type') === 'supplier' ? 'selected' : '' }}>Supplier</option>
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
                                <input type="checkbox" name="is_active" value="1" class="sr-only peer" {{ old('is_active', true) ? 'checked' : '' }}>
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
                                <input type="checkbox" name="is_featured" value="1" class="sr-only peer" {{ old('is_featured') ? 'checked' : '' }}>
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
                            value="{{ old('sort_order', 0) }}"
                            min="0"
                            class="block w-32"
                        >
                        <p class="mt-1 text-xs text-gray-500">Lower numbers appear first</p>
                    </div>
                </div>

                {{-- Actions --}}
                <div class="mt-8 pt-6 border-t border-gray-200 flex items-center gap-4">
                    <button type="submit" class="inline-flex items-center gap-2 rounded-lg bg-green-600 px-6 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-green-700 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Save Partner
                    </button>
                    <a href="{{ route('admin.partners.index') }}" class="px-6 py-2.5 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors">
                        Cancel
                    </a>
                </div>
            </div>
        </div>
    </form>
@endsection
