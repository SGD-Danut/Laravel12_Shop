<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateStaffMemberRequest extends FormRequest
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
            'email' => ['required', 'email', 'max:150', Rule::unique('staff')->ignore($this->id)],
            'phone' => 'max:15|nullable',
            'type' => 'required|max:30',
            'photo' => 'nullable|image|max:1024',
        ];
    }
}
