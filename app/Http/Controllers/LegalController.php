<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class LegalController extends Controller
{
    /**
     * Display the privacy policy page.
     */
    public function privacy()
    {
        $page = $this->getLegalPage('privacy_policy');

        return view('legal.privacy-policy', compact('page'));
    }

    /**
     * Display the terms of service page.
     */
    public function terms()
    {
        $page = $this->getLegalPage('terms_of_service');

        return view('legal.terms-of-service', compact('page'));
    }

    /**
     * Get a legal page from settings.
     */
    private function getLegalPage(string $key): ?object
    {
        $setting = Setting::where('key', $key)->first();

        if (!$setting) {
            return null;
        }

        $value = json_decode($setting->value, true);

        return (object) [
            'title' => $value['title'] ?? ucwords(str_replace('_', ' ', $key)),
            'content' => $value['content'] ?? '',
            'status' => $value['status'] ?? 'draft',
            'updated_at' => $setting->updated_at,
        ];
    }
}
