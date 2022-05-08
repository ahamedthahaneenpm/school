<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Spatie\Permission\Models\Role as BaseRole;

class Role extends BaseRole
{

    protected static function booted()
    {
        static::addGlobalScope('super', function (Builder $builder) {
            $builder->where('name', '!=', 'super_privilege');
        });
    }
}