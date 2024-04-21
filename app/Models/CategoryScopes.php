<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;

trait CategoryScopes
{

    public function scopeSearch(Builder $query, array $filters): void
    {
        $query->when($filters['name'] ?? false, function ($query, $value) {
            $query->where('name', 'LIKE', "%{$value}%");
        });

        $query->when($filters['status'] ?? false, function ($query, $value) {
            $query->where('status', '=', $value);
        });
    }

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

    public function scopeWithParentName(Builder $query): Builder
    {
        return $query->leftJoin('categories as parent', 'parent.id', '=', 'categories.parent_id')
            ->select(['categories.*', 'parent.name as parent_name']);
    }

    public function scopeStatus(Builder $query, string $status): Builder
    {
        return $query->where('status', '=', $status);
    }
}
