<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait GlobalScopesTrait
{
    protected static function booted()
    {
        static::addGlobalScope('sortBy', function (Builder $builder, $column = 'created_at', $direction = 'desc') {
            $builder->orderBy($column, $direction);
        });

        static::addGlobalScope('filterBy', function (Builder $builder, $filters) {
            foreach ($filters as $column => $value) {
                // if (in_array($column, $builder->filterable)) {
                    $builder->where($column, $value);
                // }
            }
        });
    }
}
