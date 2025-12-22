<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display the settings page.
     */
    public function index(Request $request)
    {
        $groups = Setting::getGroups();
        $activeGroup = $request->get('group', $groups[0] ?? 'general');

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
}
