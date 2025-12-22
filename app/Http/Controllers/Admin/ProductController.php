<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|unique:products,slug',
            'category_id' => 'nullable|exists:categories,id',
            'description' => 'nullable|string',
            'short_description' => 'nullable|string|max:500',
            'type' => 'required|in:natural,roasted,grilled',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer',
            'price' => 'nullable|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0',
            'sku' => 'nullable|string|unique:products,sku',
            'stock_quantity' => 'nullable|integer|min:0',
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_active'] = $request->has('is_active');

        $product = Product::create($validated);

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
    public function update(Request $request, Product $product): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|unique:products,slug,' . $product->id,
            'category_id' => 'nullable|exists:categories,id',
            'description' => 'nullable|string',
            'short_description' => 'nullable|string|max:500',
            'type' => 'required|in:natural,roasted,grilled',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer',
            'price' => 'nullable|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0',
            'sku' => 'nullable|string|unique:products,sku,' . $product->id,
            'stock_quantity' => 'nullable|integer|min:0',
        ]);

        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_active'] = $request->has('is_active');

        $product->update($validated);

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
