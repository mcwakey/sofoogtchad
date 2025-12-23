<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HeroController extends Controller
{
    /**
     * Display the hero slides management page.
     */
    public function index()
    {
        $heroSetting = Setting::where('key', 'hero_slides')->first();
        $slides = [];

        if ($heroSetting && $heroSetting->value) {
            $slides = json_decode($heroSetting->value, true) ?? [];
        }

        return view('admin.hero.index', compact('slides'));
    }

    /**
     * Update hero slides.
     */
    public function update(Request $request)
    {
        $slides = [];
        $slideData = $request->input('slides', []);
        $slideImages = $request->file('slide_images', []);

        foreach ($slideData as $index => $slide) {
            // Handle image upload
            $imagePath = $slide['image'] ?? '';

            if (isset($slideImages[$index]) && $slideImages[$index]) {
                // Delete old image if it's a local file
                if ($imagePath && str_starts_with($imagePath, '/storage/')) {
                    $oldPath = str_replace('/storage/', '', $imagePath);
                    if (Storage::disk('public')->exists($oldPath)) {
                        Storage::disk('public')->delete($oldPath);
                    }
                }

                // Store new image
                $path = $slideImages[$index]->store('hero', 'public');
                $imagePath = '/storage/' . $path;
            }

            $slides[] = [
                'title' => [
                    'fr' => $slide['title_fr'] ?? '',
                    'en' => $slide['title_en'] ?? '',
                    'ar' => $slide['title_ar'] ?? '',
                ],
                'subtitle' => [
                    'fr' => $slide['subtitle_fr'] ?? '',
                    'en' => $slide['subtitle_en'] ?? '',
                    'ar' => $slide['subtitle_ar'] ?? '',
                ],
                'image' => $imagePath,
                'cta_text' => [
                    'fr' => $slide['cta_text_fr'] ?? '',
                    'en' => $slide['cta_text_en'] ?? '',
                    'ar' => $slide['cta_text_ar'] ?? '',
                ],
                'cta_url' => $slide['cta_url'] ?? '',
                'is_active' => isset($slide['is_active']) && $slide['is_active'] === '1',
            ];
        }

        // Update or create the setting
        Setting::updateOrCreate(
            ['key' => 'hero_slides'],
            [
                'value' => json_encode($slides),
                'type' => 'json',
                'group' => 'homepage',
                'label' => 'Hero Slides',
                'description' => 'Homepage hero slider slides',
            ]
        );

        Setting::clearCache();

        return redirect()
            ->route('admin.hero.index')
            ->with('success', 'Hero slides updated successfully.');
    }

    /**
     * Delete a specific slide.
     */
    public function deleteSlide(Request $request)
    {
        $index = $request->input('index');
        $heroSetting = Setting::where('key', 'hero_slides')->first();

        if (!$heroSetting) {
            return response()->json(['success' => false], 404);
        }

        $slides = json_decode($heroSetting->value, true) ?? [];

        if (isset($slides[$index])) {
            // Delete image if it's a local file
            $imagePath = $slides[$index]['image'] ?? '';
            if ($imagePath && str_starts_with($imagePath, '/storage/')) {
                $path = str_replace('/storage/', '', $imagePath);
                if (Storage::disk('public')->exists($path)) {
                    Storage::disk('public')->delete($path);
                }
            }

            array_splice($slides, $index, 1);

            $heroSetting->value = json_encode($slides);
            $heroSetting->save();
            Setting::clearCache();

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false], 400);
    }
}
