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
     * Content is based on the actual sofoodtchad.td website.
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
     * Content based on sofoodtchad.td
     */
    private function seedSettings(): void
    {
        $this->command->info('📝 Seeding settings...');

        $settings = [
            // General Settings
            ['key' => 'site_name', 'value' => json_encode(['fr' => 'Sofoodtchad', 'en' => 'Sofoodtchad', 'ar' => 'سوفود تشاد']), 'type' => 'text', 'group' => 'general'],
            ['key' => 'site_tagline', 'value' => json_encode([
                'fr' => 'Le goût du naturel, la passion du bien-manger',
                'en' => 'The taste of natural, the passion for good eating',
                'ar' => 'طعم الطبيعة، شغف الأكل الجيد'
            ]), 'type' => 'text', 'group' => 'general'],
            ['key' => 'site_description', 'value' => json_encode([
                'fr' => 'Chez SoFood, nous croyons que bien manger commence par innover. Nous proposons des produits sains, simples et savoureux - des noix de cajou premium du Tchad.',
                'en' => 'At SoFood, we believe that eating well starts with innovation. We offer healthy, simple and tasty products - premium cashew nuts from Chad.',
                'ar' => 'في سوفود، نؤمن بأن الأكل الجيد يبدأ بالابتكار. نقدم منتجات صحية وبسيطة ولذيذة - كاجو ممتاز من تشاد.'
            ]), 'type' => 'textarea', 'group' => 'general'],
            ['key' => 'site_logo', 'value' => '/images/logo.png', 'type' => 'text', 'group' => 'general'],
            ['key' => 'site_favicon', 'value' => '/images/favicon.ico', 'type' => 'text', 'group' => 'general'],

            // Contact Settings
            ['key' => 'contact_email', 'value' => 'contact@sofoodtchad.td', 'type' => 'email', 'group' => 'contact'],
            ['key' => 'contact_phone', 'value' => '+235 66 00 00 00', 'type' => 'text', 'group' => 'contact'],
            ['key' => 'contact_whatsapp', 'value' => '+235 66 00 00 00', 'type' => 'text', 'group' => 'contact'],
            ['key' => 'contact_address', 'value' => json_encode([
                'fr' => 'N\'Djamena, Tchad',
                'en' => 'N\'Djamena, Chad',
                'ar' => 'نجامينا، تشاد'
            ]), 'type' => 'textarea', 'group' => 'contact'],
            ['key' => 'contact_working_hours', 'value' => json_encode([
                'fr' => 'Mar-Ven: 9:00 - 22:00 | Sam: 12:00 - 01:00 | Dim-Lun: Fermé',
                'en' => 'Tue-Fri: 9:00 AM - 10:00 PM | Sat: 12:00 PM - 1:00 AM | Sun-Mon: Closed',
                'ar' => 'الثلاثاء-الجمعة: 9:00 - 22:00 | السبت: 12:00 - 01:00 | الأحد-الإثنين: مغلق'
            ]), 'type' => 'text', 'group' => 'contact'],

            // Social Media
            ['key' => 'social_facebook', 'value' => 'https://facebook.com/sofoodtchad', 'type' => 'url', 'group' => 'social'],
            ['key' => 'social_instagram', 'value' => 'https://instagram.com/sofoodtchad', 'type' => 'url', 'group' => 'social'],
            ['key' => 'social_twitter', 'value' => '', 'type' => 'url', 'group' => 'social'],
            ['key' => 'social_linkedin', 'value' => '', 'type' => 'url', 'group' => 'social'],
            ['key' => 'social_youtube', 'value' => 'https://www.youtube.com/watch?v=AIUELyrO-VY', 'type' => 'url', 'group' => 'social'],
            ['key' => 'social_tiktok', 'value' => '', 'type' => 'url', 'group' => 'social'],

            // Hero Section - Multiple Slides
            ['key' => 'hero_slides', 'value' => json_encode([
                [
                    'title' => ['fr' => 'SOFOOD SOGOOD', 'en' => 'SOFOOD SOGOOD', 'ar' => 'سوفود سوجود'],
                    'subtitle' => ['fr' => 'Commence ta journée avec saveur et énergie', 'en' => 'Start your day with flavor and energy', 'ar' => 'ابدأ يومك بالنكهة والطاقة'],
                    'image' => 'https://images.unsplash.com/photo-1599599810769-bcde5a160d32?w=1920&h=1080&fit=crop',
                    'cta_text' => ['fr' => 'Découvrir nos produits', 'en' => 'Discover our products', 'ar' => 'اكتشف منتجاتنا'],
                    'cta_url' => '/products',
                    'is_active' => true,
                ],
                [
                    'title' => ['fr' => 'NOS DÉLICES', 'en' => 'OUR DELIGHTS', 'ar' => 'مأكولاتنا اللذيذة'],
                    'subtitle' => ['fr' => 'Des noix de cajou premium, naturelles et savoureuses', 'en' => 'Premium, natural and tasty cashew nuts', 'ar' => 'كاجو ممتاز طبيعي ولذيذ'],
                    'image' => 'https://images.unsplash.com/photo-1563292769-4e05b684851a?w=1920&h=1080&fit=crop',
                    'cta_text' => ['fr' => 'Contactez-nous', 'en' => 'Contact us', 'ar' => 'اتصل بنا'],
                    'cta_url' => '/contact',
                    'is_active' => true,
                ],
            ]), 'type' => 'json', 'group' => 'homepage'],

            // About Section (Homepage)
            ['key' => 'homepage_about_title', 'value' => json_encode(['fr' => 'Pourquoi nous choisir', 'en' => 'Why choose us', 'ar' => 'لماذا تختارنا']), 'type' => 'text', 'group' => 'homepage'],
            ['key' => 'homepage_about_subtitle', 'value' => json_encode(['fr' => 'À propos de SoFood', 'en' => 'About SoFood', 'ar' => 'عن سوفود']), 'type' => 'text', 'group' => 'homepage'],
            ['key' => 'homepage_about_description', 'value' => json_encode([
                'fr' => 'Chez SoFood, nous croyons que bien manger commence par innover. Guidés par notre fondateur, ingénieur passionné de technologie et d\'entrepreneuriat, nous réinventons la manière de savourer des produits naturels. SoFood s\'engage à proposer des produits sains, simples et savoureux.',
                'en' => 'At SoFood, we believe that eating well starts with innovation. Guided by our founder, an engineer passionate about technology and entrepreneurship, we are reinventing the way to enjoy natural products. SoFood is committed to offering healthy, simple and tasty products.',
                'ar' => 'في سوفود، نؤمن بأن الأكل الجيد يبدأ بالابتكار. بقيادة مؤسسنا، المهندس الشغوف بالتكنولوجيا وريادة الأعمال، نعيد ابتكار طريقة الاستمتاع بالمنتجات الطبيعية.'
            ]), 'type' => 'textarea', 'group' => 'homepage'],
            ['key' => 'homepage_about_image', 'value' => 'https://images.unsplash.com/photo-1563292769-4e05b684851a?w=800&h=600&fit=crop', 'type' => 'text', 'group' => 'homepage'],
            ['key' => 'homepage_about_cta_text', 'value' => json_encode(['fr' => 'En savoir plus', 'en' => 'Learn more', 'ar' => 'اعرف المزيد']), 'type' => 'text', 'group' => 'homepage'],
            ['key' => 'homepage_about_cta_url', 'value' => '/about', 'type' => 'text', 'group' => 'homepage'],
            ['key' => 'homepage_about_features', 'value' => json_encode([
                ['fr' => 'Innovation & Saveur', 'en' => 'Innovation & Flavor', 'ar' => 'ابتكار ونكهة'],
                ['fr' => 'Le Naturel Comme Engagement', 'en' => 'Natural as Commitment', 'ar' => 'الطبيعي كالتزام'],
                ['fr' => 'Expérience Pensée Pour Vous', 'en' => 'Experience Designed for You', 'ar' => 'تجربة مصممة لك'],
                ['fr' => 'Qualité Premium', 'en' => 'Premium Quality', 'ar' => 'جودة ممتازة'],
            ]), 'type' => 'json', 'group' => 'homepage'],

            // Products Section (Homepage)
            ['key' => 'homepage_products_title', 'value' => json_encode(['fr' => 'Nos Délices', 'en' => 'Our Delights', 'ar' => 'مأكولاتنا اللذيذة']), 'type' => 'text', 'group' => 'homepage'],
            ['key' => 'homepage_products_subtitle', 'value' => json_encode([
                'fr' => 'Découvrez notre gamme de noix de cajou premium',
                'en' => 'Discover our range of premium cashew nuts',
                'ar' => 'اكتشف مجموعتنا من الكاجو الممتاز'
            ]), 'type' => 'text', 'group' => 'homepage'],

            // Process Section (Homepage)
            ['key' => 'homepage_process_title', 'value' => json_encode(['fr' => 'Dans notre usine', 'en' => 'In our factory', 'ar' => 'في مصنعنا']), 'type' => 'text', 'group' => 'homepage'],
            ['key' => 'homepage_process_subtitle', 'value' => json_encode(['fr' => 'Production', 'en' => 'Production', 'ar' => 'الإنتاج']), 'type' => 'text', 'group' => 'homepage'],
            ['key' => 'homepage_process_description', 'value' => json_encode([
                'fr' => 'De la récolte à l\'emballage, nous assurons les normes de qualité les plus élevées',
                'en' => 'From harvest to packaging, we ensure the highest quality standards',
                'ar' => 'من الحصاد إلى التعبئة، نضمن أعلى معايير الجودة'
            ]), 'type' => 'textarea', 'group' => 'homepage'],

            // Partners Section (Homepage)
            ['key' => 'homepage_partners_title', 'value' => json_encode(['fr' => 'Nos Partenaires', 'en' => 'Our Partners', 'ar' => 'شركاؤنا']), 'type' => 'text', 'group' => 'homepage'],
            ['key' => 'homepage_partners_subtitle', 'value' => json_encode(['fr' => 'Ils nous font confiance', 'en' => 'They trust us', 'ar' => 'يثقون بنا']), 'type' => 'text', 'group' => 'homepage'],

            // Blog Section (Homepage)
            ['key' => 'homepage_blog_title', 'value' => json_encode(['fr' => 'Actualités Récentes', 'en' => 'Recent News', 'ar' => 'آخر الأخبار']), 'type' => 'text', 'group' => 'homepage'],
            ['key' => 'homepage_blog_subtitle', 'value' => json_encode(['fr' => 'Nos Blogs', 'en' => 'Our Blogs', 'ar' => 'مدوناتنا']), 'type' => 'text', 'group' => 'homepage'],

            // CTA Section (Homepage)
            ['key' => 'homepage_cta_enabled', 'value' => '1', 'type' => 'boolean', 'group' => 'homepage'],
            ['key' => 'homepage_cta_title', 'value' => json_encode([
                'fr' => 'Prêt à découvrir nos produits ?',
                'en' => 'Ready to discover our products?',
                'ar' => 'هل أنت مستعد لاكتشاف منتجاتنا؟'
            ]), 'type' => 'text', 'group' => 'homepage'],
            ['key' => 'homepage_cta_description', 'value' => json_encode([
                'fr' => 'Rejoignez notre réseau de distributeurs et apportez les produits premium de Sofoodtchad à votre marché.',
                'en' => 'Join our distributor network and bring Sofoodtchad\'s premium products to your market.',
                'ar' => 'انضم إلى شبكة موزعينا وأحضر منتجات سوفود الممتازة إلى سوقك.'
            ]), 'type' => 'textarea', 'group' => 'homepage'],
            ['key' => 'homepage_cta_primary_text', 'value' => json_encode(['fr' => 'Devenir distributeur', 'en' => 'Become a distributor', 'ar' => 'كن موزعًا']), 'type' => 'text', 'group' => 'homepage'],
            ['key' => 'homepage_cta_primary_url', 'value' => '/partners/become-distributor', 'type' => 'text', 'group' => 'homepage'],
            ['key' => 'homepage_cta_secondary_text', 'value' => json_encode(['fr' => 'Contactez-nous', 'en' => 'Contact us', 'ar' => 'اتصل بنا']), 'type' => 'text', 'group' => 'homepage'],
            ['key' => 'homepage_cta_secondary_url', 'value' => '/contact', 'type' => 'text', 'group' => 'homepage'],

            // SEO Settings
            ['key' => 'seo_meta_keywords', 'value' => 'sofoodtchad, noix de cajou, cashew nuts, chad food, african food, natural food, tchad, n\'djamena, cajou grillé, cajou torréfié', 'type' => 'textarea', 'group' => 'seo'],

            // Features
            ['key' => 'features_blog_enabled', 'value' => '1', 'type' => 'boolean', 'group' => 'features'],
            ['key' => 'features_distributor_form_enabled', 'value' => '1', 'type' => 'boolean', 'group' => 'features'],
            ['key' => 'features_contact_form_enabled', 'value' => '1', 'type' => 'boolean', 'group' => 'features'],

            // About Page Settings
            ['key' => 'about_page_title', 'value' => json_encode(['fr' => 'À propos de SoFood', 'en' => 'About SoFood', 'ar' => 'عن سوفود']), 'type' => 'text', 'group' => 'about'],
            ['key' => 'about_page_subtitle', 'value' => json_encode(['fr' => 'Qui sommes-nous', 'en' => 'Who we are', 'ar' => 'من نحن']), 'type' => 'text', 'group' => 'about'],

            // About - Why Choose Us Section
            ['key' => 'about_whyus_title', 'value' => json_encode(['fr' => 'Pourquoi nous choisir', 'en' => 'Why choose us', 'ar' => 'لماذا تختارنا']), 'type' => 'text', 'group' => 'about'],
            ['key' => 'about_whyus_features', 'value' => json_encode([
                [
                    'title' => ['fr' => 'Là où l\'innovation rencontre la saveur', 'en' => 'Where innovation meets flavor', 'ar' => 'حيث يلتقي الابتكار بالنكهة'],
                    'description' => ['fr' => 'Chez SoFood, nous croyons que bien manger commence par innover. Guidés par notre fondateur, ingénieur passionné de technologie et d\'entrepreneuriat, nous réinventons la manière de savourer des produits naturels.', 'en' => 'At SoFood, we believe that eating well starts with innovation. Guided by our founder, an engineer passionate about technology and entrepreneurship, we are reinventing the way to enjoy natural products.', 'ar' => 'في سوفود، نؤمن بأن الأكل الجيد يبدأ بالابتكار.'],
                ],
                [
                    'title' => ['fr' => 'Le naturel comme engagement', 'en' => 'Natural as commitment', 'ar' => 'الطبيعي كالتزام'],
                    'description' => ['fr' => 'SoFood s\'engage à proposer des produits sains, simples et savoureux. Nous sélectionnons avec soin chaque ingrédient pour garantir fraîcheur, qualité et traçabilité. Notre promesse : vous offrir le meilleur de la nature.', 'en' => 'SoFood is committed to offering healthy, simple and tasty products. We carefully select each ingredient to guarantee freshness, quality and traceability. Our promise: to offer you the best of nature.', 'ar' => 'تلتزم سوفود بتقديم منتجات صحية وبسيطة ولذيذة.'],
                ],
                [
                    'title' => ['fr' => 'Une expérience pensée pour vous', 'en' => 'An experience designed for you', 'ar' => 'تجربة مصممة لك'],
                    'description' => ['fr' => 'Plus qu\'un simple repas, SoFood vous invite à vivre une expérience. De la commande à la dégustation, tout est pensé pour votre confort et votre plaisir. Parce que votre satisfaction est notre priorité.', 'en' => 'More than just a meal, SoFood invites you to live an experience. From ordering to tasting, everything is designed for your comfort and pleasure. Because your satisfaction is our priority.', 'ar' => 'أكثر من مجرد وجبة، تدعوك سوفود للعيش تجربة.'],
                ],
            ]), 'type' => 'json', 'group' => 'about'],

            // About - CEO/PDG Section
            ['key' => 'about_ceo_name', 'value' => 'Mahamat Nour', 'type' => 'text', 'group' => 'about'],
            ['key' => 'about_ceo_title', 'value' => json_encode(['fr' => 'PDG', 'en' => 'CEO', 'ar' => 'الرئيس التنفيذي']), 'type' => 'text', 'group' => 'about'],
            ['key' => 'about_ceo_description', 'value' => json_encode([
                'fr' => 'À la tête de SoFood, un ingénieur passionné de technologie et d\'entrepreneuriat, qui allie innovation et goût pour offrir une expérience culinaire unique.',
                'en' => 'At the head of SoFood, an engineer passionate about technology and entrepreneurship, who combines innovation and taste to offer a unique culinary experience.',
                'ar' => 'على رأس سوفود، مهندس شغوف بالتكنولوجيا وريادة الأعمال، يجمع بين الابتكار والذوق لتقديم تجربة طهي فريدة.'
            ]), 'type' => 'textarea', 'group' => 'about'],

            // About - Mission & Vision
            ['key' => 'about_mission_title', 'value' => json_encode(['fr' => 'Notre Mission', 'en' => 'Our Mission', 'ar' => 'مهمتنا']), 'type' => 'text', 'group' => 'about'],
            ['key' => 'about_mission_description', 'value' => json_encode([
                'fr' => 'Proposer des produits naturels de qualité premium tout en soutenant les agriculteurs locaux et en promouvant des pratiques agricoles durables.',
                'en' => 'Offer premium quality natural products while supporting local farmers and promoting sustainable agricultural practices.',
                'ar' => 'تقديم منتجات طبيعية عالية الجودة مع دعم المزارعين المحليين وتعزيز الممارسات الزراعية المستدامة.'
            ]), 'type' => 'textarea', 'group' => 'about'],
            ['key' => 'about_vision_title', 'value' => json_encode(['fr' => 'Notre Vision', 'en' => 'Our Vision', 'ar' => 'رؤيتنا']), 'type' => 'text', 'group' => 'about'],
            ['key' => 'about_vision_description', 'value' => json_encode([
                'fr' => 'Devenir le leader africain des produits de noix de cajou premium, reconnu mondialement pour notre qualité, notre authenticité et notre impact positif sur les communautés locales.',
                'en' => 'Become Africa\'s leading premium cashew nut producer, recognized globally for our quality, authenticity and positive impact on local communities.',
                'ar' => 'أن نصبح الرائد الأفريقي في منتجات الكاجو الممتازة، معترف بها عالميًا لجودتنا وأصالتنا وتأثيرنا الإيجابي على المجتمعات المحلية.'
            ]), 'type' => 'textarea', 'group' => 'about'],
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

        $admin = User::updateOrCreate(
            ['email' => 'admin@sofoodtchad.td'],
            [
                'name' => 'Mahamat Nour',
                'email' => 'admin@sofoodtchad.td',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );

        User::updateOrCreate(
            ['email' => 'editor@sofoodtchad.td'],
            [
                'name' => 'Editor User',
                'email' => 'editor@sofoodtchad.td',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );
    }

    /**
     * Seed product categories.
     * Based on actual sofoodtchad.td products
     */
    private function seedCategories(): void
    {
        $this->command->info('📁 Seeding categories...');

        $categories = [
            [
                'name' => ['fr' => 'Noix de Cajou', 'en' => 'Cashew Nuts', 'ar' => 'الكاجو'],
                'slug' => 'noix-de-cajou',
                'description' => [
                    'fr' => 'Notre gamme complète de noix de cajou premium - naturelles, torréfiées et grillées.',
                    'en' => 'Our complete range of premium cashew nuts - natural, roasted and grilled.',
                    'ar' => 'مجموعتنا الكاملة من الكاجو الممتاز - طبيعي ومحمص ومشوي.'
                ],
                'image' => 'https://images.unsplash.com/photo-1563292769-4e05b684851a?w=400&h=300&fit=crop',
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'name' => ['fr' => 'Snacks Premium', 'en' => 'Premium Snacks', 'ar' => 'وجبات خفيفة ممتازة'],
                'slug' => 'snacks-premium',
                'description' => [
                    'fr' => 'Des encas sains et savoureux pour tous les moments de la journée.',
                    'en' => 'Healthy and tasty snacks for all times of the day.',
                    'ar' => 'وجبات خفيفة صحية ولذيذة لجميع أوقات اليوم.'
                ],
                'image' => 'https://images.unsplash.com/photo-1599599810769-bcde5a160d32?w=400&h=300&fit=crop',
                'is_active' => true,
                'sort_order' => 2,
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
     * Seed products based on actual sofoodtchad.td offerings.
     */
    private function seedProducts(): void
    {
        $this->command->info('🥜 Seeding products...');

        $cashewCategory = Category::where('slug', 'noix-de-cajou')->first();
        $snacksCategory = Category::where('slug', 'snacks-premium')->first();

        $products = [
            // Noix de Cajou Grillées
            [
                'category_id' => $cashewCategory?->id,
                'name' => [
                    'fr' => 'Noix de Cajou Grillées',
                    'en' => 'Roasted Cashew Nuts',
                    'ar' => 'كاجو مشوي'
                ],
                'slug' => 'noix-de-cajou-grillees',
                'description' => [
                    'fr' => 'Craquez pour nos noix de cajou grillées à la perfection ! Croquantes et savoureuses, elles sont idéales pour une pause gourmande pleine de caractère. Un encas riche en goût et en énergie, sans compromis. Savourez la douceur naturellement beurrée des noix de cajou, délicatement grillées pour révéler tout leur croquant et leur arôme. Parfaites pour vos pauses gourmandes ou en accompagnement à l\'apéritif, elles sont à la fois saines, riches en bons lipides, et irrésistiblement savoureuses.',
                    'en' => 'Treat yourself to our perfectly roasted cashew nuts! Crunchy and tasty, they are ideal for a gourmet break full of character. A snack rich in taste and energy, without compromise. Enjoy the naturally buttery sweetness of cashew nuts, delicately roasted to reveal all their crunch and aroma. Perfect for your gourmet breaks or as an appetizer, they are both healthy, rich in good fats, and irresistibly tasty.',
                    'ar' => 'استمتع بالكاجو المشوي لدينا بشكل مثالي! مقرمش ولذيذ، مثالي لاستراحة ذواقة مليئة بالشخصية. وجبة خفيفة غنية بالطعم والطاقة، بدون تنازل.'
                ],
                'short_description' => [
                    'fr' => 'Noix de cajou grillées à la perfection, croquantes et savoureuses.',
                    'en' => 'Perfectly roasted cashew nuts, crunchy and tasty.',
                    'ar' => 'كاجو مشوي بشكل مثالي، مقرمش ولذيذ.'
                ],
                'type' => 'roasted',
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 1,
                'price' => 3500,
                'sku' => 'CAJ-GRI-001',
                'image' => 'https://images.unsplash.com/photo-1563292769-4e05b684851a?w=500&h=500&fit=crop',
                'sizes' => [
                    ['name' => 'Small', 'value' => '150g', 'price_adjustment' => 0, 'is_default' => true, 'sort_order' => 1],
                    ['name' => 'Medium', 'value' => '300g', 'price_adjustment' => 2500, 'is_default' => false, 'sort_order' => 2],
                    ['name' => 'Large', 'value' => '500g', 'price_adjustment' => 5000, 'is_default' => false, 'sort_order' => 3],
                ],
            ],
            // Noix de Cajou Torréfiées
            [
                'category_id' => $cashewCategory?->id,
                'name' => [
                    'fr' => 'Noix de Cajou Torréfiées',
                    'en' => 'Toasted Cashew Nuts',
                    'ar' => 'كاجو محمص'
                ],
                'slug' => 'noix-de-cajou-torrefiees',
                'description' => [
                    'fr' => 'Nos noix de cajou torréfiées révèlent un arôme subtil et une texture dorée irrésistible. Torréfiées lentement pour préserver toutes leurs qualités, elles offrent un parfait équilibre entre croquant et douceur. Des noix de cajou soigneusement sélectionnées et lentement torréfiées pour une saveur intense et une texture croquante à souhait. Sans additifs, elles offrent un encas sain, savoureux et plein d\'énergie, idéal à tout moment de la journée.',
                    'en' => 'Our toasted cashew nuts reveal a subtle aroma and an irresistible golden texture. Slowly toasted to preserve all their qualities, they offer a perfect balance between crunch and sweetness. Carefully selected and slowly toasted cashew nuts for an intense flavor and a crunchy texture. Without additives, they offer a healthy, tasty and energizing snack, ideal at any time of the day.',
                    'ar' => 'يكشف الكاجو المحمص لدينا عن رائحة خفية وملمس ذهبي لا يقاوم. محمص ببطء للحفاظ على جميع صفاته، يقدم توازنًا مثاليًا بين القرمشة والنعومة.'
                ],
                'short_description' => [
                    'fr' => 'Noix de cajou torréfiées lentement pour un arôme subtil et une texture dorée.',
                    'en' => 'Slowly toasted cashew nuts for a subtle aroma and golden texture.',
                    'ar' => 'كاجو محمص ببطء لرائحة خفية وملمس ذهبي.'
                ],
                'type' => 'roasted',
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 2,
                'price' => 3500,
                'sku' => 'CAJ-TOR-001',
                'image' => 'https://images.unsplash.com/photo-1599599810769-bcde5a160d32?w=500&h=500&fit=crop',
                'sizes' => [
                    ['name' => 'Small', 'value' => '150g', 'price_adjustment' => 0, 'is_default' => true, 'sort_order' => 1],
                    ['name' => 'Medium', 'value' => '300g', 'price_adjustment' => 2500, 'is_default' => false, 'sort_order' => 2],
                    ['name' => 'Large', 'value' => '500g', 'price_adjustment' => 5000, 'is_default' => false, 'sort_order' => 3],
                ],
            ],
            // Noix de Cajou Naturelles
            [
                'category_id' => $cashewCategory?->id,
                'name' => [
                    'fr' => 'Noix de Cajou Naturelles',
                    'en' => 'Natural Cashew Nuts',
                    'ar' => 'كاجو طبيعي'
                ],
                'slug' => 'noix-de-cajou-naturelles',
                'description' => [
                    'fr' => 'La noix de cajou naturelle est un en-cas sain et savoureux, riche en nutriments essentiels. Non salée, non grillée, elle conserve toutes ses propriétés d\'origine : magnésium, fer, bonnes graisses et protéines. C\'est un choix idéal pour ceux qui recherchent un aliment pur, non transformé, parfait pour booster l\'énergie au quotidien. Pures et non transformées, nos noix de cajou naturelles conservent toute leur richesse nutritionnelle. Douces, fondantes et sans sel ajouté, elles sont parfaites pour une collation saine, la cuisine ou vos recettes maison. Un goût authentique, tout simplement naturel.',
                    'en' => 'Natural cashew nut is a healthy and tasty snack, rich in essential nutrients. Unsalted, unroasted, it retains all its original properties: magnesium, iron, good fats and proteins. It is an ideal choice for those looking for a pure, unprocessed food, perfect for boosting daily energy. Pure and unprocessed, our natural cashew nuts retain all their nutritional richness. Soft, melting and without added salt, they are perfect for a healthy snack, cooking or your homemade recipes. An authentic taste, simply natural.',
                    'ar' => 'الكاجو الطبيعي هو وجبة خفيفة صحية ولذيذة، غنية بالعناصر الغذائية الأساسية. غير مملح وغير محمص، يحتفظ بجميع خصائصه الأصلية.'
                ],
                'short_description' => [
                    'fr' => 'Un trésor brut de la nature - noix de cajou pures et non transformées.',
                    'en' => 'A raw treasure of nature - pure and unprocessed cashew nuts.',
                    'ar' => 'كنز طبيعي خام - كاجو نقي وغير معالج.'
                ],
                'type' => 'natural',
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 3,
                'price' => 3000,
                'sku' => 'CAJ-NAT-001',
                'image' => 'https://images.unsplash.com/photo-1509042239860-f550ce710b93?w=500&h=500&fit=crop',
                'sizes' => [
                    ['name' => 'Small', 'value' => '150g', 'price_adjustment' => 0, 'is_default' => true, 'sort_order' => 1],
                    ['name' => 'Medium', 'value' => '300g', 'price_adjustment' => 2000, 'is_default' => false, 'sort_order' => 2],
                    ['name' => 'Large', 'value' => '500g', 'price_adjustment' => 4500, 'is_default' => false, 'sort_order' => 3],
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
                        'alt_text' => is_string($product->name) ? $product->name : json_decode($product->name, true)['fr'] ?? 'Product',
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
     * Seed process steps based on sofoodtchad production.
     */
    private function seedProcessSteps(): void
    {
        $this->command->info('⚙️ Seeding process steps...');

        $steps = [
            [
                'title' => ['fr' => 'Sélection', 'en' => 'Selection', 'ar' => 'الاختيار'],
                'description' => [
                    'fr' => 'Nous sélectionnons avec soin chaque ingrédient pour garantir fraîcheur, qualité et traçabilité. Seules les meilleures noix de cajou sont retenues.',
                    'en' => 'We carefully select each ingredient to guarantee freshness, quality and traceability. Only the best cashew nuts are retained.',
                    'ar' => 'نختار بعناية كل مكون لضمان النضارة والجودة وإمكانية التتبع.'
                ],
                'icon' => 'leaf',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'title' => ['fr' => 'Transformation', 'en' => 'Processing', 'ar' => 'المعالجة'],
                'description' => [
                    'fr' => 'Dans notre usine, nous utilisons des équipements modernes combinés aux techniques traditionnelles pour préserver toutes les qualités de nos noix de cajou.',
                    'en' => 'In our factory, we use modern equipment combined with traditional techniques to preserve all the qualities of our cashew nuts.',
                    'ar' => 'في مصنعنا، نستخدم معدات حديثة مع تقنيات تقليدية للحفاظ على جميع صفات الكاجو.'
                ],
                'icon' => 'cog',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'title' => ['fr' => 'Contrôle Qualité', 'en' => 'Quality Control', 'ar' => 'مراقبة الجودة'],
                'description' => [
                    'fr' => 'Chaque lot est rigoureusement testé pour garantir une qualité constante qui répond aux normes internationales de sécurité alimentaire.',
                    'en' => 'Each batch is rigorously tested to ensure consistent quality that meets international food safety standards.',
                    'ar' => 'يتم اختبار كل دفعة بدقة لضمان جودة متسقة تلبي معايير السلامة الغذائية الدولية.'
                ],
                'icon' => 'shield-check',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'title' => ['fr' => 'Emballage & Livraison', 'en' => 'Packaging & Delivery', 'ar' => 'التعبئة والتوصيل'],
                'description' => [
                    'fr' => 'Nos produits sont soigneusement emballés pour préserver leur fraîcheur et leur qualité jusqu\'à votre table.',
                    'en' => 'Our products are carefully packaged to preserve their freshness and quality until they reach your table.',
                    'ar' => 'يتم تعبئة منتجاتنا بعناية للحفاظ على نضارتها وجودتها حتى تصل إلى طاولتك.'
                ],
                'icon' => 'truck',
                'sort_order' => 4,
                'is_active' => true,
            ],
        ];

        foreach ($steps as $step) {
            ProcessStep::updateOrCreate(
                ['sort_order' => $step['sort_order']],
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
                'name' => 'Carrefour N\'Djamena',
                'description' => [
                    'fr' => 'Chaîne de supermarchés leader au Tchad',
                    'en' => 'Leading supermarket chain in Chad',
                    'ar' => 'سلسلة سوبر ماركت رائدة في تشاد'
                ],
                'website' => 'https://www.carrefour.com',
                'type' => 'distributor',
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'African Food Export',
                'description' => [
                    'fr' => 'Partenaire d\'exportation pour les marchés internationaux',
                    'en' => 'Export partner for international markets',
                    'ar' => 'شريك تصدير للأسواق الدولية'
                ],
                'website' => null,
                'type' => 'partner',
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'Sahel Distribution',
                'description' => [
                    'fr' => 'Partenaire de distribution régionale',
                    'en' => 'Regional distribution partner',
                    'ar' => 'شريك التوزيع الإقليمي'
                ],
                'website' => null,
                'type' => 'distributor',
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 3,
            ],
            [
                'name' => 'Fermes Bio Tchad',
                'description' => [
                    'fr' => 'Fournisseur de noix de cajou biologiques',
                    'en' => 'Organic cashew nut supplier',
                    'ar' => 'مورد الكاجو العضوي'
                ],
                'website' => null,
                'type' => 'supplier',
                'is_featured' => false,
                'is_active' => true,
                'sort_order' => 4,
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
     * Seed blog posts based on actual sofoodtchad.td blog.
     */
    private function seedPosts(): void
    {
        $this->command->info('📰 Seeding blog posts...');

        $adminUser = User::where('email', 'admin@sofoodtchad.td')->first();

        $posts = [
            [
                'user_id' => $adminUser?->id ?? 1,
                'title' => [
                    'fr' => '🍃 Noix de Cajou Naturelles : La pureté à l\'état brut',
                    'en' => '🍃 Natural Cashew Nuts: Purity in its raw state',
                    'ar' => '🍃 الكاجو الطبيعي: النقاء في حالته الخام'
                ],
                'slug' => 'noix-de-cajou-naturelles-la-purete-a-letat-brut',
                'excerpt' => [
                    'fr' => 'À la recherche de produits bruts, sans transformation ? Nos noix de cajou naturelles conservent toute leur richesse nutritionnelle.',
                    'en' => 'Looking for raw, unprocessed products? Our natural cashew nuts retain all their nutritional richness.',
                    'ar' => 'هل تبحث عن منتجات خام غير معالجة؟ يحتفظ الكاجو الطبيعي لدينا بكل غناه الغذائي.'
                ],
                'content' => [
                    'fr' => "À la recherche de produits bruts, sans transformation ? Nos noix de cajou naturelles conservent toute leur richesse nutritionnelle.\n\n**Un trésor brut de la nature**\n\nLa noix de cajou naturelle est un en-cas sain et savoureux, riche en nutriments essentiels. Non salée, non grillée, elle conserve toutes ses propriétés d'origine : magnésium, fer, bonnes graisses et protéines.\n\n**Bienfaits nutritionnels**\n\n- Riche en magnésium pour la santé des os\n- Source de protéines végétales\n- Bonnes graisses pour le cœur\n- Sans additifs ni conservateurs\n\n**Utilisation**\n\nParfaites pour une collation saine, la cuisine ou vos recettes maison. Un goût authentique, tout simplement naturel.\n\nDécouvrez nos noix de cajou naturelles chez SoFood - le goût du naturel, la passion du bien-manger.",
                    'en' => "Looking for raw, unprocessed products? Our natural cashew nuts retain all their nutritional richness.\n\n**A raw treasure of nature**\n\nNatural cashew nut is a healthy and tasty snack, rich in essential nutrients. Unsalted, unroasted, it retains all its original properties: magnesium, iron, good fats and proteins.\n\n**Nutritional benefits**\n\n- Rich in magnesium for bone health\n- Source of plant proteins\n- Good fats for the heart\n- Without additives or preservatives\n\n**Usage**\n\nPerfect for a healthy snack, cooking or your homemade recipes. An authentic taste, simply natural.\n\nDiscover our natural cashew nuts at SoFood - the taste of natural, the passion for good eating.",
                    'ar' => "هل تبحث عن منتجات خام غير معالجة؟ يحتفظ الكاجو الطبيعي لدينا بكل غناه الغذائي."
                ],
                'featured_image' => 'https://images.unsplash.com/photo-1509042239860-f550ce710b93?w=800&h=500&fit=crop',
                'type' => 'blog',
                'status' => 'published',
                'published_at' => now()->setDate(2025, 7, 4),
            ],
            [
                'user_id' => $adminUser?->id ?? 1,
                'title' => [
                    'fr' => '🔥 Noix de Cajou Torréfiées : Le juste équilibre',
                    'en' => '🔥 Toasted Cashew Nuts: The right balance',
                    'ar' => '🔥 الكاجو المحمص: التوازن الصحيح'
                ],
                'slug' => 'noix-de-cajou-torrefiees-le-juste-equilibre',
                'excerpt' => [
                    'fr' => 'Nos noix de cajou torréfiées révèlent un arôme subtil et une texture dorée irrésistible.',
                    'en' => 'Our toasted cashew nuts reveal a subtle aroma and an irresistible golden texture.',
                    'ar' => 'يكشف الكاجو المحمص لدينا عن رائحة خفية وملمس ذهبي لا يقاوم.'
                ],
                'content' => [
                    'fr' => "Nos noix de cajou torréfiées révèlent un arôme subtil et une texture dorée irrésistible.\n\n**Le plaisir authentique**\n\nTorréfiées lentement pour préserver toutes leurs qualités, elles offrent un parfait équilibre entre croquant et douceur.\n\n**Caractéristiques**\n\n- Arôme subtil et raffiné\n- Texture dorée et croquante\n- Sans additifs\n- Saveur intense\n\n**Moment idéal**\n\nUn encas sain, savoureux et plein d'énergie, idéal à tout moment de la journée.\n\nDécouvrez le goût authentique chez SoFood.",
                    'en' => "Our toasted cashew nuts reveal a subtle aroma and an irresistible golden texture.\n\n**Authentic pleasure**\n\nSlowly toasted to preserve all their qualities, they offer a perfect balance between crunch and sweetness.\n\n**Features**\n\n- Subtle and refined aroma\n- Golden and crunchy texture\n- Without additives\n- Intense flavor\n\n**Ideal moment**\n\nA healthy, tasty and energizing snack, ideal at any time of the day.\n\nDiscover the authentic taste at SoFood.",
                    'ar' => "يكشف الكاجو المحمص لدينا عن رائحة خفية وملمس ذهبي لا يقاوم."
                ],
                'featured_image' => 'https://images.unsplash.com/photo-1599599810769-bcde5a160d32?w=800&h=500&fit=crop',
                'type' => 'blog',
                'status' => 'published',
                'published_at' => now()->setDate(2025, 7, 4),
            ],
            [
                'user_id' => $adminUser?->id ?? 1,
                'title' => [
                    'fr' => '🥜 Noix de Cajou Grillées : Une explosion de saveurs',
                    'en' => '🥜 Roasted Cashew Nuts: An explosion of flavors',
                    'ar' => '🥜 الكاجو المشوي: انفجار من النكهات'
                ],
                'slug' => 'noix-de-cajou-grillees-une-explosion-de-saveurs',
                'excerpt' => [
                    'fr' => 'Craquez pour nos noix de cajou grillées à la perfection ! Croquantes et savoureuses.',
                    'en' => 'Treat yourself to our perfectly roasted cashew nuts! Crunchy and tasty.',
                    'ar' => 'استمتع بالكاجو المشوي لدينا بشكل مثالي! مقرمش ولذيذ.'
                ],
                'content' => [
                    'fr' => "Craquez pour nos noix de cajou grillées à la perfection !\n\n**L'intensité du goût**\n\nCroquantes et savoureuses, elles sont idéales pour une pause gourmande pleine de caractère. Un encas riche en goût et en énergie, sans compromis.\n\n**Pourquoi les choisir ?**\n\n- Grillées à la perfection\n- Croquantes et savoureuses\n- Riches en bons lipides\n- Parfaites pour l'apéritif\n\n**Le goût SoFood**\n\nSavourez la douceur naturellement beurrée des noix de cajou, délicatement grillées pour révéler tout leur croquant et leur arôme.\n\nDécouvrez l'intensité du goût chez SoFood - SOFOOD SOGOOD !",
                    'en' => "Treat yourself to our perfectly roasted cashew nuts!\n\n**The intensity of taste**\n\nCrunchy and tasty, they are ideal for a gourmet break full of character. A snack rich in taste and energy, without compromise.\n\n**Why choose them?**\n\n- Perfectly roasted\n- Crunchy and tasty\n- Rich in good fats\n- Perfect for appetizers\n\n**The SoFood taste**\n\nEnjoy the naturally buttery sweetness of cashew nuts, delicately roasted to reveal all their crunch and aroma.\n\nDiscover the intensity of taste at SoFood - SOFOOD SOGOOD!",
                    'ar' => "استمتع بالكاجو المشوي لدينا بشكل مثالي!"
                ],
                'featured_image' => 'https://images.unsplash.com/photo-1563292769-4e05b684851a?w=800&h=500&fit=crop',
                'type' => 'blog',
                'status' => 'published',
                'published_at' => now()->setDate(2025, 7, 4),
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
