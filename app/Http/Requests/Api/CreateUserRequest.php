<?php

namespace App\Http\Requests\Api;

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
           'name' => 'required|min:3',
           'email' => 'required|email',
           'password' => 'required|min:8',
           'date_of_birth' => 'nullable|date|after:1990-01-01|before:2010-12-31',
           'image' => 'nullable|image|mimes:jpg,jpeg,png'
        ];
    }
}
