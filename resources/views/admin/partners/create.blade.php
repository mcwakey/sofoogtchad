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

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            {{-- Main Content --}}
            <div class="lg:col-span-2 space-y-6">
                {{-- Basic Info --}}
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Partner Information</h2>

                    {{-- Website URL (not translatable) --}}
                    <div class="mb-6">
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

                    {{-- Translatable Fields --}}
                    <x-admin.language-tabs>
                        <div class="space-y-4">
                            <x-admin.translatable-input
                                name="name"
                                label="Partner Name"
                                :required="true"
                                placeholder="Enter partner name"
                            />

                            <x-admin.translatable-textarea
                                name="description"
                                label="Description"
                                :rows="4"
                                placeholder="Brief description about this partner"
                            />
                        </div>
                    </x-admin.language-tabs>
                </div>

                {{-- Logo Upload --}}
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Partner Logo</h2>

                    <div x-data="{ imagePreview: null }">
                        <div class="flex items-center justify-center w-full">
                            <label
                                for="logo"
                                class="flex flex-col items-center justify-center w-full h-48 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 transition-colors"
                                x-show="!imagePreview"
                            >
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <svg class="w-10 h-10 mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Click to upload</span> or drag and drop</p>
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
                            <div x-show="imagePreview" class="relative w-full">
                                <div class="w-full h-48 bg-gray-50 rounded-lg flex items-center justify-center p-4">
                                    <img :src="imagePreview" class="max-h-full max-w-full object-contain">
                                </div>
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
                        @error('logo')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- Sidebar --}}
            <div class="space-y-6">
                {{-- Settings --}}
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Settings</h2>

                    <div class="space-y-4">
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
                                class="block w-full"
                            >
                            <p class="mt-1 text-xs text-gray-500">Lower numbers appear first</p>
                        </div>

                        {{-- Toggles --}}
                        <div class="pt-4 border-t border-gray-200 space-y-3">
                            {{-- Active --}}
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                <div>
                                    <p class="text-sm font-medium text-gray-900">Active</p>
                                    <p class="text-xs text-gray-500">Show on website</p>
                                </div>
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="hidden" name="is_active" value="0">
                                    <input type="checkbox" name="is_active" value="1" class="sr-only peer" {{ old('is_active', true) ? 'checked' : '' }}>
                                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-green-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-green-600"></div>
                                </label>
                            </div>

                            {{-- Featured --}}
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                <div>
                                    <p class="text-sm font-medium text-gray-900">Featured</p>
                                    <p class="text-xs text-gray-500">Highlight partner</p>
                                </div>
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="hidden" name="is_featured" value="0">
                                    <input type="checkbox" name="is_featured" value="1" class="sr-only peer" {{ old('is_featured') ? 'checked' : '' }}>
                                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-yellow-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-yellow-500"></div>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 flex gap-3">
                        <button type="submit" class="flex-1 inline-flex justify-center items-center gap-2 rounded-lg bg-green-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-green-700 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Save Partner
                        </button>
                    </div>

                    <div class="mt-3">
                        <a href="{{ route('admin.partners.index') }}" class="block w-full text-center px-4 py-2.5 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors">
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
                            <h3 class="text-sm font-medium text-blue-900">Partner Tips</h3>
                            <ul class="mt-2 text-sm text-blue-800 space-y-1">
                                <li>• Use a high-quality logo</li>
                                <li>• Add website for linking</li>
                                <li>• Select the correct type</li>
                                <li>• Feature important partners</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
