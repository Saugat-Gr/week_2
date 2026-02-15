<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePostRequest extends FormRequest
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
            'title' => 'required|min:4',
            'images.*' => 'required|mimes:png,jpeg,jpg',
            'post_content' => 'required|min:10|string'
        ];
    }

      public function messages(): array
    {
        return [
            'title.required' => 'Title is required.',
            'title.min' => 'Title must be at least 4 characters.',
            'images.required' => 'Image is required.',
            'images.mimes' => 'Image type not supported',
            'post_content' => 'A description of length 10 is required',
        ];
    }
}
