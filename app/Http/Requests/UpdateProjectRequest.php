<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Symfony\Contracts\Service\Attribute\Required;

class UpdateProjectRequest extends FormRequest
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
            /* 'title' => 'required', */
            'title' => 'required|bail|min:3|max:50',
            'description' => 'nullable|bail|min:3|max:500',
            'thumb' => 'nullable|image|max:500',
            'github' => 'nullable|bail|url:http,https',
            'link' => 'nullable|bail|url:http,https',
        ];
    }
}
