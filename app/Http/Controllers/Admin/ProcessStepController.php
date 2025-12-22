<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreProcessStepRequest;
use App\Http\Requests\Admin\UpdateProcessStepRequest;
use App\Models\ProcessStep;
use Illuminate\Http\Request;

class ProcessStepController extends Controller
{
    public function index()
    {
        $steps = ProcessStep::ordered()->get();
        return view('admin.process-steps.index', compact('steps'));
    }

    public function create()
    {
        return view('admin.process-steps.create');
    }

    public function store(StoreProcessStepRequest $request)
    {
        $validated = $request->validated();

        $step = ProcessStep::create([
            'icon' => $validated['icon'] ?? null,
            'sort_order' => $validated['sort_order'] ?? ProcessStep::max('sort_order') + 1,
            'is_active' => $validated['is_active'] ?? true,
        ]);

        // Set translations
        foreach (['fr', 'en', 'ar'] as $locale) {
            if (!empty($validated['title'][$locale])) {
                $step->setTranslation('title', $locale, $validated['title'][$locale]);
            }
            if (!empty($validated['description'][$locale])) {
                $step->setTranslation('description', $locale, $validated['description'][$locale]);
            }
        }
        $step->save();

        return redirect()->route('admin.process-steps.index')
            ->with('success', 'Process step created successfully.');
    }

    public function edit(ProcessStep $processStep)
    {
        return view('admin.process-steps.edit', compact('processStep'));
    }

    public function update(UpdateProcessStepRequest $request, ProcessStep $processStep)
    {
        $validated = $request->validated();

        $processStep->update([
            'icon' => $validated['icon'] ?? null,
            'sort_order' => $validated['sort_order'] ?? $processStep->sort_order,
            'is_active' => $validated['is_active'] ?? true,
        ]);

        // Set translations
        foreach (['fr', 'en', 'ar'] as $locale) {
            $processStep->setTranslation('title', $locale, $validated['title'][$locale] ?? null);
            $processStep->setTranslation('description', $locale, $validated['description'][$locale] ?? null);
        }
        $processStep->save();

        return redirect()->route('admin.process-steps.index')
            ->with('success', 'Process step updated successfully.');
    }

    public function destroy(ProcessStep $processStep)
    {
        $processStep->delete();

        return redirect()->route('admin.process-steps.index')
            ->with('success', 'Process step deleted successfully.');
    }
}
