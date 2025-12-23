<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    /**
     * Display the settings page.
     */
    public function index(Request $request)
    {
        $groups = Setting::getGroups();
        $activeGroup = $request->get('group', $groups[0] ?? 'general');

        // Handle legal tab
        if ($activeGroup === 'legal') {
            $privacyPolicy = $this->getLegalPage('privacy_policy');
            $termsOfService = $this->getLegalPage('terms_of_service');

            return view('admin.settings.index', compact('groups', 'activeGroup', 'privacyPolicy', 'termsOfService'));
        }

        $settings = Setting::where('group', $activeGroup)
            ->orderBy('sort_order')
            ->get();

        return view('admin.settings.index', compact('groups', 'activeGroup', 'settings'));
    }

    /**
     * Update settings.
     */
    public function update(Request $request)
    {
        $settings = $request->input('settings', []);

        foreach ($settings as $key => $value) {
            $setting = Setting::where('key', $key)->first();

            if ($setting) {
                // Handle boolean checkboxes
                if ($setting->type === 'boolean') {
                    $value = $request->has("settings.{$key}") ? '1' : '0';
                }

                $setting->value = $value;
                $setting->save();
            }
        }

        // Handle image uploads
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $key => $file) {
                $setting = Setting::where('key', $key)->first();

                if ($setting && $setting->type === 'image') {
                    // Delete old image if exists
                    if ($setting->value && Storage::disk('public')->exists($setting->value)) {
                        Storage::disk('public')->delete($setting->value);
                    }

                    // Store new image
                    $path = $file->store('settings', 'public');
                    $setting->value = '/storage/' . $path;
                    $setting->save();
                }
            }
        }

        // Handle unchecked checkboxes (they won't be in the request)
        $booleanSettings = Setting::where('type', 'boolean')->get();
        foreach ($booleanSettings as $setting) {
            if (!isset($settings[$setting->key])) {
                $setting->value = '0';
                $setting->save();
            }
        }

        Setting::clearCache();

        return redirect()
            ->route('admin.settings.index', ['group' => $request->input('group', 'general')])
            ->with('success', 'Settings updated successfully.');
    }

    /**
     * Remove an image from a setting.
     */
    public function removeImage(Request $request)
    {
        $key = $request->input('key');
        $setting = Setting::where('key', $key)->first();

        if ($setting && $setting->type === 'image' && $setting->value) {
            // Delete the file
            $path = str_replace('/storage/', '', $setting->value);
            if (Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
            }

            $setting->value = '';
            $setting->save();
            Setting::clearCache();

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false], 400);
    }

    /**
     * Create a new setting.
     */
    public function create()
    {
        $groups = Setting::getGroups();

        return view('admin.settings.create', compact('groups'));
    }

    /**
     * Store a new setting.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'key' => 'required|string|max:255|unique:settings,key',
            'value' => 'nullable|string',
            'type' => 'required|in:text,textarea,number,email,url,boolean,json',
            'group' => 'required|string|max:255',
            'label' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'sort_order' => 'nullable|integer',
        ]);

        // Handle new group
        if ($request->filled('new_group')) {
            $validated['group'] = $request->input('new_group');
        }

        Setting::create($validated);
        Setting::clearCache();

        return redirect()
            ->route('admin.settings.index', ['group' => $validated['group']])
            ->with('success', 'Setting created successfully.');
    }

    /**
     * Edit a setting.
     */
    public function edit(Setting $setting)
    {
        $groups = Setting::getGroups();

        return view('admin.settings.edit', compact('setting', 'groups'));
    }

    /**
     * Update a specific setting.
     */
    public function updateSetting(Request $request, Setting $setting)
    {
        $validated = $request->validate([
            'key' => 'required|string|max:255|unique:settings,key,' . $setting->id,
            'value' => 'nullable|string',
            'type' => 'required|in:text,textarea,number,email,url,boolean,json',
            'group' => 'required|string|max:255',
            'label' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'sort_order' => 'nullable|integer',
        ]);

        // Handle new group
        if ($request->filled('new_group')) {
            $validated['group'] = $request->input('new_group');
        }

        $setting->update($validated);
        Setting::clearCache();

        return redirect()
            ->route('admin.settings.index', ['group' => $validated['group']])
            ->with('success', 'Setting updated successfully.');
    }

    /**
     * Delete a setting.
     */
    public function destroy(Setting $setting)
    {
        $group = $setting->group;
        $setting->delete();
        Setting::clearCache();

        return redirect()
            ->route('admin.settings.index', ['group' => $group])
            ->with('success', 'Setting deleted successfully.');
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
