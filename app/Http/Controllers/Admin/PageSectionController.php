<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\PageSection;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class PageSectionController extends Controller
{
    /**
     * Store a newly created section.
     */
    public function store(Request $request, Page $page): RedirectResponse
    {
        $validated = $request->validate([
            'section_type' => 'required|string|max:255',
            'content' => 'required|array',
            'order' => 'nullable|integer',
        ]);

        $validated['page_id'] = $page->id;

        if (!isset($validated['order'])) {
            $validated['order'] = $page->sections()->max('order') + 1;
        }

        PageSection::create($validated);

        return redirect()->route('admin.pages.edit', $page)
            ->with('success', 'Section added successfully.');
    }

    /**
     * Update the specified section.
     */
    public function update(Request $request, Page $page, PageSection $section): RedirectResponse
    {
        $validated = $request->validate([
            'section_type' => 'required|string|max:255',
            'content' => 'required|array',
            'order' => 'nullable|integer',
        ]);

        $section->update($validated);

        return redirect()->route('admin.pages.edit', $page)
            ->with('success', 'Section updated successfully.');
    }

    /**
     * Remove the specified section.
     */
    public function destroy(Page $page, PageSection $section): RedirectResponse
    {
        $section->delete();

        return redirect()->route('admin.pages.edit', $page)
            ->with('success', 'Section deleted successfully.');
    }

    /**
     * Reorder sections.
     */
    public function reorder(Request $request, Page $page): RedirectResponse
    {
        $validated = $request->validate([
            'sections' => 'required|array',
            'sections.*.id' => 'required|exists:page_sections,id',
            'sections.*.order' => 'required|integer',
        ]);

        foreach ($validated['sections'] as $sectionData) {
            PageSection::where('id', $sectionData['id'])
                ->update(['order' => $sectionData['order']]);
        }

        return redirect()->route('admin.pages.edit', $page)
            ->with('success', 'Sections reordered successfully.');
    }
}
