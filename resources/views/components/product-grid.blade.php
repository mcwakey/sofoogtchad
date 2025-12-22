@props([
    'products' => [],
    'columns' => 4,
    'title' => null,
    'subtitle' => null,
    'viewAllUrl' => null,
    'viewAllText' => 'View All Products',
    'emptyMessage' => 'No products found.',
    'showBadge' => true,
])

@php
    $gridCols = match($columns) {
        2 => 'grid-cols-1 sm:grid-cols-2',
        3 => 'grid-cols-1 sm:grid-cols-2 lg:grid-cols-3',
        5 => 'grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5',
        6 => 'grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6',
        default => 'grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4', // 4 columns
    };
@endphp

<section {{ $attributes->merge(['class' => 'product-grid-section']) }}>
    {{-- Section Header --}}
    @if($title || $subtitle || $viewAllUrl)
        <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between mb-8 gap-4">
            <div>
                @if($title)
                    <h2 class="text-2xl sm:text-3xl font-bold text-gray-900">{{ $title }}</h2>
                @endif
                @if($subtitle)
                    <p class="mt-2 text-gray-600">{{ $subtitle }}</p>
                @endif
            </div>

            @if($viewAllUrl)
                <a href="{{ $viewAllUrl }}" class="inline-flex items-center text-green-600 font-medium hover:text-green-700 transition-colors whitespace-nowrap">
                    {{ $viewAllText }}
                    <svg class="w-5 h-5 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </a>
            @endif
        </div>
    @endif

    {{-- Products Grid --}}
    @if(count($products) > 0)
        <div class="grid {{ $gridCols }} gap-6">
            @foreach($products as $product)
                <x-card
                    :image="$product->featured_image ?? $product->image ?? '/images/placeholder-product.jpg'"
                    :imageAlt="$product->name"
                    :title="$product->name"
                    :description="Str::limit($product->short_description ?? $product->description ?? '', 100)"
                    :link="route('products.show', $product->slug)"
                    linkText="View Product"
                    :badge="$showBadge && $product->category ? $product->category->name : null"
                    badgeColor="green"
                >
                    {{-- Price or additional info --}}
                    @if(isset($product->price) && $product->price)
                        <div class="flex items-center gap-2 mt-2">
                            @if(isset($product->sale_price) && $product->sale_price)
                                <span class="text-lg font-bold text-green-600">
                                    {{ number_format($product->sale_price, 0) }} FCFA
                                </span>
                                <span class="text-sm text-gray-400 line-through">
                                    {{ number_format($product->price, 0) }} FCFA
                                </span>
                            @else
                                <span class="text-lg font-bold text-green-600">
                                    {{ number_format($product->price, 0) }} FCFA
                                </span>
                            @endif
                        </div>
                    @endif

                    {{-- Sizes available --}}
                    @if(isset($product->sizes) && $product->sizes->count() > 0)
                        <p class="text-xs text-gray-500 mt-1">
                            {{ $product->sizes->count() }} size{{ $product->sizes->count() > 1 ? 's' : '' }} available
                        </p>
                    @endif
                </x-card>
            @endforeach
        </div>
    @else
        {{-- Empty State --}}
        <div class="text-center py-12 bg-gray-50 rounded-lg">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
            </svg>
            <h3 class="mt-4 text-lg font-medium text-gray-900">{{ $emptyMessage }}</h3>
            @if($viewAllUrl)
                <p class="mt-2 text-gray-500">
                    <a href="{{ $viewAllUrl }}" class="text-green-600 hover:text-green-700">Browse our catalog</a>
                </p>
            @endif
        </div>
    @endif

    {{-- Extra Content Slot --}}
    @if($slot->isNotEmpty())
        <div class="mt-8">
            {{ $slot }}
        </div>
    @endif
</section>
