<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class LegalController extends Controller
{
    /**
     * Display the legal pages index.
     */
    public function index()
    {
        $privacyPolicy = $this->getLegalPage('privacy_policy');
        $termsOfService = $this->getLegalPage('terms_of_service');

        return view('admin.legal.index', compact('privacyPolicy', 'termsOfService'));
    }

    /**
     * Show the privacy policy editor.
     */
    public function editPrivacy()
    {
        $page = $this->getLegalPage('privacy_policy');

        return view('admin.legal.edit-privacy', compact('page'));
    }

    /**
     * Update the privacy policy.
     */
    public function updatePrivacy(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'status' => 'required|in:draft,published',
        ]);

        $this->updateLegalPage('privacy_policy', $validated);

        return redirect()->route('admin.settings.index', ['group' => 'legal'])
            ->with('success', 'Privacy Policy updated successfully.');
    }

    /**
     * Show the terms of service editor.
     */
    public function editTerms()
    {
        $page = $this->getLegalPage('terms_of_service');

        return view('admin.legal.edit-terms', compact('page'));
    }

    /**
     * Update the terms of service.
     */
    public function updateTerms(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'status' => 'required|in:draft,published',
        ]);

        $this->updateLegalPage('terms_of_service', $validated);

        return redirect()->route('admin.settings.index', ['group' => 'legal'])
            ->with('success', 'Terms of Service updated successfully.');
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

    /**
     * Update a legal page in settings.
     */
    private function updateLegalPage(string $key, array $data): void
    {
        Setting::updateOrCreate(
            ['key' => $key],
            [
                'value' => json_encode([
                    'title' => $data['title'],
                    'content' => $data['content'] ?? '',
                    'status' => $data['status'],
                ]),
                'group' => 'legal',
                'type' => 'json',
            ]
        );
    }
}
