<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePartnerRequest;
use App\Http\Requests\Admin\UpdatePartnerRequest;
use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PartnerController extends Controller
{
    public function index(Request $request)
    {
        $query = Partner::ordered();

        if ($request->filled('type')) {
            $query->ofType($request->type);
        }

        $partners = $query->get();

        return view('admin.partners.index', compact('partners'));
    }

    public function create()
    {
        return view('admin.partners.create');
    }

    public function store(StorePartnerRequest $request)
    {
        $validated = $request->validated();

        // Handle logo upload
        $logoPath = null;
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('partners', 'public');
        }

        $partner = Partner::create([
            'logo' => $logoPath,
            'website' => $validated['website'] ?? null,
            'type' => $validated['type'],
            'sort_order' => $validated['sort_order'] ?? Partner::max('sort_order') + 1,
            'is_featured' => $validated['is_featured'] ?? false,
            'is_active' => $validated['is_active'] ?? true,
        ]);

        // Set translations
        foreach (['fr', 'en', 'ar'] as $locale) {
            if (!empty($validated['name'][$locale])) {
                $partner->setTranslation('name', $locale, $validated['name'][$locale]);
            }
            if (!empty($validated['description'][$locale])) {
                $partner->setTranslation('description', $locale, $validated['description'][$locale]);
            }
        }
        $partner->save();

        return redirect()->route('admin.partners.index')
            ->with('success', 'Partner created successfully.');
    }

    public function edit(Partner $partner)
    {
        return view('admin.partners.edit', compact('partner'));
    }

    public function update(UpdatePartnerRequest $request, Partner $partner)
    {
        $validated = $request->validated();

        // Handle logo upload
        if ($request->hasFile('logo')) {
            if ($partner->logo) {
                Storage::disk('public')->delete($partner->logo);
            }
            $partner->logo = $request->file('logo')->store('partners', 'public');
        }

        $partner->update([
            'website' => $validated['website'] ?? null,
            'type' => $validated['type'],
            'sort_order' => $validated['sort_order'] ?? $partner->sort_order,
            'is_featured' => $validated['is_featured'] ?? false,
            'is_active' => $validated['is_active'] ?? true,
        ]);

        // Set translations
        foreach (['fr', 'en', 'ar'] as $locale) {
            $partner->setTranslation('name', $locale, $validated['name'][$locale] ?? null);
            $partner->setTranslation('description', $locale, $validated['description'][$locale] ?? null);
        }
        $partner->save();

        return redirect()->route('admin.partners.index')
            ->with('success', 'Partner updated successfully.');
    }

    public function destroy(Partner $partner)
    {
        if ($partner->logo) {
            Storage::disk('public')->delete($partner->logo);
        }

        $partner->delete();

        return redirect()->route('admin.partners.index')
            ->with('success', 'Partner deleted successfully.');
    }
}
