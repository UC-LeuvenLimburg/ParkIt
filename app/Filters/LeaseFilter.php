<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

/**
 * Trait LeaseFilter.
 */
trait LeaseFilter
{
    /**
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @param $value
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function start_time_like(Builder $builder, $value)
    {
        return $builder->where('start_time', 'like', '%' . $value . '%');
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @param $value
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function end_time_like(Builder $builder, $value)
    {
        return $builder->where('end_time', 'like', '%' . $value . '%');
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @param $value
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query_like(Builder $builder, $value)
    {
        $builder->where('start_time', 'like', '%' . $value . '%');
        $builder->orWhere('end_time', 'like', '%' . $value . '%');

        return $builder;
    }
}
