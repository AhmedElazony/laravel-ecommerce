<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, ValidateCategoryRequest, CategoryScopes, SoftDeletes;

    protected $guarded = [];
    protected $table = 'categories';

    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }

    public function parent() : BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id', 'id')
            ->withDefault([
                'name' => '-'
            ]); // return new model instance in case the relationship return value is null.
    }

    public function children() : HasMany
    {
        return $this->hasMany(self::class, 'parent_id', 'id');
    }
}
