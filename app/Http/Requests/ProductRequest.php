<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
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
            'name' => ['required', 'string', 'min:7', 'max:255', Rule::unique('products')->ignore($this->id), 'filter:php,laravel,html'],
            'description' => ['nullable', 'string', 'max:255'],
            'category' => ['nullable', 'int', 'exists:categories,id'],
            'image' => ['image', 'mimes:png,jpeg', 'max:512'],
            'price' => ['required', 'numeric'],
            'status' => ['required', 'in:active,draft,archived'],
            'tags' => ['required', 'string']
        ];
    }
}
