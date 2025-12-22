<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductsController extends Controller
{
    /**
     * Display listing of products.
     */
    public function index(Request $request): View
    {
        $query = Product::with(['category', 'images'])->active();

        // Filter by category
        if ($request->filled('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        // Filter by type
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        $products = $query->ordered()->paginate(12);
        $categories = Category::active()->ordered()->withCount('products')->get();
        $types = Product::getTypes();

        return view('products.index', compact('products', 'categories', 'types'));
    }

    /**
     * Display a single product.
     */
    public function show(string $slug): View
    {
        $product = Product::with(['category', 'images', 'sizes'])
            ->where('slug', $slug)
            ->active()
            ->firstOrFail();

        // Get related products from same category
        $relatedProducts = Product::with('images')
            ->where('id', '!=', $product->id)
            ->where('category_id', $product->category_id)
            ->active()
            ->ordered()
            ->limit(4)
            ->get();

        return view('products.show', compact('product', 'relatedProducts'));
    }

    /**
     * Display products by category.
     */
    public function category(string $slug): View
    {
        $category = Category::where('slug', $slug)->active()->firstOrFail();

        $products = Product::with('images')
            ->where('category_id', $category->id)
            ->active()
            ->ordered()
            ->paginate(12);

        $categories = Category::active()->ordered()->withCount('products')->get();
        $types = Product::getTypes();

        return view('products.index', compact('products', 'categories', 'types', 'category'));
    }
}
