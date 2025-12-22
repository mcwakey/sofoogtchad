<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePartnerRequest extends FormRequest
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
        return [
            // Translatable fields - French required, others optional
            'name' => 'required|array',
            'name.fr' => 'required|string|max:255',
            'name.en' => 'nullable|string|max:255',
            'name.ar' => 'nullable|string|max:255',

            'description' => 'nullable|array',
            'description.fr' => 'nullable|string',
            'description.en' => 'nullable|string',
            'description.ar' => 'nullable|string',

            // Non-translatable fields
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,svg|max:2048',
            'website' => 'nullable|url|max:255',
            'type' => 'required|string|in:partner,distributor,supplier',
            'sort_order' => 'nullable|integer|min:0',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     */
    public function attributes(): array
    {
        return [
            'name.fr' => 'name (French)',
            'name.en' => 'name (English)',
            'name.ar' => 'name (Arabic)',
            'description.fr' => 'description (French)',
            'description.en' => 'description (English)',
            'description.ar' => 'description (Arabic)',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'is_featured' => $this->has('is_featured'),
            'is_active' => $this->has('is_active'),
        ]);
    }
}
