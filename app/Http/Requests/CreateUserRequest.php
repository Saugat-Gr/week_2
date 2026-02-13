<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
            'name' => 'bail|required|min:3',
            'email' => 'bail|required|email',
            'password' => 'bail|required|min:8',
            'date_of_birth' => 'nullable|date|after:1990-01-01|before:2010-12-31',
            'image' => 'nullable|image|mimes:jpg,jpeg,png'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Name is required.',
            'name.min' => 'Name must be at least 3 characters.',
            'email.required' => 'Email address is required.',
            'email.email' => 'Please enter a valid email address.',
            'password.required' => 'Password cannot be empty.',
            'password.min' => 'Password must be at least 8 characters long.',
        ];
    }
}
