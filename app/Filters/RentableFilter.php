<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

/**
 * Trait RentableFilter.
 */
trait RentableFilter
{
    /**
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @param $value
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function adress_like(Builder $builder, $value)
    {
        return $builder->where('adress', 'like', '%' . $value . '%');
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @param $value
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function postal_code_like(Builder $builder, $value)
    {
        return $builder->where('postal_code', 'like', '%' . $value . '%');
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @param $value
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function date_of_hire_like(Builder $builder, $value)
    {
        return $builder->where('date_of_hire', 'like', '%' . $value . '%');
    }

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
    public function price_like(Builder $builder, $value)
    {
        return $builder->where('price', 'like', '%' . $value . '%');
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @param $value
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function bankaccount_nr_like(Builder $builder, $value)
    {
        return $builder->where('bankaccount_nr', 'like', '%' . $value . '%');
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @param $value
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function description_like(Builder $builder, $value)
    {
        return $builder->where('description', 'like', '%' . $value . '%');
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @param $value
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query_like(Builder $builder, $value)
    {
        $builder->where('adress', 'like', '%' . $value . '%');
        $builder->orWhere('postal_code', 'like', '%' . $value . '%');
        $builder->orWhere('date_of_hire', 'like', '%' . $value . '%');
        $builder->orWhere('start_time', 'like', '%' . $value . '%');
        $builder->orWhere('end_time', 'like', '%' . $value . '%');
        $builder->orWhere('price', 'like', '%' . $value . '%');
        $builder->orWhere('bankaccount_nr', 'like', '%' . $value . '%');
        $builder->orWhere('description', 'like', '%' . $value . '%');

        return $builder;
    }
}
