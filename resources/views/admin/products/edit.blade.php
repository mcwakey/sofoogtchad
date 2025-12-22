@extends('admin.layouts.app')

@section('title', 'Edit Product: ' . $product->name)

@section('page-header')
    <h1>Edit Product: {{ $product->name }}</h1>
@endsection

@section('content')
    <div class="product-editor">
        {{-- Product Details --}}
        <section class="product-details">
            <h2>Product Details</h2>
            <form method="POST" action="{{ route('admin.products.update', $product) }}">
                @csrf
                @method('PUT')

                <div class="form-row">
                    <div class="form-group">
                        <label for="name">Name *</label>
                        <input type="text" id="name" name="name" value="{{ old('name', $product->name) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="slug">Slug *</label>
                        <input type="text" id="slug" name="slug" value="{{ old('slug', $product->slug) }}" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="category_id">Category</label>
                        <select id="category_id" name="category_id">
                            <option value="">No Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="type">Type *</label>
                        <select id="type" name="type" required>
                            @foreach($types as $value => $label)
                                <option value="{{ $value }}" {{ old('type', $product->type) === $value ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="short_description">Short Description</label>
                    <textarea id="short_description" name="short_description" rows="2">{{ old('short_description', $product->short_description) }}</textarea>
                </div>

                <div class="form-group">
                    <label for="description">Full Description</label>
                    <textarea id="description" name="description" rows="6">{{ old('description', $product->description) }}</textarea>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="sku">SKU</label>
                        <input type="text" id="sku" name="sku" value="{{ old('sku', $product->sku) }}">
                    </div>

                    <div class="form-group">
                        <label for="sort_order">Sort Order</label>
                        <input type="number" id="sort_order" name="sort_order" value="{{ old('sort_order', $product->sort_order) }}" min="0">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>
                            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $product->is_active) ? 'checked' : '' }}>
                            Active
                        </label>
                    </div>

                    <div class="form-group">
                        <label>
                            <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $product->is_featured) ? 'checked' : '' }}>
                            Featured
                        </label>
                    </div>
                </div>

                <button type="submit">Update Product</button>
                <a href="{{ route('admin.products.index') }}">Back to Products</a>
            </form>
        </section>

        {{-- Product Images --}}
        <section class="product-images">
            <h2>Product Images</h2>

            @if($product->images->count() > 0)
                <div class="images-list">
                    @foreach($product->images as $image)
                        <div class="image-item">
                            <img src="{{ $image->image_path }}" alt="{{ $image->alt_text }}" style="width:100px;height:100px;object-fit:cover;">
                            <div class="image-info">
                                @if($image->is_primary)
                                    <span class="badge badge-success">Primary</span>
                                @endif
                            </div>
                            <form action="{{ route('admin.products.images.destroy', [$product, $image]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Delete this image?')">Delete</button>
                            </form>
                        </div>
                    @endforeach
                </div>
            @else
                <p>No images yet.</p>
            @endif

            <h3>Add Image</h3>
            <form method="POST" action="{{ route('admin.products.images.store', $product) }}">
                @csrf
                <div class="form-group">
                    <label for="image_path">Image URL *</label>
                    <input type="text" id="image_path" name="image_path" required>
                </div>
                <div class="form-group">
                    <label for="alt_text">Alt Text</label>
                    <input type="text" id="alt_text" name="alt_text">
                </div>
                <div class="form-group">
                    <label>
                        <input type="checkbox" name="is_primary" value="1">
                        Set as primary image
                    </label>
                </div>
                <button type="submit">Add Image</button>
            </form>
        </section>

        {{-- Product Sizes --}}
        <section class="product-sizes">
            <h2>Product Sizes (Future Ready)</h2>

            @if($product->sizes->count() > 0)
                <div class="sizes-list">
                    @foreach($product->sizes as $size)
                        <div class="size-item">
                            <span>{{ $size->name }}</span>
                            @if($size->value)
                                <span>({{ $size->value }})</span>
                            @endif
                            @if($size->price_adjustment != 0)
                                <span>{{ $size->price_adjustment > 0 ? '+' : '' }}{{ $size->price_adjustment }}</span>
                            @endif
                            @if($size->is_default)
                                <span class="badge badge-success">Default</span>
                            @endif
                            <form action="{{ route('admin.products.sizes.destroy', [$product, $size]) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Delete this size?')">Delete</button>
                            </form>
                        </div>
                    @endforeach
                </div>
            @else
                <p>No sizes configured.</p>
            @endif

            <h3>Add Size</h3>
            <form method="POST" action="{{ route('admin.products.sizes.store', $product) }}">
                @csrf
                <div class="form-row">
                    <div class="form-group">
                        <label for="size_name">Size Name *</label>
                        <input type="text" id="size_name" name="name" placeholder="e.g., Small, 500g" required>
                    </div>
                    <div class="form-group">
                        <label for="size_value">Value</label>
                        <input type="text" id="size_value" name="value" placeholder="e.g., 500">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="price_adjustment">Price Adjustment</label>
                        <input type="number" id="price_adjustment" name="price_adjustment" value="0" step="0.01">
                    </div>
                    <div class="form-group">
                        <label>
                            <input type="checkbox" name="is_default" value="1">
                            Default size
                        </label>
                    </div>
                </div>
                <button type="submit">Add Size</button>
            </form>
        </section>
    </div>
@endsection
