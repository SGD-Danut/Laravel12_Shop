<?php

namespace App\Http\Requests\Content;

use Illuminate\Foundation\Http\FormRequest;

class AddProductRequest extends FormRequest
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
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:50',
            'description' => 'max:750|nullable',
            'section' => 'required|numeric',
            'brand' => 'numeric|nullable',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'discount' => 'required|numeric|max:100',
            'position' => 'numeric|nullable',
            'views' => 'numeric|nullable',
            'active' => 'boolean|nullable',
            'promoted' => 'nullable|boolean',
            'meta_title' => 'max:255|nullable',
            'meta_description' => 'max:255|nullable',
            'meta_keywords' => 'max:255|nullable',
            'image' => 'nullable|image|max:1024'
        ];
    }
}
