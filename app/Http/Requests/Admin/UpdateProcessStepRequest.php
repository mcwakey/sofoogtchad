<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProcessStepRequest extends FormRequest
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
            'title' => 'required|array',
            'title.fr' => 'required|string|max:255',
            'title.en' => 'nullable|string|max:255',
            'title.ar' => 'nullable|string|max:255',

            'description' => 'nullable|array',
            'description.fr' => 'nullable|string',
            'description.en' => 'nullable|string',
            'description.ar' => 'nullable|string',

            // Non-translatable fields
            'icon' => 'nullable|string|max:100',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
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
            'is_active' => $this->has('is_active'),
        ]);
    }
}
