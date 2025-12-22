<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Partner;
use App\Models\Post;
use App\Models\ProcessStep;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductSize;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DemoContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * This seeder creates demo content for showcasing the Sofoodtchad website.
     */
    public function run(): void
    {
        $this->command->info('🌱 Starting Demo Content Seeder...');

        $this->seedSettings();
        $this->seedUsers();
        $this->seedCategories();
        $this->seedProducts();
        $this->seedProcessSteps();
        $this->seedPartners();
        $this->seedPosts();

        $this->command->info('✅ Demo content seeded successfully!');
    }

    /**
     * Seed site settings including homepage content.
     */
    private function seedSettings(): void
    {
        $this->command->info('📝 Seeding settings...');

        $settings = [
            // General Settings
            ['key' => 'site_name', 'value' => 'Sofoodtchad', 'type' => 'text', 'group' => 'general'],
            ['key' => 'site_tagline', 'value' => 'Premium Quality Food Products from Chad', 'type' => 'text', 'group' => 'general'],
            ['key' => 'site_description', 'value' => 'Sofoodtchad is Chad\'s leading food company, specializing in premium quality peanut products, natural oils, and traditional foods. We bring the authentic taste of Chad to your table.', 'type' => 'textarea', 'group' => 'general'],
            ['key' => 'site_logo', 'value' => '/images/logo.png', 'type' => 'text', 'group' => 'general'],
            ['key' => 'site_favicon', 'value' => '/images/favicon.ico', 'type' => 'text', 'group' => 'general'],

            // Contact Settings
            ['key' => 'contact_email', 'value' => 'contact@sofoodtchad.com', 'type' => 'email', 'group' => 'contact'],
            ['key' => 'contact_phone', 'value' => '+235 66 00 00 00', 'type' => 'text', 'group' => 'contact'],
            ['key' => 'contact_whatsapp', 'value' => '+235 66 00 00 00', 'type' => 'text', 'group' => 'contact'],
            ['key' => 'contact_address', 'value' => 'Avenue Charles de Gaulle, N\'Djamena, Chad', 'type' => 'textarea', 'group' => 'contact'],
            ['key' => 'contact_working_hours', 'value' => 'Mon - Fri: 8:00 AM - 6:00 PM | Sat: 9:00 AM - 2:00 PM', 'type' => 'text', 'group' => 'contact'],

            // Social Media
            ['key' => 'social_facebook', 'value' => 'https://facebook.com/sofoodtchad', 'type' => 'url', 'group' => 'social'],
            ['key' => 'social_instagram', 'value' => 'https://instagram.com/sofoodtchad', 'type' => 'url', 'group' => 'social'],
            ['key' => 'social_twitter', 'value' => 'https://twitter.com/sofoodtchad', 'type' => 'url', 'group' => 'social'],
            ['key' => 'social_linkedin', 'value' => 'https://linkedin.com/company/sofoodtchad', 'type' => 'url', 'group' => 'social'],
            ['key' => 'social_youtube', 'value' => '', 'type' => 'url', 'group' => 'social'],
            ['key' => 'social_tiktok', 'value' => '', 'type' => 'url', 'group' => 'social'],

            // Hero Section
            ['key' => 'hero_background_image', 'value' => 'https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=1920&h=1080&fit=crop', 'type' => 'text', 'group' => 'homepage'],
            ['key' => 'hero_title', 'value' => 'Taste the Authentic Flavors of Chad', 'type' => 'text', 'group' => 'homepage'],
            ['key' => 'hero_subtitle', 'value' => 'Premium quality peanut products, natural oils, and traditional foods crafted with care and passion.', 'type' => 'textarea', 'group' => 'homepage'],
            ['key' => 'hero_cta_text', 'value' => 'Explore Our Products', 'type' => 'text', 'group' => 'homepage'],
            ['key' => 'hero_cta_url', 'value' => '/products', 'type' => 'text', 'group' => 'homepage'],
            ['key' => 'hero_secondary_cta_text', 'value' => 'Contact Us', 'type' => 'text', 'group' => 'homepage'],
            ['key' => 'hero_secondary_cta_url', 'value' => '/contact', 'type' => 'text', 'group' => 'homepage'],

            // About Section (Homepage)
            ['key' => 'homepage_about_title', 'value' => 'Our Story', 'type' => 'text', 'group' => 'homepage'],
            ['key' => 'homepage_about_subtitle', 'value' => 'About Sofoodtchad', 'type' => 'text', 'group' => 'homepage'],
            ['key' => 'homepage_about_description', 'value' => 'Founded with a vision to bring the rich culinary heritage of Chad to the world, Sofoodtchad has grown from a small family business into one of the region\'s most trusted food producers. We source the finest peanuts from local farmers, process them using traditional methods enhanced by modern quality standards, and deliver products that capture the authentic taste of our homeland. Every product we create carries our commitment to quality, sustainability, and community development.', 'type' => 'textarea', 'group' => 'homepage'],
            ['key' => 'homepage_about_image', 'value' => 'https://images.unsplash.com/photo-1606787366850-de6330128bfc?w=800&h=600&fit=crop', 'type' => 'text', 'group' => 'homepage'],
            ['key' => 'homepage_about_cta_text', 'value' => 'Learn More About Us', 'type' => 'text', 'group' => 'homepage'],
            ['key' => 'homepage_about_cta_url', 'value' => '/about', 'type' => 'text', 'group' => 'homepage'],
            ['key' => 'homepage_about_features', 'value' => json_encode(['Premium Quality', '100% Natural', 'Local Production', 'Trusted Brand']), 'type' => 'json', 'group' => 'homepage'],

            // Products Section (Homepage)
            ['key' => 'homepage_products_title', 'value' => 'Our Products', 'type' => 'text', 'group' => 'homepage'],
            ['key' => 'homepage_products_subtitle', 'value' => 'Discover our range of premium quality food products, crafted with the finest ingredients', 'type' => 'text', 'group' => 'homepage'],

            // Process Section (Homepage)
            ['key' => 'homepage_process_title', 'value' => 'Our Quality Process', 'type' => 'text', 'group' => 'homepage'],
            ['key' => 'homepage_process_subtitle', 'value' => 'Quality & Excellence', 'type' => 'text', 'group' => 'homepage'],
            ['key' => 'homepage_process_description', 'value' => 'From farm to table, we ensure the highest quality standards at every step', 'type' => 'textarea', 'group' => 'homepage'],

            // Partners Section (Homepage)
            ['key' => 'homepage_partners_title', 'value' => 'Our Partners', 'type' => 'text', 'group' => 'homepage'],
            ['key' => 'homepage_partners_subtitle', 'value' => 'Trusted By Industry Leaders', 'type' => 'text', 'group' => 'homepage'],
            ['key' => 'homepage_partners_description', 'value' => 'We\'re proud to work with leading retailers, distributors, and organizations across Chad and beyond', 'type' => 'textarea', 'group' => 'homepage'],

            // Blog Section (Homepage)
            ['key' => 'homepage_blog_title', 'value' => 'Latest News & Updates', 'type' => 'text', 'group' => 'homepage'],
            ['key' => 'homepage_blog_subtitle', 'value' => 'From Our Blog', 'type' => 'text', 'group' => 'homepage'],

            // CTA Section (Homepage)
            ['key' => 'homepage_cta_enabled', 'value' => '1', 'type' => 'boolean', 'group' => 'homepage'],
            ['key' => 'homepage_cta_title', 'value' => 'Ready to Partner with Us?', 'type' => 'text', 'group' => 'homepage'],
            ['key' => 'homepage_cta_description', 'value' => 'Join our growing network of distributors and bring Sofoodtchad\'s premium products to your market. We offer competitive pricing, reliable supply, and dedicated support.', 'type' => 'textarea', 'group' => 'homepage'],
            ['key' => 'homepage_cta_primary_text', 'value' => 'Become a Distributor', 'type' => 'text', 'group' => 'homepage'],
            ['key' => 'homepage_cta_primary_url', 'value' => '/partners/become-distributor', 'type' => 'text', 'group' => 'homepage'],
            ['key' => 'homepage_cta_secondary_text', 'value' => 'Contact Sales', 'type' => 'text', 'group' => 'homepage'],
            ['key' => 'homepage_cta_secondary_url', 'value' => '/contact', 'type' => 'text', 'group' => 'homepage'],

            // SEO Settings
            ['key' => 'seo_meta_keywords', 'value' => 'sofoodtchad, peanut butter, chad food, african food, peanut oil, natural food, organic food, tchad, n\'djamena', 'type' => 'textarea', 'group' => 'seo'],

            // Features
            ['key' => 'features_blog_enabled', 'value' => '1', 'type' => 'boolean', 'group' => 'features'],
            ['key' => 'features_distributor_form_enabled', 'value' => '1', 'type' => 'boolean', 'group' => 'features'],
            ['key' => 'features_contact_form_enabled', 'value' => '1', 'type' => 'boolean', 'group' => 'features'],

            // About Page Settings
            ['key' => 'about_page_title', 'value' => 'About Sofoodtchad', 'type' => 'text', 'group' => 'about'],
            ['key' => 'about_page_subtitle', 'value' => 'Who We Are', 'type' => 'text', 'group' => 'about'],
            ['key' => 'about_page_description', 'value' => 'Learn about our journey, mission, and commitment to bringing you the finest food products from Chad.', 'type' => 'textarea', 'group' => 'about'],

            // About - Our Story Section
            ['key' => 'about_story_title', 'value' => 'Our Story', 'type' => 'text', 'group' => 'about'],
            ['key' => 'about_story_subtitle', 'value' => 'How It All Began', 'type' => 'text', 'group' => 'about'],
            ['key' => 'about_story_description', 'value' => 'Sofoodtchad was founded in 2015 with a simple vision: to share the authentic flavors of Chad with the world. What started as a small family operation processing peanuts using traditional methods has grown into one of Chad\'s most respected food companies. Our founder, inspired by generations of family recipes and a passion for quality, set out to create products that honor our culinary heritage while meeting modern food safety standards. Today, we continue that legacy, working directly with local farmers and communities to bring you the finest products.', 'type' => 'textarea', 'group' => 'about'],
            ['key' => 'about_story_image', 'value' => 'https://images.unsplash.com/photo-1542838132-92c53300491e?w=800&h=600&fit=crop', 'type' => 'text', 'group' => 'about'],

            // About - What We Do Section
            ['key' => 'about_whatwedo_title', 'value' => 'What We Do', 'type' => 'text', 'group' => 'about'],
            ['key' => 'about_whatwedo_subtitle', 'value' => 'Our Business', 'type' => 'text', 'group' => 'about'],
            ['key' => 'about_whatwedo_description', 'value' => 'We specialize in producing premium quality peanut-based products, natural oils, and traditional Chadian foods. From our state-of-the-art processing facility in N\'Djamena, we transform locally sourced ingredients into products that grace tables across Chad and beyond. Our product range includes creamy and crunchy peanut butters, cold-pressed peanut oil, roasted peanuts, and a variety of traditional snacks and condiments.', 'type' => 'textarea', 'group' => 'about'],
            ['key' => 'about_whatwedo_image', 'value' => 'https://images.unsplash.com/photo-1606787366850-de6330128bfc?w=800&h=600&fit=crop', 'type' => 'text', 'group' => 'about'],
            ['key' => 'about_whatwedo_features', 'value' => json_encode(['Premium Peanut Butter', 'Cold-Pressed Oils', 'Traditional Snacks', 'Wholesale Distribution']), 'type' => 'json', 'group' => 'about'],

            // About - Why Choose Us Section
            ['key' => 'about_whyus_title', 'value' => 'Why Choose Sofoodtchad', 'type' => 'text', 'group' => 'about'],
            ['key' => 'about_whyus_subtitle', 'value' => 'Our Difference', 'type' => 'text', 'group' => 'about'],
            ['key' => 'about_whyus_description', 'value' => 'What sets us apart is our unwavering commitment to quality at every step. We source directly from local farmers, ensuring fair prices and sustainable practices. Our production processes combine time-honored traditions with modern food safety standards. Every product is tested and certified before it reaches you. When you choose Sofoodtchad, you\'re not just buying food – you\'re supporting local communities and preserving culinary traditions.', 'type' => 'textarea', 'group' => 'about'],
            ['key' => 'about_whyus_image', 'value' => 'https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?w=800&h=600&fit=crop', 'type' => 'text', 'group' => 'about'],
            ['key' => 'about_whyus_features', 'value' => json_encode(['100% Natural Ingredients', 'Direct Farmer Partnerships', 'Quality Certified', 'Sustainable Practices']), 'type' => 'json', 'group' => 'about'],
            ['key' => 'about_whyus_cta_text', 'value' => 'View Our Products', 'type' => 'text', 'group' => 'about'],
            ['key' => 'about_whyus_cta_url', 'value' => '/products', 'type' => 'text', 'group' => 'about'],

            // About - Mission & Vision
            ['key' => 'about_mission_title', 'value' => 'Our Mission', 'type' => 'text', 'group' => 'about'],
            ['key' => 'about_mission_description', 'value' => 'To produce and deliver the highest quality food products that celebrate Chad\'s rich culinary heritage, while supporting local farmers, creating employment opportunities, and promoting sustainable agricultural practices.', 'type' => 'textarea', 'group' => 'about'],
            ['key' => 'about_vision_title', 'value' => 'Our Vision', 'type' => 'text', 'group' => 'about'],
            ['key' => 'about_vision_description', 'value' => 'To become Africa\'s leading producer of premium peanut products and traditional foods, recognized globally for our quality, authenticity, and positive impact on local communities.', 'type' => 'textarea', 'group' => 'about'],

            // About - Values
            ['key' => 'about_values', 'value' => json_encode([
                ['title' => 'Quality', 'icon' => null],
                ['title' => 'Integrity', 'icon' => null],
                ['title' => 'Community', 'icon' => null],
                ['title' => 'Innovation', 'icon' => null],
            ]), 'type' => 'json', 'group' => 'about'],

            // About - CTA
            ['key' => 'about_cta_title', 'value' => 'Ready to Experience Our Products?', 'type' => 'text', 'group' => 'about'],
            ['key' => 'about_cta_description', 'value' => 'Discover the authentic taste of Chad with our premium range of peanut products and traditional foods.', 'type' => 'textarea', 'group' => 'about'],
            ['key' => 'about_cta_primary_text', 'value' => 'Shop Now', 'type' => 'text', 'group' => 'about'],
            ['key' => 'about_cta_primary_url', 'value' => '/products', 'type' => 'text', 'group' => 'about'],
            ['key' => 'about_cta_secondary_text', 'value' => 'Contact Us', 'type' => 'text', 'group' => 'about'],
            ['key' => 'about_cta_secondary_url', 'value' => '/contact', 'type' => 'text', 'group' => 'about'],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
    }

    /**
     * Seed demo users.
     */
    private function seedUsers(): void
    {
        $this->command->info('👤 Seeding users...');

        User::updateOrCreate(
            ['email' => 'admin@sofoodtchad.com'],
            [
                'name' => 'Admin User',
                'email' => 'admin@sofoodtchad.com',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );

        User::updateOrCreate(
            ['email' => 'editor@sofoodtchad.com'],
            [
                'name' => 'Editor User',
                'email' => 'editor@sofoodtchad.com',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );
    }

    /**
     * Seed product categories.
     */
    private function seedCategories(): void
    {
        $this->command->info('📁 Seeding categories...');

        $categories = [
            [
                'name' => 'Peanut Products',
                'slug' => 'peanut-products',
                'description' => 'Premium quality peanut-based products including peanut butter, roasted peanuts, and peanut oil.',
                'image' => 'https://images.unsplash.com/photo-1567892320421-1c657571ea4a?w=400&h=300&fit=crop',
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'Natural Oils',
                'slug' => 'natural-oils',
                'description' => 'Pure, cold-pressed oils extracted from the finest nuts and seeds.',
                'image' => 'https://images.unsplash.com/photo-1474979266404-7eaacbcd87c5?w=400&h=300&fit=crop',
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'Traditional Foods',
                'slug' => 'traditional-foods',
                'description' => 'Authentic Chadian traditional food products made with time-honored recipes.',
                'image' => 'https://images.unsplash.com/photo-1606787366850-de6330128bfc?w=400&h=300&fit=crop',
                'is_active' => true,
                'sort_order' => 3,
            ],
            [
                'name' => 'Snacks',
                'slug' => 'snacks',
                'description' => 'Healthy and delicious snacks perfect for any time of day.',
                'image' => 'https://images.unsplash.com/photo-1599599810769-bcde5a160d32?w=400&h=300&fit=crop',
                'is_active' => true,
                'sort_order' => 4,
            ],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(
                ['slug' => $category['slug']],
                $category
            );
        }
    }

    /**
     * Seed products.
     */
    private function seedProducts(): void
    {
        $this->command->info('🥜 Seeding products...');

        $peanutCategory = Category::where('slug', 'peanut-products')->first();
        $oilCategory = Category::where('slug', 'natural-oils')->first();
        $traditionalCategory = Category::where('slug', 'traditional-foods')->first();
        $snacksCategory = Category::where('slug', 'snacks')->first();

        $products = [
            // Peanut Products
            [
                'category_id' => $peanutCategory?->id,
                'name' => 'Classic Peanut Butter',
                'slug' => 'classic-peanut-butter',
                'description' => 'Our signature creamy peanut butter made from 100% roasted Chadian peanuts. No additives, no preservatives - just pure, natural goodness. Perfect for spreading on bread, adding to smoothies, or cooking your favorite recipes.',
                'short_description' => 'Creamy, all-natural peanut butter made from premium Chadian peanuts.',
                'type' => 'natural',
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 1,
                'price' => 2500,
                'sku' => 'PB-001',
                'image' => 'https://images.unsplash.com/photo-1598511726623-d2e9996892f0?w=500&h=500&fit=crop',
                'sizes' => [
                    ['name' => 'Small', 'value' => '250g', 'price_adjustment' => 0, 'is_default' => true, 'sort_order' => 1],
                    ['name' => 'Medium', 'value' => '500g', 'price_adjustment' => 2000, 'is_default' => false, 'sort_order' => 2],
                    ['name' => 'Large', 'value' => '1kg', 'price_adjustment' => 5500, 'is_default' => false, 'sort_order' => 3],
                ],
            ],
            [
                'category_id' => $peanutCategory?->id,
                'name' => 'Crunchy Peanut Butter',
                'slug' => 'crunchy-peanut-butter',
                'description' => 'For those who love a bit of texture! Our crunchy peanut butter features the same great taste as our classic, with added peanut pieces for that satisfying crunch.',
                'short_description' => 'Delicious crunchy peanut butter with real peanut pieces.',
                'type' => 'natural',
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 2,
                'price' => 2700,
                'sku' => 'PB-002',
                'image' => 'https://images.unsplash.com/photo-1595424061446-ed7b530f90c7?w=500&h=500&fit=crop',
                'sizes' => [
                    ['name' => 'Small', 'value' => '250g', 'price_adjustment' => 0, 'is_default' => true, 'sort_order' => 1],
                    ['name' => 'Medium', 'value' => '500g', 'price_adjustment' => 2100, 'is_default' => false, 'sort_order' => 2],
                ],
            ],
            [
                'category_id' => $peanutCategory?->id,
                'name' => 'Roasted Peanuts',
                'slug' => 'roasted-peanuts',
                'description' => 'Premium quality roasted peanuts, carefully selected and perfectly roasted to bring out their natural flavor. Lightly salted for the perfect snack.',
                'short_description' => 'Perfectly roasted and lightly salted premium peanuts.',
                'type' => 'roasted',
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 3,
                'price' => 1500,
                'sku' => 'RP-001',
                'image' => 'https://images.unsplash.com/photo-1567892320421-1c657571ea4a?w=500&h=500&fit=crop',
                'sizes' => [
                    ['name' => 'Small', 'value' => '200g', 'price_adjustment' => 0, 'is_default' => true, 'sort_order' => 1],
                    ['name' => 'Large', 'value' => '500g', 'price_adjustment' => 2000, 'is_default' => false, 'sort_order' => 2],
                ],
            ],
            // Natural Oils
            [
                'category_id' => $oilCategory?->id,
                'name' => 'Pure Peanut Oil',
                'slug' => 'pure-peanut-oil',
                'description' => 'Cold-pressed peanut oil extracted from the finest Chadian peanuts. Ideal for cooking, frying, and adding a subtle nutty flavor to your dishes. High smoke point makes it perfect for high-temperature cooking.',
                'short_description' => 'Premium cold-pressed peanut oil for cooking and frying.',
                'type' => 'natural',
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 4,
                'price' => 5000,
                'sku' => 'OL-001',
                'image' => 'https://images.unsplash.com/photo-1474979266404-7eaacbcd87c5?w=500&h=500&fit=crop',
                'sizes' => [
                    ['name' => 'Small', 'value' => '500ml', 'price_adjustment' => 0, 'is_default' => true, 'sort_order' => 1],
                    ['name' => 'Large', 'value' => '1L', 'price_adjustment' => 4000, 'is_default' => false, 'sort_order' => 2],
                    ['name' => 'Bulk', 'value' => '5L', 'price_adjustment' => 35000, 'is_default' => false, 'sort_order' => 3],
                ],
            ],
            [
                'category_id' => $oilCategory?->id,
                'name' => 'Sesame Oil',
                'slug' => 'sesame-oil',
                'description' => 'Premium sesame oil with rich, nutty aroma. Perfect for Asian cuisine, salad dressings, and marinades. Adds authentic flavor to any dish.',
                'short_description' => 'Rich, aromatic sesame oil for cooking and flavoring.',
                'type' => 'natural',
                'is_featured' => false,
                'is_active' => true,
                'sort_order' => 5,
                'price' => 6000,
                'sku' => 'OL-002',
                'image' => 'https://images.unsplash.com/photo-1612540284561-1c2f5f2dc903?w=500&h=500&fit=crop',
                'sizes' => [
                    ['name' => 'Standard', 'value' => '250ml', 'price_adjustment' => 0, 'is_default' => true, 'sort_order' => 1],
                ],
            ],
            // Snacks
            [
                'category_id' => $snacksCategory?->id,
                'name' => 'Honey Roasted Peanuts',
                'slug' => 'honey-roasted-peanuts',
                'description' => 'Sweet and savory honey roasted peanuts. The perfect balance of natural honey sweetness and roasted peanut flavor. An irresistible snack for any occasion.',
                'short_description' => 'Sweet and savory honey-coated roasted peanuts.',
                'type' => 'roasted',
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 6,
                'price' => 2000,
                'sku' => 'SN-001',
                'image' => 'https://images.unsplash.com/photo-1599599810769-bcde5a160d32?w=500&h=500&fit=crop',
                'sizes' => [
                    ['name' => 'Pack', 'value' => '150g', 'price_adjustment' => 0, 'is_default' => true, 'sort_order' => 1],
                    ['name' => 'Family', 'value' => '350g', 'price_adjustment' => 2000, 'is_default' => false, 'sort_order' => 2],
                ],
            ],
        ];

        foreach ($products as $productData) {
            $sizes = $productData['sizes'] ?? [];
            $imageUrl = $productData['image'] ?? null;
            unset($productData['sizes'], $productData['image']);

            $product = Product::updateOrCreate(
                ['slug' => $productData['slug']],
                $productData
            );

            // Add product image
            if ($imageUrl) {
                ProductImage::updateOrCreate(
                    ['product_id' => $product->id, 'is_primary' => true],
                    [
                        'product_id' => $product->id,
                        'image_path' => $imageUrl,
                        'alt_text' => $product->name,
                        'is_primary' => true,
                        'sort_order' => 1,
                    ]
                );
            }

            // Add product sizes
            foreach ($sizes as $size) {
                ProductSize::updateOrCreate(
                    ['product_id' => $product->id, 'name' => $size['name']],
                    array_merge($size, ['product_id' => $product->id])
                );
            }
        }
    }

    /**
     * Seed process steps.
     */
    private function seedProcessSteps(): void
    {
        $this->command->info('⚙️ Seeding process steps...');

        $steps = [
            [
                'title' => 'Sourcing',
                'description' => 'We partner directly with local farmers across Chad to source the finest quality peanuts. Our rigorous selection process ensures only the best raw materials make it to our facility.',
                'icon' => 'leaf',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Processing',
                'description' => 'Using state-of-the-art equipment combined with traditional techniques, we roast and process our peanuts to perfection, preserving their natural flavor and nutritional value.',
                'icon' => 'cog',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'Quality Control',
                'description' => 'Every batch undergoes strict quality testing. From raw material inspection to final product testing, we ensure consistent quality that meets international food safety standards.',
                'icon' => 'shield-check',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'title' => 'Packaging & Delivery',
                'description' => 'Our products are carefully packaged to maintain freshness and quality. We work with trusted logistics partners to ensure timely delivery to retailers and customers.',
                'icon' => 'truck',
                'sort_order' => 4,
                'is_active' => true,
            ],
        ];

        foreach ($steps as $step) {
            ProcessStep::updateOrCreate(
                ['title' => $step['title']],
                $step
            );
        }
    }

    /**
     * Seed partners.
     */
    private function seedPartners(): void
    {
        $this->command->info('🤝 Seeding partners...');

        $partners = [
            [
                'name' => 'Carrefour Chad',
                'description' => 'Leading supermarket chain in Chad',
                'website' => 'https://www.carrefour.com',
                'type' => 'distributor',
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'Super U N\'Djamena',
                'description' => 'Premium supermarket in the capital',
                'website' => 'https://www.superu.com',
                'type' => 'distributor',
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'Chad Food Export',
                'description' => 'Export partner for international markets',
                'website' => null,
                'type' => 'partner',
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 3,
            ],
            [
                'name' => 'Africa Foods Distribution',
                'description' => 'Regional distribution partner',
                'website' => null,
                'type' => 'distributor',
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 4,
            ],
            [
                'name' => 'Sahel Organic Farms',
                'description' => 'Organic peanut supplier',
                'website' => null,
                'type' => 'supplier',
                'is_featured' => false,
                'is_active' => true,
                'sort_order' => 5,
            ],
            [
                'name' => 'Green Market Co.',
                'description' => 'Eco-friendly retailer partnership',
                'website' => null,
                'type' => 'partner',
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 6,
            ],
        ];

        foreach ($partners as $partner) {
            Partner::updateOrCreate(
                ['name' => $partner['name']],
                $partner
            );
        }
    }

    /**
     * Seed blog posts.
     */
    private function seedPosts(): void
    {
        $this->command->info('📰 Seeding blog posts...');

        $adminUser = User::where('email', 'admin@sofoodtchad.com')->first();

        $posts = [
            [
                'user_id' => $adminUser?->id ?? 1,
                'title' => 'The Health Benefits of Peanuts: Why You Should Include Them in Your Diet',
                'slug' => 'health-benefits-of-peanuts',
                'excerpt' => 'Discover the amazing health benefits of peanuts and why they should be a staple in your daily diet. From heart health to weight management, peanuts pack a powerful nutritional punch.',
                'content' => "Peanuts are more than just a tasty snack – they're a nutritional powerhouse that offers numerous health benefits. Here's why you should consider including more peanuts in your diet:\n\n**Heart Health**\nPeanuts are rich in monounsaturated fats, the same type of fat found in olive oil. These healthy fats have been shown to reduce the risk of cardiovascular disease.\n\n**Protein Powerhouse**\nWith about 7 grams of protein per ounce, peanuts are an excellent source of plant-based protein, making them perfect for vegetarians and vegans.\n\n**Rich in Antioxidants**\nPeanuts contain resveratrol, the same antioxidant found in red wine, which may help protect against cancer and heart disease.\n\n**Weight Management**\nDespite being calorie-dense, studies show that peanut consumption is associated with lower body weight and reduced risk of obesity.\n\n**Blood Sugar Control**\nPeanuts have a low glycemic index and can help manage blood sugar levels, making them a smart choice for diabetics.\n\nAt Sofoodtchad, we're proud to bring you the finest quality peanut products that let you enjoy all these benefits in delicious form.",
                'featured_image' => 'https://images.unsplash.com/photo-1567892320421-1c657571ea4a?w=800&h=500&fit=crop',
                'type' => 'blog',
                'status' => 'published',
                'published_at' => now()->subDays(5),
            ],
            [
                'user_id' => $adminUser?->id ?? 1,
                'title' => 'Sofoodtchad Expands Distribution Network Across Central Africa',
                'slug' => 'sofoodtchad-expands-distribution',
                'excerpt' => 'We are excited to announce the expansion of our distribution network to reach more customers across Central Africa, bringing premium Chadian food products to new markets.',
                'content' => "We are thrilled to announce a major milestone in Sofoodtchad's growth journey – the expansion of our distribution network across Central Africa.\n\n**New Markets**\nStarting this month, our products will be available in Cameroon, Nigeria, and the Central African Republic, in addition to our strong presence in Chad.\n\n**Partnership Growth**\nThis expansion is made possible through new partnerships with leading retailers and distributors in the region. We've signed agreements with major supermarket chains and specialty food stores.\n\n**Product Availability**\nAll our popular products, including Classic Peanut Butter, Crunchy Peanut Butter, and Pure Peanut Oil, will be available in these new markets.\n\n**Quality Commitment**\nDespite the expansion, we remain committed to our quality standards. Every product reaching our customers undergoes the same rigorous quality control process.\n\n**Looking Ahead**\nThis is just the beginning. We have ambitious plans to continue expanding while supporting local farmers and communities across the region.\n\nThank you for your continued support as we grow together!",
                'featured_image' => 'https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?w=800&h=500&fit=crop',
                'type' => 'news',
                'status' => 'published',
                'published_at' => now()->subDays(2),
            ],
            [
                'user_id' => $adminUser?->id ?? 1,
                'title' => '5 Delicious Recipes Using Sofoodtchad Peanut Butter',
                'slug' => 'recipes-using-peanut-butter',
                'excerpt' => 'Looking for creative ways to use peanut butter? Here are five delicious recipes that will transform your meals and snacks using Sofoodtchad\'s premium peanut butter.',
                'content' => "Peanut butter isn't just for sandwiches! Here are five creative and delicious ways to use Sofoodtchad's premium peanut butter:\n\n**1. African Peanut Soup**\nA rich, creamy soup that combines peanut butter with tomatoes, sweet potatoes, and warming spices. Perfect for cold evenings.\n\n**2. Peanut Butter Smoothie Bowl**\nBlend peanut butter with banana, milk, and a touch of honey for a nutritious breakfast bowl. Top with fresh fruits and granola.\n\n**3. Peanut Sauce for Satay**\nMix peanut butter with soy sauce, lime juice, and garlic for an authentic satay sauce. Perfect for grilled chicken or tofu.\n\n**4. Peanut Butter Energy Balls**\nCombine peanut butter, oats, honey, and chocolate chips for no-bake energy balls. Great for snacking on the go.\n\n**5. Peanut Butter Banana Toast**\nUpgrade your morning toast with a generous spread of peanut butter, sliced bananas, and a drizzle of honey.\n\nTry these recipes with Sofoodtchad's Classic or Crunchy Peanut Butter and discover new favorite meals!",
                'featured_image' => 'https://images.unsplash.com/photo-1598511726623-d2e9996892f0?w=800&h=500&fit=crop',
                'type' => 'blog',
                'status' => 'published',
                'published_at' => now()->subDays(10),
            ],
        ];

        foreach ($posts as $post) {
            Post::updateOrCreate(
                ['slug' => $post['slug']],
                $post
            );
        }
    }
}
