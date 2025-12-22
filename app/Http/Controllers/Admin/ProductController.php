<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreProductRequest;
use App\Http\Requests\Admin\UpdateProductRequest;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductImage;
use App\Models\ProductSize;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of products.
     */
    public function index(Request $request): View
    {
        $query = Product::with('category', 'images');

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // Filter by type
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('is_active', $request->status === 'active');
        }

        $products = $query->ordered()->paginate(15);
        $categories = Category::ordered()->get();
        $types = Product::getTypes();

        return view('admin.products.index', compact('products', 'categories', 'types'));
    }

    /**
     * Show the form for creating a new product.
     */
    public function create(): View
    {
        $categories = Category::active()->ordered()->get();
        $types = Product::getTypes();
        return view('admin.products.create', compact('categories', 'types'));
    }

    /**
     * Store a newly created product.
     */
    public function store(StoreProductRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        // Generate slug from French name
        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name']['fr']);
        }

        $product = Product::create([
            'category_id' => $validated['category_id'] ?? null,
            'slug' => $validated['slug'],
            'type' => $validated['type'],
            'price' => $validated['price'] ?? null,
            'sale_price' => $validated['sale_price'] ?? null,
            'sku' => $validated['sku'] ?? null,
            'stock_quantity' => $validated['stock_quantity'] ?? null,
            'sort_order' => $validated['sort_order'] ?? 0,
            'is_featured' => $validated['is_featured'] ?? false,
            'is_active' => $validated['is_active'] ?? true,
        ]);

        // Set translations
        foreach (['fr', 'en', 'ar'] as $locale) {
            if (!empty($validated['name'][$locale])) {
                $product->setTranslation('name', $locale, $validated['name'][$locale]);
            }
            if (!empty($validated['description'][$locale])) {
                $product->setTranslation('description', $locale, $validated['description'][$locale]);
            }
            if (!empty($validated['short_description'][$locale])) {
                $product->setTranslation('short_description', $locale, $validated['short_description'][$locale]);
            }
        }
        $product->save();

        return redirect()->route('admin.products.edit', $product)
            ->with('success', 'Product created. Now add images.');
    }

    /**
     * Display the specified product.
     */
    public function show(Product $product): View
    {
        $product->load(['category', 'images', 'sizes']);
        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified product.
     */
    public function edit(Product $product): View
    {
        $product->load(['images', 'sizes']);
        $categories = Category::active()->ordered()->get();
        $types = Product::getTypes();
        return view('admin.products.edit', compact('product', 'categories', 'types'));
    }

    /**
     * Update the specified product.
     */
    public function update(UpdateProductRequest $request, Product $product): RedirectResponse
    {
        $validated = $request->validated();

        $product->update([
            'category_id' => $validated['category_id'] ?? null,
            'slug' => $validated['slug'],
            'type' => $validated['type'],
            'price' => $validated['price'] ?? null,
            'sale_price' => $validated['sale_price'] ?? null,
            'sku' => $validated['sku'] ?? null,
            'stock_quantity' => $validated['stock_quantity'] ?? null,
            'sort_order' => $validated['sort_order'] ?? 0,
            'is_featured' => $validated['is_featured'] ?? false,
            'is_active' => $validated['is_active'] ?? true,
        ]);

        // Set translations
        foreach (['fr', 'en', 'ar'] as $locale) {
            $product->setTranslation('name', $locale, $validated['name'][$locale] ?? null);
            $product->setTranslation('description', $locale, $validated['description'][$locale] ?? null);
            $product->setTranslation('short_description', $locale, $validated['short_description'][$locale] ?? null);
        }
        $product->save();

        return redirect()->route('admin.products.edit', $product)
            ->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified product.
     */
    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'Product deleted successfully.');
    }

    /**
     * Add image to product.
     */
    public function addImage(Request $request, Product $product): RedirectResponse
    {
        $validated = $request->validate([
            'image_path' => 'required|string|max:500',
            'alt_text' => 'nullable|string|max:255',
            'is_primary' => 'boolean',
        ]);

        $validated['product_id'] = $product->id;
        $validated['is_primary'] = $request->has('is_primary');
        $validated['sort_order'] = $product->images()->max('sort_order') + 1;

        $image = ProductImage::create($validated);

        // If marked as primary, unset others
        if ($validated['is_primary']) {
            $image->setAsPrimary();
        }

        return redirect()->route('admin.products.edit', $product)
            ->with('success', 'Image added successfully.');
    }

    /**
     * Delete image from product.
     */
    public function deleteImage(Product $product, ProductImage $image): RedirectResponse
    {
        $image->delete();

        return redirect()->route('admin.products.edit', $product)
            ->with('success', 'Image deleted successfully.');
    }

    /**
     * Add size to product.
     */
    public function addSize(Request $request, Product $product): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'value' => 'nullable|string|max:255',
            'price_adjustment' => 'nullable|numeric',
            'is_default' => 'boolean',
        ]);

        $validated['product_id'] = $product->id;
        $validated['is_default'] = $request->has('is_default');
        $validated['sort_order'] = $product->sizes()->max('sort_order') + 1;

        $size = ProductSize::create($validated);

        if ($validated['is_default']) {
            $size->setAsDefault();
        }

        return redirect()->route('admin.products.edit', $product)
            ->with('success', 'Size added successfully.');
    }

    /**
     * Delete size from product.
     */
    public function deleteSize(Product $product, ProductSize $size): RedirectResponse
    {
        $size->delete();

        return redirect()->route('admin.products.edit', $product)
            ->with('success', 'Size deleted successfully.');
    }
}
