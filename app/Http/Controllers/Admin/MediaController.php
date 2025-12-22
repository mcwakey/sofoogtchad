<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MediaController extends Controller
{
    public function index(Request $request)
    {
        $query = Media::with('user')->latest();

        if ($request->filled('type')) {
            match ($request->type) {
                'images' => $query->images(),
                'videos' => $query->videos(),
                'documents' => $query->documents(),
                default => null,
            };
        }

        if ($request->filled('collection')) {
            $query->inCollection($request->collection);
        }

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', "%{$request->search}%")
                    ->orWhere('file_name', 'like', "%{$request->search}%")
                    ->orWhere('alt_text', 'like', "%{$request->search}%");
            });
        }

        $media = $query->paginate(24);
        $collections = Media::distinct()->pluck('collection');

        return view('admin.media.index', compact('media', 'collections'));
    }

    public function create()
    {
        return view('admin.media.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'files' => 'required|array',
            'files.*' => 'required|file|max:10240',
            'collection' => 'nullable|string|max:50',
        ]);

        $collection = $request->input('collection', 'default');
        $uploaded = [];

        foreach ($request->file('files') as $file) {
            $originalName = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $mimeType = $file->getMimeType();
            $size = $file->getSize();

            $folder = $this->getStorageFolder($mimeType);
            $fileName = $this->generateUniqueFileName($extension);
            $path = $file->storeAs($folder, $fileName, 'public');

            $media = Media::create([
                'user_id' => auth()->id(),
                'name' => pathinfo($originalName, PATHINFO_FILENAME),
                'file_name' => $originalName,
                'mime_type' => $mimeType,
                'path' => $path,
                'disk' => 'public',
                'size' => $size,
                'collection' => $collection,
            ]);

            $uploaded[] = $media;
        }

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => count($uploaded) . ' file(s) uploaded successfully.',
                'media' => $uploaded,
            ]);
        }

        return redirect()->route('admin.media.index')
            ->with('success', count($uploaded) . ' file(s) uploaded successfully.');
    }

    public function show(Media $media)
    {
        return view('admin.media.show', compact('media'));
    }

    public function edit(Media $media)
    {
        return view('admin.media.edit', compact('media'));
    }

    public function update(Request $request, Media $media)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'alt_text' => 'nullable|string|max:255',
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'collection' => 'nullable|string|max:50',
        ]);

        $media->update($validated);

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Media updated successfully.',
                'media' => $media->fresh(),
            ]);
        }

        return redirect()->route('admin.media.index')
            ->with('success', 'Media updated successfully.');
    }

    public function destroy(Media $media)
    {
        $media->delete();

        if (request()->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Media deleted successfully.',
            ]);
        }

        return redirect()->route('admin.media.index')
            ->with('success', 'Media deleted successfully.');
    }

    public function picker(Request $request)
    {
        $query = Media::images()->latest();

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', "%{$request->search}%")
                    ->orWhere('file_name', 'like', "%{$request->search}%");
            });
        }

        $media = $query->paginate(20);

        return view('admin.media.picker', compact('media'));
    }

    public function bulkDelete(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:media,id',
        ]);

        $count = 0;
        foreach ($request->ids as $id) {
            $media = Media::find($id);
            if ($media) {
                $media->delete();
                $count++;
            }
        }

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => "{$count} file(s) deleted successfully.",
            ]);
        }

        return back()->with('success', "{$count} file(s) deleted successfully.");
    }

    private function getStorageFolder(string $mimeType): string
    {
        if (str_starts_with($mimeType, 'image/')) {
            return 'media/images/' . date('Y/m');
        }
        if (str_starts_with($mimeType, 'video/')) {
            return 'media/videos/' . date('Y/m');
        }
        return 'media/documents/' . date('Y/m');
    }

    private function generateUniqueFileName(string $extension): string
    {
        return Str::uuid() . '.' . $extension;
    }
}
