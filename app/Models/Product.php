<?php

namespace App\Models;

use App\Models\Scopes\storeScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes, Scopes;

    protected $guarded = [];
    protected $table = 'products';

    protected static function booted()
    {
        static::addGlobalScope('storeId', new StoreScope());
    }
}
