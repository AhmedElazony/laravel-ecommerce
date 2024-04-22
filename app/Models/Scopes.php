<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;

trait Scopes
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

    public function scopeStatus(Builder $query, string $status): Builder
    {
        return $query->where('status', '=', $status);
    }
}
