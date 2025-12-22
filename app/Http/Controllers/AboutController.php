<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\View\View;

class AboutController extends Controller
{
    /**
     * Display the about page with dynamic content.
     */
    public function index(): View
    {
        // Try to get the about page from database
        $page = Page::with('sections')
            ->where('slug', 'about')
            ->published()
            ->first();

        // Page header data
        $pageTitle = $page?->title ?? setting('about_page_title', 'About Us');
        $pageSubtitle = setting('about_page_subtitle', 'Who We Are');
        $pageDescription = $page?->meta_description ?? setting('about_page_description', 'Learn about our journey, mission, and commitment to quality.');

        // About sections from database or settings
        $aboutSections = $this->getAboutSections($page);

        // Mission & Vision
        $mission = $this->getMission();
        $vision = $this->getVision();
        $values = $this->getValues();

        // Optional team section
        $team = $this->getTeamMembers();

        // Optional history/timeline
        $history = $this->getHistory();

        // CTA section
        $cta = $this->getCtaData();

        return view('pages.about', compact(
            'pageTitle',
            'pageSubtitle',
            'pageDescription',
            'aboutSections',
            'mission',
            'vision',
            'values',
            'team',
            'history',
            'cta'
        ));
    }

    /**
     * Get about sections from database or settings.
     */
    private function getAboutSections(?Page $page): array
    {
        $sections = [];

        // Try to get sections from page
        if ($page && $page->sections->count() > 0) {
            foreach ($page->sections as $section) {
                if ($section->identifier !== 'hero') {
                    $sections[] = [
                        'title' => $section->title,
                        'subtitle' => $section->subtitle ?? null,
                        'description' => $section->content,
                        'image' => $section->image,
                        'features' => $section->features ?? [],
                        'cta_text' => $section->cta_text ?? null,
                        'cta_url' => $section->cta_url ?? null,
                    ];
                }
            }
        }

        // If no sections from database, check settings
        if (empty($sections)) {
            // Section 1: Our Story
            $storyTitle = setting('about_story_title');
            $storyDescription = setting('about_story_description');

            if ($storyTitle || $storyDescription) {
                $sections[] = [
                    'title' => $storyTitle ?? 'Our Story',
                    'subtitle' => setting('about_story_subtitle', 'How It All Began'),
                    'description' => $storyDescription,
                    'image' => setting('about_story_image'),
                    'features' => [],
                ];
            }

            // Section 2: What We Do
            $whatWeDoTitle = setting('about_whatwedo_title');
            $whatWeDoDescription = setting('about_whatwedo_description');

            if ($whatWeDoTitle || $whatWeDoDescription) {
                $sections[] = [
                    'title' => $whatWeDoTitle ?? 'What We Do',
                    'subtitle' => setting('about_whatwedo_subtitle', 'Our Business'),
                    'description' => $whatWeDoDescription,
                    'image' => setting('about_whatwedo_image'),
                    'features' => $this->parseJsonSetting('about_whatwedo_features', []),
                ];
            }

            // Section 3: Why Choose Us
            $whyUsTitle = setting('about_whyus_title');
            $whyUsDescription = setting('about_whyus_description');

            if ($whyUsTitle || $whyUsDescription) {
                $sections[] = [
                    'title' => $whyUsTitle ?? 'Why Choose Us',
                    'subtitle' => setting('about_whyus_subtitle', 'Our Difference'),
                    'description' => $whyUsDescription,
                    'image' => setting('about_whyus_image'),
                    'features' => $this->parseJsonSetting('about_whyus_features', []),
                    'cta_text' => setting('about_whyus_cta_text', 'View Our Products'),
                    'cta_url' => setting('about_whyus_cta_url', '/products'),
                ];
            }
        }

        // If still empty, provide default sections
        if (empty($sections)) {
            $sections = $this->getDefaultAboutSections();
        }

        return $sections;
    }

    /**
     * Get default about sections when no database or settings content exists.
     */
    private function getDefaultAboutSections(): array
    {
        return [
            [
                'title' => 'Our Story',
                'subtitle' => 'How It All Began',
                'description' => 'Sofoodtchad was born from a simple yet powerful vision: to bring the finest quality food products to Chad and beyond. Starting from humble beginnings, we have grown into one of the region\'s most trusted food companies, dedicated to excellence in every product we deliver. Our journey began with a commitment to quality and a passion for serving our community with the best that nature has to offer.',
                'image' => '/images/about-story.jpg',
                'features' => [],
            ],
            [
                'title' => 'What We Do',
                'subtitle' => 'Our Business',
                'description' => 'We specialize in sourcing, processing, and distributing premium food products across Chad and the Central African region. From farm to table, we ensure every step meets our rigorous quality standards. Our state-of-the-art facilities and dedicated team work tirelessly to bring you products that are fresh, safe, and delicious.',
                'image' => '/images/about-whatwedo.jpg',
                'features' => [
                    'Premium quality food products',
                    'Rigorous quality control standards',
                    'Sustainable sourcing practices',
                    'Modern processing facilities',
                    'Reliable distribution network',
                ],
            ],
            [
                'title' => 'Why Choose Us',
                'subtitle' => 'Our Difference',
                'description' => 'What sets Sofoodtchad apart is our unwavering commitment to quality, transparency, and customer satisfaction. We believe that everyone deserves access to nutritious, high-quality food products. Our team works directly with farmers and producers to ensure fair practices and consistent quality from source to shelf.',
                'image' => '/images/about-whyus.jpg',
                'features' => [
                    'Trusted by thousands of customers',
                    'Direct relationships with producers',
                    'Competitive and fair pricing',
                    'Excellent customer service',
                ],
                'cta_text' => 'View Our Products',
                'cta_url' => '/products',
            ],
        ];
    }

    /**
     * Get mission data.
     */
    private function getMission(): ?array
    {
        $title = setting('about_mission_title');
        $description = setting('about_mission_description');

        if (!$title && !$description) {
            // Return default mission
            return [
                'title' => 'Our Mission',
                'description' => 'To provide Chad and the Central African region with the highest quality food products while supporting local farmers, promoting sustainable practices, and ensuring food security for all communities we serve.',
            ];
        }

        return [
            'title' => $title ?? 'Our Mission',
            'description' => $description,
        ];
    }

    /**
     * Get vision data.
     */
    private function getVision(): ?array
    {
        $title = setting('about_vision_title');
        $description = setting('about_vision_description');

        if (!$title && !$description) {
            // Return default vision
            return [
                'title' => 'Our Vision',
                'description' => 'To become the leading food company in Central Africa, recognized for excellence in quality, innovation, and commitment to sustainable development that benefits our communities and environment.',
            ];
        }

        return [
            'title' => $title ?? 'Our Vision',
            'description' => $description,
        ];
    }

    /**
     * Get company values.
     */
    private function getValues(): array
    {
        $values = $this->parseJsonSetting('about_values', []);

        if (empty($values)) {
            // Return default values
            return [
                ['title' => 'Quality', 'icon' => '<svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path></svg>'],
                ['title' => 'Integrity', 'icon' => '<svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>'],
                ['title' => 'Innovation', 'icon' => '<svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path></svg>'],
                ['title' => 'Community', 'icon' => '<svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>'],
            ];
        }

        return $values;
    }

    /**
     * Get team members.
     */
    private function getTeamMembers(): array
    {
        return $this->parseJsonSetting('about_team', []);
    }

    /**
     * Get company history/timeline.
     */
    private function getHistory(): array
    {
        return $this->parseJsonSetting('about_history', []);
    }

    /**
     * Get CTA section data.
     */
    private function getCtaData(): ?array
    {
        $title = setting('about_cta_title');

        if (!$title) {
            // Return default CTA
            return [
                'title' => 'Ready to Partner With Us?',
                'description' => 'Whether you\'re looking for quality products or interested in becoming a distributor, we\'d love to hear from you.',
                'primary_text' => 'Contact Us',
                'primary_url' => '/contact',
                'secondary_text' => 'View Products',
                'secondary_url' => '/products',
            ];
        }

        return [
            'title' => $title,
            'description' => setting('about_cta_description'),
            'primary_text' => setting('about_cta_primary_text', 'Contact Us'),
            'primary_url' => setting('about_cta_primary_url', '/contact'),
            'secondary_text' => setting('about_cta_secondary_text', 'View Products'),
            'secondary_url' => setting('about_cta_secondary_url', '/products'),
        ];
    }

    /**
     * Parse a JSON setting value.
     */
    private function parseJsonSetting(string $key, $default = null)
    {
        $value = setting($key);

        if (is_array($value)) {
            return $value;
        }

        if (is_string($value) && !empty($value)) {
            $decoded = json_decode($value, true);
            return $decoded ?? $default;
        }

        return $default;
    }
}
