<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
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
            /* 'title' => ['required', 'min:5', 'max:50'], */
            'title' => ['required', 'unique:projects', 'bail', 'min:3', 'max:50'],
            'description' => ['nullable', 'bail', 'min:3', 'max:500'],
            'thumb' => ['nullable', 'image', 'max:500'],
            'type_id' => ['nullable', 'exists:types,id'],
            'github' => ['nullable', 'bail', 'url:http,https'],
            'link' => ['nullable', 'bail', 'url:http,https'],
            'technologies' => ['nullable', 'exists:technologies,id'],

        ];
    }
}
