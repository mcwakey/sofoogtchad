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
                    <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-white">{{ $title }}</h2>
                @endif
                @if($subtitle)
                    <p class="mt-2 text-gray-600 dark:text-gray-300">{{ $subtitle }}</p>
                @endif
            </div>

            @if($viewAllUrl)
                <a href="{{ $viewAllUrl }}" class="inline-flex items-center text-green-600 dark:text-green-400 font-medium hover:text-green-700 dark:hover:text-green-300 transition-colors whitespace-nowrap">
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
                @php
                    // Support both array and object formats
                    $isArray = is_array($product);
                    $name = $isArray ? ($product['name'] ?? '') : ($product->name ?? '');
                    $description = $isArray
                        ? ($product['description'] ?? '')
                        : Str::limit($product->short_description ?? $product->description ?? '', 100);
                    $image = $isArray
                        ? ($product['image'] ?? '/images/placeholder-product.jpg')
                        : ($product->featured_image ?? $product->image ?? '/images/placeholder-product.jpg');
                    $url = $isArray
                        ? ($product['url'] ?? '#')
                        : route('products.show', $product->slug);
                    $badge = $isArray
                        ? ($product['badge'] ?? null)
                        : ($showBadge && $product->category ? $product->category->name : null);
                    $price = $isArray ? ($product['price'] ?? null) : ($product->price ?? null);
                    $salePrice = $isArray ? ($product['sale_price'] ?? null) : ($product->sale_price ?? null);
                    $sizes = $isArray ? null : ($product->sizes ?? null);
                @endphp
                <x-card
                    :image="$image"
                    :imageAlt="$name"
                    :title="$name"
                    :description="$description"
                    :link="$url"
                    linkText="View Product"
                    :badge="$badge"
                    badgeColor="green"
                >
                    {{-- Price or additional info --}}
                    @if($price)
                        <div class="flex items-center gap-2 mt-2">
                            @if($salePrice)
                                <span class="text-lg font-bold text-green-600">
                                    {{ number_format($salePrice, 0) }} FCFA
                                </span>
                                <span class="text-sm text-gray-400 line-through">
                                    {{ number_format($price, 0) }} FCFA
                                </span>
                            @else
                                <span class="text-lg font-bold text-green-600">
                                    {{ number_format($price, 0) }} FCFA
                                </span>
                            @endif
                        </div>
                    @endif

                    {{-- Sizes available --}}
                    @if($sizes && $sizes->count() > 0)
                        <p class="text-xs text-gray-500 mt-1">
                            {{ $sizes->count() }} size{{ $sizes->count() > 1 ? 's' : '' }} available
                        </p>
                    @endif
                </x-card>
            @endforeach
        </div>
    @else
        {{-- Empty State --}}
        <div class="text-center py-12 bg-gray-50 dark:bg-gray-800 rounded-lg">
            <svg class="mx-auto h-12 w-12 text-gray-400 dark:text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
            </svg>
            <h3 class="mt-4 text-lg font-medium text-gray-900 dark:text-white">{{ $emptyMessage }}</h3>
            @if($viewAllUrl)
                <p class="mt-2 text-gray-500 dark:text-gray-400">
                    <a href="{{ $viewAllUrl }}" class="text-green-600 dark:text-green-400 hover:text-green-700 dark:hover:text-green-300">Browse our catalog</a>
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
