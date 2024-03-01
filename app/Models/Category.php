<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function scopeFilterParents($query, $id)
    {
        // SELECT * FROM categories WHERE id <> :id
        // AND (parent_id <> :id OR parent_id IS NULL)
        return $query->where('id', '<>', $id)
            ->where(function ($query) use ($id) {
                $query->where('parent_id', '<>', $id)
                    ->OrWhereNULL('parent_id');
            });
    }
}
