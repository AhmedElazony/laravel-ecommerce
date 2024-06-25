<?php

namespace App\Models;

use App\Models\Scopes\storeScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes, Scopes;

    protected $guarded = [];
    protected $table = 'products';

    protected static function booted(): void
    {
        static::addGlobalScope('storeId', new StoreScope());
    }

    public function category() : BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function store() : BelongsTo
    {
        return $this->belongsTo(Store::class, 'store_id', 'id');
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class,
            'product_tag',
            'product_id',
            'tag_id',
            'id',
            'id'
        );
    }

    // Mutators
    public function image(): Attribute
    {
        return Attribute::make(
          get: function ($value) {
              if (str_contains($value, 'http'))
                  return $value;
              else
                  return asset('storage/'. $value);
            }
        );
    }

    public function getSalePercentAttribute(): float|int
    {
        if (!$this->compare_price) return 0;
        else
            return round(100 - (100 * ($this->price / $this->compare_price)), 1);
    }

    public function getNewAttribute(): bool
    {
        if ($this->new())
            return true;
        else
            return false;
    }

    public function scopeNew(Builder $query): Builder
    {
        return $query->latest();
    }
}
