<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ isset($category) ? $category->name . ' - ' : '' }}Products - {{ config('app.name') }}</title>
</head>
<body>
    <div id="products-page">
        <header class="page-header">
            <h1>{{ isset($category) ? $category->name : 'Our Products' }}</h1>
            @if(isset($category) && $category->description)
                <p>{{ $category->description }}</p>
            @endif
        </header>

        <div class="products-layout">
            {{-- Sidebar Filters --}}
            <aside class="products-sidebar">
                <h3>Categories</h3>
                <ul class="category-list">
                    <li>
                        <a href="{{ route('products.index') }}" class="{{ !isset($category) && !request('category') ? 'active' : '' }}">
                            All Products
                        </a>
                    </li>
                    @foreach($categories as $cat)
                        <li>
                            <a href="{{ route('products.category', $cat->slug) }}" 
                               class="{{ (isset($category) && $category->id === $cat->id) || request('category') === $cat->slug ? 'active' : '' }}">
                                {{ $cat->name }} ({{ $cat->products_count }})
                            </a>
                        </li>
                    @endforeach
                </ul>

                <h3>Type</h3>
                <ul class="type-list">
                    <li>
                        <a href="{{ request()->fullUrlWithQuery(['type' => null]) }}" class="{{ !request('type') ? 'active' : '' }}">
                            All Types
                        </a>
                    </li>
                    @foreach($types as $value => $label)
                        <li>
                            <a href="{{ request()->fullUrlWithQuery(['type' => $value]) }}" 
                               class="{{ request('type') === $value ? 'active' : '' }}">
                                {{ $label }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </aside>

            {{-- Products Grid --}}
            <main class="products-grid">
                @forelse($products as $product)
                    <article class="product-card">
                        <a href="{{ route('products.show', $product->slug) }}">
                            @if($product->image_url)
                                <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="product-image">
                            @else
                                <div class="product-image-placeholder">No Image</div>
                            @endif
                        </a>
                        <div class="product-info">
                            @if($product->category)
                                <span class="product-category">{{ $product->category->name }}</span>
                            @endif
                            <h2 class="product-name">
                                <a href="{{ route('products.show', $product->slug) }}">{{ $product->name }}</a>
                            </h2>
                            <span class="product-type">{{ $product->type_label }}</span>
                            @if($product->short_description)
                                <p class="product-description">{{ Str::limit($product->short_description, 100) }}</p>
                            @endif
                        </div>
                    </article>
                @empty
                    <p class="no-products">No products found.</p>
                @endforelse

                {{ $products->withQueryString()->links() }}
            </main>
        </div>
    </div>
</body>
</html>
