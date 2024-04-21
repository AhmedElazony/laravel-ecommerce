<?php

namespace App\Models;

use Illuminate\Validation\Rule;

trait ValidateCategoryRequest
{
    public static function validationRules($id = 0): array
    {
        return [
            'name' => ['required', 'string', 'min:7', 'max:255', Rule::unique('categories', 'name')->ignore($id), 'filter:php,laravel,html'],
            'description' => ['nullable', 'string', 'max:255'],
            'parent_id' => ['nullable', 'int', 'exists:categories,id'],
            'image' => ['image', 'mimes:png,jpeg', 'max:512'],
            'status' => ['required', 'in:active,archived'],
        ];
    }
}
