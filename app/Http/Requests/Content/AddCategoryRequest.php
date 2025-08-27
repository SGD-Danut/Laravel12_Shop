<?php

namespace App\Http\Requests\Content;

use Illuminate\Foundation\Http\FormRequest;

class AddCategoryRequest extends FormRequest
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
            'description' => 'max:255|nullable',
            'position' => 'numeric|nullable',
            'icon' => 'max:255|nullable',
            'active' => 'boolean|nullable',
            'promoted' => 'boolean|nullable',
            'meta_title' => 'max:255|nullable',
            'meta_description' => 'max:255|nullable',
            'meta_keywords' => 'max:255|nullable',
            'image' => 'nullable|image|max:1024',
        ];
    }
}
