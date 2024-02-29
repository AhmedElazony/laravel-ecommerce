<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function scopeFilterParents($id)
    {
        return Category::where('id', '<>', $id)
            ->where(function ($query) use ($id) {
                $query->where('parent_id', '<>', $id)
                    ->OrWhereNULL('parent_id');
            })
            ->get();
    }
}
