<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddStaffMemberRequest extends FormRequest
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
            'email' => 'required|email|max:150|unique:staff,email',
            'phone' => 'max:15|nullable',
            'type' => 'required|max:30',
            'photo' => 'nullable|image|max:1024',
            'password' => 'required|min:8|confirmed',
            'password_confirmation' => 'required|same:password'
        ];
    }
}
