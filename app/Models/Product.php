<?php

namespace App\Models;

use App\Models\Scopes\StoreScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 *
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string|null $description
 * @property-read string|null $image
 * @property float $price
 * @property float|null $compare_price
 * @property string|null $options
 * @property float $rating
 * @property int $featured
 * @property string $status
 * @property int|null $category_id
 * @property int $store_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Category|null $category
 * @property-read bool $new
 * @property-read int|float $sale_percent
 * @property-read \App\Models\Store $store
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Tag> $tags
 * @property-read int|null $tags_count
 * @method static \Database\Factories\ProductFactory factory($count = null, $state = [])
 * @method static Builder|Product new()
 * @method static Builder|Product newModelQuery()
 * @method static Builder|Product newQuery()
 * @method static Builder|Product onlyTrashed()
 * @method static Builder|Product query()
 * @method static Builder|Product search(array $filters)
 * @method static Builder|Product status(string $status)
 * @method static Builder|Product whereCategoryId($value)
 * @method static Builder|Product whereComparePrice($value)
 * @method static Builder|Product whereCreatedAt($value)
 * @method static Builder|Product whereDeletedAt($value)
 * @method static Builder|Product whereDescription($value)
 * @method static Builder|Product whereFeatured($value)
 * @method static Builder|Product whereId($value)
 * @method static Builder|Product whereImage($value)
 * @method static Builder|Product whereName($value)
 * @method static Builder|Product whereOptions($value)
 * @method static Builder|Product wherePrice($value)
 * @method static Builder|Product whereRating($value)
 * @method static Builder|Product whereSlug($value)
 * @method static Builder|Product whereStatus($value)
 * @method static Builder|Product whereStoreId($value)
 * @method static Builder|Product whereUpdatedAt($value)
 * @method static Builder|Product withTrashed()
 * @method static Builder|Product withoutTrashed()
 * @mixin \Eloquent
 */
class Product extends Model
{
    use HasFactory, SoftDeletes, Scopes;

    protected $guarded = [];
    protected $table = 'products';

    protected static function booted(): void
    {
        static::addGlobalScope('storeId', new StoreScope());
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class, 'store_id', 'id');
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(
            Tag::class,
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
                    return asset('storage/' . $value);
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
