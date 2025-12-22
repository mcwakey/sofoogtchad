<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
        $productId = $this->route('product')->id;

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

            'short_description' => 'nullable|array',
            'short_description.fr' => 'nullable|string|max:500',
            'short_description.en' => 'nullable|string|max:500',
            'short_description.ar' => 'nullable|string|max:500',

            // Non-translatable fields
            'slug' => 'required|string|unique:products,slug,' . $productId,
            'category_id' => 'nullable|exists:categories,id',
            'type' => 'required|string|in:natural,roasted,grilled',
            'price' => 'nullable|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0',
            'sku' => 'nullable|string|max:100',
            'stock_quantity' => 'nullable|integer|min:0',
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
            'short_description.fr' => 'short description (French)',
            'short_description.en' => 'short description (English)',
            'short_description.ar' => 'short description (Arabic)',
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
