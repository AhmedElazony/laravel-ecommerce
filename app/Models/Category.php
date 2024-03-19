<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;
use App\Rules\Filter;

class Category extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function scopeFilterParents($query, $categoryId)
    {
        // SELECT * FROM categories WHERE id <> :id
        // AND (parent_id <> :id OR parent_id IS NULL)
        return $query->where('id', '<>', $categoryId)
            ->where(function ($query) use ($categoryId) {
                $query->where('parent_id', '<>', $categoryId)
                    ->OrWhereNULL('parent_id');
            });
    }

    public static function validationRules($id = 0)
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
