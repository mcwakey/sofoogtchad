<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ $product->short_description ?? $product->description }}">
    <title>{{ $product->name }} - {{ config('app.name') }}</title>
</head>
<body>
    <div id="product-detail">
        {{-- Breadcrumb --}}
        <nav class="breadcrumb">
            <a href="{{ route('products.index') }}">Products</a>
            @if($product->category)
                <span>/</span>
                <a href="{{ route('products.category', $product->category->slug) }}">{{ $product->category->name }}</a>
            @endif
            <span>/</span>
            <span>{{ $product->name }}</span>
        </nav>

        <div class="product-layout">
            {{-- Product Images --}}
            <div class="product-gallery">
                @if($product->images->count() > 0)
                    <div class="main-image">
                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" id="mainImage">
                    </div>
                    @if($product->images->count() > 1)
                        <div class="thumbnail-images">
                            @foreach($product->images as $image)
                                <img src="{{ $image->image_path }}" 
                                     alt="{{ $image->alt_text ?? $product->name }}" 
                                     onclick="document.getElementById('mainImage').src='{{ $image->image_path }}'"
                                     class="thumbnail {{ $image->is_primary ? 'active' : '' }}">
                            @endforeach
                        </div>
                    @endif
                @else
                    <div class="no-image">No Image Available</div>
                @endif
            </div>

            {{-- Product Info --}}
            <div class="product-info">
                @if($product->category)
                    <span class="product-category">{{ $product->category->name }}</span>
                @endif

                <h1 class="product-name">{{ $product->name }}</h1>

                <span class="product-type badge">{{ $product->type_label }}</span>

                @if($product->short_description)
                    <p class="product-short-description">{{ $product->short_description }}</p>
                @endif

                {{-- Sizes (if available) --}}
                @if($product->sizes->count() > 0)
                    <div class="product-sizes">
                        <h3>Available Sizes</h3>
                        <div class="size-options">
                            @foreach($product->sizes as $size)
                                <span class="size-option {{ $size->is_default ? 'default' : '' }}">
                                    {{ $size->name }}
                                    @if($size->value)
                                        ({{ $size->value }})
                                    @endif
                                </span>
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- Full Description --}}
                @if($product->description)
                    <div class="product-description">
                        <h3>Description</h3>
                        {!! nl2br(e($product->description)) !!}
                    </div>
                @endif
            </div>
        </div>

        {{-- Related Products --}}
        @if($relatedProducts->count() > 0)
            <section class="related-products">
                <h2>Related Products</h2>
                <div class="products-grid">
                    @foreach($relatedProducts as $related)
                        <article class="product-card">
                            <a href="{{ route('products.show', $related->slug) }}">
                                @if($related->image_url)
                                    <img src="{{ $related->image_url }}" alt="{{ $related->name }}" class="product-image">
                                @else
                                    <div class="product-image-placeholder">No Image</div>
                                @endif
                            </a>
                            <div class="product-info">
                                <h3 class="product-name">
                                    <a href="{{ route('products.show', $related->slug) }}">{{ $related->name }}</a>
                                </h3>
                                <span class="product-type">{{ $related->type_label }}</span>
                            </div>
                        </article>
                    @endforeach
                </div>
            </section>
        @endif
    </div>
</body>
</html>
