<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePostRequest;
use App\Http\Requests\Admin\UpdatePostRequest;
use App\Models\Post;
use App\Models\PostImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::with('author')->latest();

        if ($request->filled('type')) {
            $query->ofType($request->type);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $posts = $query->paginate(15);

        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.posts.create');
    }

    public function store(StorePostRequest $request)
    {
        $validated = $request->validated();

        // Generate slug from French title
        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']['fr']);
        }

        // Handle published_at
        $publishedAt = null;
        if (!empty($validated['published_at'])) {
            $publishedAt = \Carbon\Carbon::parse($validated['published_at']);
        } elseif ($validated['status'] === 'published') {
            $publishedAt = now();
        }

        // Handle featured image
        $featuredImage = null;
        if ($request->hasFile('featured_image')) {
            $featuredImage = $request->file('featured_image')->store('posts', 'public');
        }

        $post = Post::create([
            'user_id' => auth()->id(),
            'slug' => $validated['slug'],
            'featured_image' => $featuredImage,
            'type' => $validated['type'],
            'status' => $validated['status'],
            'published_at' => $publishedAt,
        ]);

        // Set translations
        foreach (['fr', 'en', 'ar'] as $locale) {
            if (!empty($validated['title'][$locale])) {
                $post->setTranslation('title', $locale, $validated['title'][$locale]);
            }
            if (!empty($validated['excerpt'][$locale])) {
                $post->setTranslation('excerpt', $locale, $validated['excerpt'][$locale]);
            }
            if (!empty($validated['content'][$locale])) {
                $post->setTranslation('content', $locale, $validated['content'][$locale]);
            }
            if (!empty($validated['meta_title'][$locale])) {
                $post->setTranslation('meta_title', $locale, $validated['meta_title'][$locale]);
            }
            if (!empty($validated['meta_description'][$locale])) {
                $post->setTranslation('meta_description', $locale, $validated['meta_description'][$locale]);
            }
        }
        $post->save();

        return redirect()->route('admin.posts.index')
            ->with('success', 'Post created successfully.');
    }

    public function edit(Post $post)
    {
        $post->load('images');
        return view('admin.posts.edit', compact('post'));
    }

    public function update(UpdatePostRequest $request, Post $post)
    {
        $validated = $request->validated();

        // Handle published_at
        $publishedAt = $post->published_at;
        if (!empty($validated['published_at'])) {
            $publishedAt = \Carbon\Carbon::parse($validated['published_at']);
        } elseif ($validated['status'] === 'published' && !$post->published_at) {
            $publishedAt = now();
        }

        // Handle featured image
        $featuredImage = $post->featured_image;
        if ($request->hasFile('featured_image')) {
            if ($post->featured_image) {
                Storage::disk('public')->delete($post->featured_image);
            }
            $featuredImage = $request->file('featured_image')->store('posts', 'public');
        }

        $post->update([
            'slug' => $validated['slug'],
            'featured_image' => $featuredImage,
            'type' => $validated['type'],
            'status' => $validated['status'],
            'published_at' => $publishedAt,
        ]);

        // Set translations
        foreach (['fr', 'en', 'ar'] as $locale) {
            $post->setTranslation('title', $locale, $validated['title'][$locale] ?? '');
            $post->setTranslation('excerpt', $locale, $validated['excerpt'][$locale] ?? '');
            $post->setTranslation('content', $locale, $validated['content'][$locale] ?? '');
            $post->setTranslation('meta_title', $locale, $validated['meta_title'][$locale] ?? '');
            $post->setTranslation('meta_description', $locale, $validated['meta_description'][$locale] ?? '');
        }
        $post->save();

        return redirect()->route('admin.posts.index')
            ->with('success', 'Post updated successfully.');
    }

    public function destroy(Post $post)
    {
        if ($post->featured_image) {
            Storage::disk('public')->delete($post->featured_image);
        }

        foreach ($post->images as $image) {
            Storage::disk('public')->delete($image->image_path);
        }

        $post->delete();

        return redirect()->route('admin.posts.index')
            ->with('success', 'Post deleted successfully.');
    }

    public function addImage(Request $request, Post $post)
    {
        $request->validate([
            'image' => 'required|image|max:2048',
            'alt_text' => 'nullable|string|max:255',
            'caption' => 'nullable|string|max:255',
        ]);

        $path = $request->file('image')->store('posts/gallery', 'public');

        $post->images()->create([
            'image_path' => $path,
            'alt_text' => $request->alt_text,
            'caption' => $request->caption,
            'sort_order' => $post->images()->max('sort_order') + 1,
        ]);

        return back()->with('success', 'Image added successfully.');
    }

    public function deleteImage(Post $post, PostImage $image)
    {
        if ($image->post_id !== $post->id) {
            abort(404);
        }

        Storage::disk('public')->delete($image->image_path);
        $image->delete();

        return back()->with('success', 'Image deleted successfully.');
    }
}
