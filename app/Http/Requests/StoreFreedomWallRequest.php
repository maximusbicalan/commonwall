<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFreedomWallRequest extends FormRequest
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
            'title' => 'required|string|max:200|unique:freedom_walls,title',
            'design_json' => 'required|json',
            'tags' => 'nullable|array',
            'tags.*' => 'string|max:50',
            'is_public' => 'boolean',
            'version' => 'nullable|integer|min:1',
            'user_id' => 'required|uuid|exists:users,id', // Ensure user_id exists in users table
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'The title is required or already exists.',
            'title.unique' => 'The title must be unique.',
            'design_json.required' => 'The design JSON is required.',
            'tags.*.string' => 'Each tag must be a string.',
            'is_public.boolean' => 'The is_public field must be true or false.',
            'user_id.exists' => 'The selected user does not exist.',
        ];
    }
}
