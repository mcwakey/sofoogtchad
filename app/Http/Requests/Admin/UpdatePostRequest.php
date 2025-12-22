<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $postId = $this->route('post')->id;

        return [
            // Translatable fields - French required, others optional
            'title' => 'required|array',
            'title.fr' => 'required|string|max:255',
            'title.en' => 'nullable|string|max:255',
            'title.ar' => 'nullable|string|max:255',

            'excerpt' => 'nullable|array',
            'excerpt.fr' => 'nullable|string|max:500',
            'excerpt.en' => 'nullable|string|max:500',
            'excerpt.ar' => 'nullable|string|max:500',

            'content' => 'nullable|array',
            'content.fr' => 'nullable|string',
            'content.en' => 'nullable|string',
            'content.ar' => 'nullable|string',

            'meta_title' => 'nullable|array',
            'meta_title.fr' => 'nullable|string|max:70',
            'meta_title.en' => 'nullable|string|max:70',
            'meta_title.ar' => 'nullable|string|max:70',

            'meta_description' => 'nullable|array',
            'meta_description.fr' => 'nullable|string|max:160',
            'meta_description.en' => 'nullable|string|max:160',
            'meta_description.ar' => 'nullable|string|max:160',

            // Non-translatable fields
            'slug' => 'required|string|unique:posts,slug,' . $postId,
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'type' => 'required|string|in:blog,news',
            'status' => 'required|string|in:draft,published,archived',
            'published_at' => 'nullable|date',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     */
    public function attributes(): array
    {
        return [
            'title.fr' => 'title (French)',
            'title.en' => 'title (English)',
            'title.ar' => 'title (Arabic)',
            'excerpt.fr' => 'excerpt (French)',
            'excerpt.en' => 'excerpt (English)',
            'excerpt.ar' => 'excerpt (Arabic)',
            'content.fr' => 'content (French)',
            'content.en' => 'content (English)',
            'content.ar' => 'content (Arabic)',
            'meta_title.fr' => 'SEO title (French)',
            'meta_title.en' => 'SEO title (English)',
            'meta_title.ar' => 'SEO title (Arabic)',
            'meta_description.fr' => 'SEO description (French)',
            'meta_description.en' => 'SEO description (English)',
            'meta_description.ar' => 'SEO description (Arabic)',
        ];
    }
}
