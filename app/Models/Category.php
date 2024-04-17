<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
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

    public function scopeStatus(Builder $query, string $status)
    {
        return $query->where('status', '=', $status);
    }

    public function scopeWithParentName(Builder $query)
    {
        return $query->leftJoin('categories as parent', 'parent.id', '=', 'categories.parent_id')
            ->select(['categories.*', 'parent.name as parent_name']);
    }

    public function scopeSearch(Builder $query, array $filters)
    {
        $query->when($filters['name'] ?? false, function ($query, $value) {
            $query->where('name', 'LIKE', "%{$value}%");
        });

        $query->when($filters['status'] ?? false, function ($query, $value) {
            $query->where('status', '=', $value);
        });
    }

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
