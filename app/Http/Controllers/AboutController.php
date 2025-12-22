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

        return $sections;
    }

    /**
     * Get mission data.
     */
    private function getMission(): ?array
    {
        $title = setting('about_mission_title');
        $description = setting('about_mission_description');

        if (!$title && !$description) {
            return null;
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
            return null;
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
        return $this->parseJsonSetting('about_values', []);
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
            return null;
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
