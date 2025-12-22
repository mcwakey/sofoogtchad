<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use App\Models\Post;
use App\Models\ProcessStep;
use App\Models\Product;
use App\Models\Page;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display the home page with all dynamic content.
     */
    public function index()
    {
        // Get the home page data if it exists
        $homePage = Page::where('slug', 'home')->with('sections')->first();

        // Hero Section Data
        $hero = $this->getHeroData($homePage);

        // About Section Data
        $about = $this->getAboutData($homePage);

        // Featured Products (active, featured, limited to 6)
        $products = Product::with('images')
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->limit(6)
            ->get()
            ->map(function ($product) {
                return [
                    'name' => $product->name,
                    'description' => $product->short_description ?? $product->description,
                    'image' => $product->imageUrl ?? '/images/placeholder-product.jpg',
                    'price' => $product->price,
                    'url' => route('products.show', $product->slug),
                    'badge' => $product->badge ?? null,
                ];
            })->toArray();

        $productsSection = [
            'title' => setting('homepage_products_title', 'Our Products'),
            'subtitle' => setting('homepage_products_subtitle', 'Discover our range of premium quality products'),
            'view_all_url' => route('products.index'),
            'view_all_text' => 'View All Products',
            'columns' => 4,
        ];

        // Process Steps (active, limited to 4)
        $processSteps = ProcessStep::where('is_active', true)
            ->orderBy('sort_order')
            ->limit(4)
            ->get();

        $processSection = [
            'title' => setting('homepage_process_title', 'Our Process'),
            'subtitle' => setting('homepage_process_subtitle', 'Quality & Excellence'),
            'description' => setting('homepage_process_description', 'How we ensure the highest quality in every product'),
            'cta_text' => 'Learn More',
            'cta_url' => route('pages.show', 'about'),
        ];

        // Partners (active, limited to 6)
        $partners = Partner::where('is_active', true)
            ->orderBy('sort_order')
            ->limit(6)
            ->get();

        $partnersSection = [
            'title' => setting('homepage_partners_title', 'Our Partners'),
            'subtitle' => setting('homepage_partners_subtitle', 'Trusted By'),
            'description' => setting('homepage_partners_description', 'We work with the best in the industry'),
            'cta_text' => 'Become a Partner',
            'cta_url' => route('distributor.request'),
        ];

        // Latest Blog Posts (published, limited to 3)
        $posts = Post::where('status', 'published')
            ->orderBy('published_at', 'desc')
            ->limit(3)
            ->get();

        $blogSection = [
            'title' => setting('homepage_blog_title', 'Latest News'),
            'subtitle' => setting('homepage_blog_subtitle', 'From Our Blog'),
            'view_all_url' => route('blog.index'),
            'view_all_text' => 'View All Posts',
        ];

        // CTA Section
        $cta = $this->getCtaData();

        return view('home', compact(
            'hero',
            'about',
            'products',
            'productsSection',
            'processSteps',
            'processSection',
            'partners',
            'partnersSection',
            'posts',
            'blogSection',
            'cta'
        ));
    }

    /**
     * Get hero section data from page or settings.
     */
    private function getHeroData(?Page $page): array
    {
        $heroSection = $page?->sections->where('identifier', 'hero')->first();

        return [
            'background_image' => $heroSection?->image ?? setting('hero_background_image', '/images/hero-bg.jpg'),
            'title' => $heroSection?->title ?? setting('hero_title', setting('site_name', 'Sofoodtchad')),
            'subtitle' => $heroSection?->content ?? setting('hero_subtitle', setting('site_tagline', 'Premium Quality Food Products')),
            'cta_text' => $heroSection?->cta_text ?? setting('hero_cta_text', 'View Our Products'),
            'cta_url' => $heroSection?->cta_url ?? setting('hero_cta_url', '/products'),
            'secondary_cta_text' => setting('hero_secondary_cta_text'),
            'secondary_cta_url' => setting('hero_secondary_cta_url'),
        ];
    }

    /**
     * Get about section data from page or settings.
     * Returns null if no data exists in the database.
     */
    private function getAboutData(?Page $page): ?array
    {
        $aboutSection = $page?->sections->where('identifier', 'about')->first();

        // Check if we have any about data in the database
        $title = $aboutSection?->title ?? setting('homepage_about_title');
        $subtitle = setting('homepage_about_subtitle');
        $description = $aboutSection?->content ?? setting('homepage_about_description');
        $image = $aboutSection?->image ?? setting('homepage_about_image');

        // If no essential data exists in database, return null to hide the section
        if (empty($title) && empty($description)) {
            return null;
        }

        // Get features from settings (stored as JSON)
        $featuresValue = setting('homepage_about_features');
        $features = [];

        if (is_array($featuresValue)) {
            $features = $featuresValue;
        } elseif (is_string($featuresValue) && !empty($featuresValue)) {
            $features = json_decode($featuresValue, true) ?? [];
        }

        return [
            'title' => $title,
            'subtitle' => $subtitle,
            'description' => $description,
            'image' => $image,
            'image_position' => setting('homepage_about_image_position', 'left'),
            'cta_text' => setting('homepage_about_cta_text'),
            'cta_url' => setting('homepage_about_cta_url'),
            'features' => $features,
        ];
    }

    /**
     * Get CTA section data from settings.
     */
    private function getCtaData(): ?array
    {
        if (!setting('homepage_cta_enabled', true)) {
            return null;
        }

        return [
            'title' => setting('homepage_cta_title', 'Ready to Experience Quality?'),
            'description' => setting('homepage_cta_description', 'Contact us today to learn more about our products and services.'),
            'primary_text' => setting('homepage_cta_primary_text', 'Contact Us'),
            'primary_url' => setting('homepage_cta_primary_url', '/contact'),
            'secondary_text' => setting('homepage_cta_secondary_text', 'View Products'),
            'secondary_url' => setting('homepage_cta_secondary_url', '/products'),
        ];
    }
}
