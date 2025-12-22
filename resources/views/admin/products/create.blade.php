@extends('admin.layouts.app')

@section('title', 'Add Product')
@section('page-title', 'Add Product')

@section('page-header')
    <div class="sm:flex sm:items-center sm:justify-between">
        <div>
            <nav class="flex items-center gap-2 text-sm text-gray-500 mb-2">
                <a href="{{ route('admin.products.index') }}" class="hover:text-gray-700">Products</a>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <span class="text-gray-900">Add Product</span>
            </nav>
            <h1 class="text-2xl font-bold text-gray-900">Add New Product</h1>
        </div>
    </div>
@endsection

@section('content')
    <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            {{-- Main Content --}}
            <div class="lg:col-span-2 space-y-6">
                {{-- Basic Info --}}
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Basic Information</h2>

                    <div class="space-y-4">
                        {{-- Product Name --}}
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                                Product Name <span class="text-red-500">*</span>
                            </label>
                            <input
                                type="text"
                                id="name"
                                name="name"
                                value="{{ old('name') }}"
                                required
                                class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 @error('name') border-red-500 @enderror"
                                placeholder="Enter product name"
                            >
                            @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Slug --}}
                        <div>
                            <label for="slug" class="block text-sm font-medium text-gray-700 mb-1">
                                Slug <span class="text-gray-400 text-xs font-normal">(auto-generated if empty)</span>
                            </label>
                            <input
                                type="text"
                                id="slug"
                                name="slug"
                                value="{{ old('slug') }}"
                                class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 @error('slug') border-red-500 @enderror"
                                placeholder="product-url-slug"
                            >
                            @error('slug')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Short Description --}}
                        <div>
                            <label for="short_description" class="block text-sm font-medium text-gray-700 mb-1">
                                Short Description
                            </label>
                            <textarea
                                id="short_description"
                                name="short_description"
                                rows="2"
                                class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 @error('short_description') border-red-500 @enderror"
                                placeholder="Brief product description for listings"
                            >{{ old('short_description') }}</textarea>
                            @error('short_description')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Full Description --}}
                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-1">
                                Full Description
                            </label>
                            <textarea
                                id="description"
                                name="description"
                                rows="6"
                                class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 @error('description') border-red-500 @enderror"
                                placeholder="Detailed product description"
                            >{{ old('description') }}</textarea>
                            @error('description')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Image Upload --}}
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Product Image</h2>

                    <div x-data="{ imagePreview: null }">
                        <div class="flex items-center justify-center w-full">
                            <label
                                for="image"
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
                                    id="image"
                                    name="image"
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
                                    @click="imagePreview = null; document.getElementById('image').value = ''"
                                    class="absolute top-2 right-2 p-1.5 bg-red-500 text-white rounded-full hover:bg-red-600 transition-colors"
                                >
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        @error('image')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- Sidebar --}}
            <div class="space-y-6">
                {{-- Publish --}}
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Publish</h2>

                    <div class="space-y-4">
                        {{-- Status --}}
                        <div class="flex items-center justify-between py-2">
                            <span class="text-sm text-gray-600">Status</span>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="hidden" name="is_active" value="0">
                                <input type="checkbox" name="is_active" value="1" class="sr-only peer" {{ old('is_active', true) ? 'checked' : '' }}>
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-green-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-green-600"></div>
                                <span class="ml-2 text-sm font-medium text-gray-700">Active</span>
                            </label>
                        </div>

                        {{-- Featured --}}
                        <div class="flex items-center justify-between py-2 border-t border-gray-100">
                            <span class="text-sm text-gray-600">Featured</span>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="hidden" name="is_featured" value="0">
                                <input type="checkbox" name="is_featured" value="1" class="sr-only peer" {{ old('is_featured') ? 'checked' : '' }}>
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-yellow-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-yellow-500"></div>
                                <span class="ml-2 text-sm font-medium text-gray-700">Featured</span>
                            </label>
                        </div>
                    </div>

                    <div class="mt-6 flex gap-3">
                        <button type="submit" class="flex-1 inline-flex justify-center items-center gap-2 rounded-lg bg-green-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-green-700 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Save Product
                        </button>
                    </div>

                    <div class="mt-3">
                        <a href="{{ route('admin.products.index') }}" class="block w-full text-center px-4 py-2.5 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors">
                            Cancel
                        </a>
                    </div>
                </div>

                {{-- Category & Type --}}
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Organization</h2>

                    <div class="space-y-4">
                        {{-- Category --}}
                        <div>
                            <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1">
                                Category
                            </label>
                            <select
                                id="category_id"
                                name="category_id"
                                class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500"
                            >
                                <option value="">No Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Type --}}
                        <div>
                            <label for="type" class="block text-sm font-medium text-gray-700 mb-1">
                                Type <span class="text-red-500">*</span>
                            </label>
                            <select
                                id="type"
                                name="type"
                                required
                                class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500"
                            >
                                @foreach($types as $value => $label)
                                    <option value="{{ $value }}" {{ old('type', 'natural') === $value ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- SKU --}}
                        <div>
                            <label for="sku" class="block text-sm font-medium text-gray-700 mb-1">
                                SKU
                            </label>
                            <input
                                type="text"
                                id="sku"
                                name="sku"
                                value="{{ old('sku') }}"
                                class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500"
                                placeholder="Product SKU"
                            >
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
                                class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500"
                            >
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
