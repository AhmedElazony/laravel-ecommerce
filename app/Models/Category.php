<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
