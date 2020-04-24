<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

/**
 * Trait UserFilter.
 */
trait UserFilter
{
    /**
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @param                                       $value
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function name_like(Builder $builder, $value)
    {
        return $builder->where('name', 'like', '%' . $value . '%');
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @param                                       $value
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function email_like(Builder $builder, $value)
    {
        return $builder->where('email', 'like', '%' . $value . '%');
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @param                                       $value
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function role_like(Builder $builder, $value)
    {
        return $builder->where('role', 'like', '%' . $value . '%');
    }
}
