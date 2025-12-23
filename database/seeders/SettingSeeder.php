<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            // General settings
            [
                'key' => 'site_name',
                'value' => 'Sofoodtchad',
                'type' => 'text',
                'group' => 'general',
                'label' => 'Site Name',
                'description' => 'The name of the website.',
                'sort_order' => 1,
            ],
            [
                'key' => 'site_tagline',
                'value' => 'Quality Food Products',
                'type' => 'text',
                'group' => 'general',
                'label' => 'Site Tagline',
                'description' => 'A short description or slogan for the site.',
                'sort_order' => 2,
            ],
            [
                'key' => 'site_description',
                'value' => 'Sofoodtchad - Leading provider of quality food products in Chad.',
                'type' => 'textarea',
                'group' => 'general',
                'label' => 'Site Description',
                'description' => 'Used in meta description for SEO.',
                'sort_order' => 3,
            ],
            [
                'key' => 'site_logo',
                'value' => '',
                'type' => 'image',
                'group' => 'general',
                'label' => 'Site Logo',
                'description' => 'Upload your site logo (recommended: PNG with transparent background, max 2MB).',
                'sort_order' => 4,
            ],
            [
                'key' => 'site_favicon',
                'value' => '',
                'type' => 'image',
                'group' => 'general',
                'label' => 'Favicon',
                'description' => 'Upload your favicon (recommended: ICO or PNG, 32x32 or 16x16 pixels).',
                'sort_order' => 5,
            ],

            // Homepage settings
            [
                'key' => 'homepage_about_image',
                'value' => '',
                'type' => 'image',
                'group' => 'homepage',
                'label' => 'About Section Image',
                'description' => 'Upload the image for the "Why Us" / About section on the homepage.',
                'sort_order' => 1,
            ],
            [
                'key' => 'homepage_about_title',
                'value' => 'Why Choose Us',
                'type' => 'text',
                'group' => 'homepage',
                'label' => 'About Section Title',
                'description' => 'Title for the about section on homepage.',
                'sort_order' => 2,
            ],
            [
                'key' => 'homepage_about_description',
                'value' => 'We are dedicated to providing the highest quality food products.',
                'type' => 'textarea',
                'group' => 'homepage',
                'label' => 'About Section Description',
                'description' => 'Description text for the about section.',
                'sort_order' => 3,
            ],

            // Contact settings
            [
                'key' => 'contact_email',
                'value' => 'contact@sofoodtchad.com',
                'type' => 'email',
                'group' => 'contact',
                'label' => 'Contact Email',
                'description' => 'Main contact email address.',
                'sort_order' => 1,
            ],
            [
                'key' => 'contact_phone',
                'value' => '+235 00 00 00 00',
                'type' => 'text',
                'group' => 'contact',
                'label' => 'Phone Number',
                'description' => 'Main contact phone number.',
                'sort_order' => 2,
            ],
            [
                'key' => 'contact_whatsapp',
                'value' => '+235 00 00 00 00',
                'type' => 'text',
                'group' => 'contact',
                'label' => 'WhatsApp Number',
                'description' => 'WhatsApp contact number.',
                'sort_order' => 3,
            ],
            [
                'key' => 'contact_address',
                'value' => "N'Djamena, Chad",
                'type' => 'textarea',
                'group' => 'contact',
                'label' => 'Address',
                'description' => 'Physical address of the company.',
                'sort_order' => 4,
            ],
            [
                'key' => 'contact_working_hours',
                'value' => 'Mon-Fri: 8:00 AM - 6:00 PM',
                'type' => 'text',
                'group' => 'contact',
                'label' => 'Working Hours',
                'description' => 'Business working hours.',
                'sort_order' => 5,
            ],

            // Social media settings
            [
                'key' => 'social_facebook',
                'value' => '',
                'type' => 'url',
                'group' => 'social',
                'label' => 'Facebook URL',
                'description' => 'Link to Facebook page.',
                'sort_order' => 1,
            ],
            [
                'key' => 'social_instagram',
                'value' => '',
                'type' => 'url',
                'group' => 'social',
                'label' => 'Instagram URL',
                'description' => 'Link to Instagram profile.',
                'sort_order' => 2,
            ],
            [
                'key' => 'social_twitter',
                'value' => '',
                'type' => 'url',
                'group' => 'social',
                'label' => 'Twitter/X URL',
                'description' => 'Link to Twitter/X profile.',
                'sort_order' => 3,
            ],
            [
                'key' => 'social_linkedin',
                'value' => '',
                'type' => 'url',
                'group' => 'social',
                'label' => 'LinkedIn URL',
                'description' => 'Link to LinkedIn page.',
                'sort_order' => 4,
            ],
            [
                'key' => 'social_youtube',
                'value' => '',
                'type' => 'url',
                'group' => 'social',
                'label' => 'YouTube URL',
                'description' => 'Link to YouTube channel.',
                'sort_order' => 5,
            ],
            [
                'key' => 'social_tiktok',
                'value' => '',
                'type' => 'url',
                'group' => 'social',
                'label' => 'TikTok URL',
                'description' => 'Link to TikTok profile.',
                'sort_order' => 6,
            ],

            // SEO settings
            [
                'key' => 'seo_meta_keywords',
                'value' => 'food, products, chad, quality, sofoodtchad',
                'type' => 'textarea',
                'group' => 'seo',
                'label' => 'Default Meta Keywords',
                'description' => 'Default keywords for SEO (comma-separated).',
                'sort_order' => 1,
            ],
            [
                'key' => 'seo_google_analytics',
                'value' => '',
                'type' => 'text',
                'group' => 'seo',
                'label' => 'Google Analytics ID',
                'description' => 'Google Analytics tracking ID (e.g., G-XXXXXXXXXX).',
                'sort_order' => 2,
            ],
            [
                'key' => 'seo_google_tag_manager',
                'value' => '',
                'type' => 'text',
                'group' => 'seo',
                'label' => 'Google Tag Manager ID',
                'description' => 'Google Tag Manager container ID (e.g., GTM-XXXXXXX).',
                'sort_order' => 3,
            ],

            // Features settings
            [
                'key' => 'features_blog_enabled',
                'value' => '1',
                'type' => 'boolean',
                'group' => 'features',
                'label' => 'Enable Blog',
                'description' => 'Show/hide the blog section on the website.',
                'sort_order' => 1,
            ],
            [
                'key' => 'features_distributor_form_enabled',
                'value' => '1',
                'type' => 'boolean',
                'group' => 'features',
                'label' => 'Enable Distributor Form',
                'description' => 'Allow visitors to submit distributor applications.',
                'sort_order' => 2,
            ],
            [
                'key' => 'features_contact_form_enabled',
                'value' => '1',
                'type' => 'boolean',
                'group' => 'features',
                'label' => 'Enable Contact Form',
                'description' => 'Show/hide the contact form on the website.',
                'sort_order' => 3,
            ],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }

        $this->command->info('Settings seeded successfully!');
    }
}
