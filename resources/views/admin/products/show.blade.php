@extends('admin.layouts.app')

@section('title', $product->name)
@section('page-title', 'View Product')

@section('page-header')
    <div class="sm:flex sm:items-center sm:justify-between">
        <div>
            <nav class="flex items-center gap-2 text-sm text-gray-500 mb-2">
                <a href="{{ route('admin.products.index') }}" class="hover:text-gray-700">Products</a>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <span class="text-gray-900">{{ $product->name }}</span>
            </nav>
            <h1 class="text-2xl font-bold text-gray-900">{{ $product->name }}</h1>
        </div>
        <div class="mt-4 sm:mt-0 flex items-center gap-3">
            <a href="{{ route('admin.products.edit', $product) }}" class="inline-flex items-center gap-2 rounded-lg bg-green-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-green-700 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
                Edit Product
            </a>
            @if($product->is_active)
                <a href="{{ route('products.show', $product->slug) }}" target="_blank" class="inline-flex items-center gap-2 rounded-lg bg-gray-100 px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-200 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                    </svg>
                    View on Site
                </a>
            @endif
        </div>
    </div>
@endsection

@section('content')
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- Main Content --}}
        <div class="lg:col-span-2 space-y-6">
            {{-- Product Overview --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                {{-- Primary Image --}}
                @if($product->primaryImage)
                    <div class="aspect-video bg-gray-100">
                        <img src="{{ $product->primaryImage->image_path }}" alt="{{ $product->primaryImage->alt_text ?? $product->name }}" class="w-full h-full object-cover">
                    </div>
                @else
                    <div class="aspect-video bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                        <svg class="w-20 h-20 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                @endif

                <div class="p-6">
                    {{-- Status Badges --}}
                    <div class="flex flex-wrap gap-2 mb-4">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $product->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                            {{ $product->is_active ? 'Active' : 'Draft' }}
                        </span>
                        @if($product->is_featured)
                            <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                                Featured
                            </span>
                        @endif
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                            {{ ucfirst($product->type) }}
                        </span>
                    </div>

                    {{-- Short Description --}}
                    @if($product->short_description)
                        <p class="text-gray-600 mb-4">{{ $product->short_description }}</p>
                    @endif

                    {{-- Full Description --}}
                    @if($product->description)
                        <div class="prose prose-sm max-w-none text-gray-700">
                            {!! nl2br(e($product->description)) !!}
                        </div>
                    @else
                        <p class="text-gray-400 italic">No description provided.</p>
                    @endif
                </div>
            </div>

            {{-- Product Images Gallery --}}
            @if($product->images->count() > 0)
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">
                        Product Images
                        <span class="text-sm font-normal text-gray-500">({{ $product->images->count() }})</span>
                    </h2>

                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                        @foreach($product->images as $image)
                            <div class="relative group aspect-square rounded-lg overflow-hidden bg-gray-100">
                                <img src="{{ $image->image_path }}" alt="{{ $image->alt_text }}" class="w-full h-full object-cover transition-transform group-hover:scale-105">
                                @if($image->is_primary)
                                    <span class="absolute top-2 left-2 px-2 py-0.5 bg-green-500 text-white text-xs font-medium rounded shadow">Primary</span>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- Product Sizes --}}
            @if($product->sizes->count() > 0)
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">
                        Available Sizes
                        <span class="text-sm font-normal text-gray-500">({{ $product->sizes->count() }})</span>
                    </h2>

                    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3">
                        @foreach($product->sizes as $size)
                            <div class="relative p-4 rounded-lg border {{ $size->is_default ? 'border-green-300 bg-green-50' : 'border-gray-200 bg-gray-50' }}">
                                @if($size->is_default)
                                    <span class="absolute -top-2 left-3 px-2 py-0.5 bg-green-500 text-white text-[10px] font-medium rounded">Default</span>
                                @endif
                                <p class="font-medium text-gray-900">{{ $size->name }}</p>
                                @if($size->value)
                                    <p class="text-sm text-gray-500">{{ $size->value }}</p>
                                @endif
                                @if($size->price_adjustment != 0)
                                    <p class="text-sm font-medium {{ $size->price_adjustment > 0 ? 'text-green-600' : 'text-red-600' }} mt-1">
                                        {{ $size->price_adjustment > 0 ? '+' : '' }}{{ number_format($size->price_adjustment, 0) }} FCFA
                                    </p>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>

        {{-- Sidebar --}}
        <div class="space-y-6">
            {{-- Product Details --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Details</h2>

                <dl class="space-y-4">
                    {{-- Category --}}
                    <div class="flex items-center justify-between py-2 border-b border-gray-100">
                        <dt class="text-sm text-gray-500">Category</dt>
                        <dd class="text-sm font-medium text-gray-900">
                            @if($product->category)
                                <a href="{{ route('admin.categories.edit', $product->category) }}" class="text-green-600 hover:text-green-700">
                                    {{ $product->category->name }}
                                </a>
                            @else
                                <span class="text-gray-400">—</span>
                            @endif
                        </dd>
                    </div>

                    {{-- Type --}}
                    <div class="flex items-center justify-between py-2 border-b border-gray-100">
                        <dt class="text-sm text-gray-500">Type</dt>
                        <dd class="text-sm font-medium text-gray-900">{{ ucfirst($product->type) }}</dd>
                    </div>

                    {{-- SKU --}}
                    <div class="flex items-center justify-between py-2 border-b border-gray-100">
                        <dt class="text-sm text-gray-500">SKU</dt>
                        <dd class="text-sm font-mono text-gray-900">{{ $product->sku ?? '—' }}</dd>
                    </div>

                    {{-- Slug --}}
                    <div class="flex items-center justify-between py-2 border-b border-gray-100">
                        <dt class="text-sm text-gray-500">Slug</dt>
                        <dd class="text-sm font-mono text-gray-600 truncate max-w-[150px]" title="{{ $product->slug }}">{{ $product->slug }}</dd>
                    </div>

                    {{-- Sort Order --}}
                    <div class="flex items-center justify-between py-2 border-b border-gray-100">
                        <dt class="text-sm text-gray-500">Sort Order</dt>
                        <dd class="text-sm font-medium text-gray-900">{{ $product->sort_order ?? 0 }}</dd>
                    </div>

                    {{-- Images Count --}}
                    <div class="flex items-center justify-between py-2 border-b border-gray-100">
                        <dt class="text-sm text-gray-500">Images</dt>
                        <dd class="text-sm font-medium text-gray-900">{{ $product->images->count() }}</dd>
                    </div>

                    {{-- Sizes Count --}}
                    <div class="flex items-center justify-between py-2">
                        <dt class="text-sm text-gray-500">Sizes</dt>
                        <dd class="text-sm font-medium text-gray-900">{{ $product->sizes->count() }}</dd>
                    </div>
                </dl>
            </div>

            {{-- Timestamps --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Timeline</h2>

                <div class="space-y-4">
                    <div class="flex items-start gap-3">
                        <div class="flex-shrink-0 w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                            <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-900">Created</p>
                            <p class="text-sm text-gray-500">{{ $product->created_at->format('M d, Y \a\t g:i A') }}</p>
                            <p class="text-xs text-gray-400">{{ $product->created_at->diffForHumans() }}</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3">
                        <div class="flex-shrink-0 w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-900">Last Updated</p>
                            <p class="text-sm text-gray-500">{{ $product->updated_at->format('M d, Y \a\t g:i A') }}</p>
                            <p class="text-xs text-gray-400">{{ $product->updated_at->diffForHumans() }}</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Quick Actions --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Actions</h2>

                <div class="space-y-3">
                    <a href="{{ route('admin.products.edit', $product) }}" class="w-full inline-flex justify-center items-center gap-2 rounded-lg bg-green-600 px-4 py-2.5 text-sm font-semibold text-white hover:bg-green-700 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        Edit Product
                    </a>

                    <a href="{{ route('admin.products.index') }}" class="w-full inline-flex justify-center items-center gap-2 rounded-lg bg-gray-100 px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-200 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Back to Products
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
