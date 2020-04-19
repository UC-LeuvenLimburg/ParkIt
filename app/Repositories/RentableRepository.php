<?php

namespace App\Repositories;

use App\Models\Rentable;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\Interfaces\IRentableRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class RentableRepository implements IRentableRepository
{
    /**
     * Get's all rentables
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function getRentables(): LengthAwarePaginator
    {
        return Rentable::orderBy('id', 'asc')->paginate(15);
    }

    /**
     * Get's a rentable by it's ID
     *
     * @param int
     * @return \App\Models\Rentable
     */
    public function getRentable(int $rentable_id): ?Rentable
    {
        return Rentable::find($rentable_id);
    }

    /**
     * Add a rentable
     *
     * @param rentable
     * @return \App\Models\Rentable
     */
    public function addRentable(Rentable $rentable): Rentable
    {
        // Add rentable to database
        $rentable::save();

        return $rentable;
    }
    
    /**
     * Update a Rentable
     *
     * @param Rentable
     * @param $attributes
     * @return \App\Models\Rentable
     */
    public function updateRentable(Rentable $rentable, $attributes): Rentable
    {
        // Update Rentable
        $rentable->adress = $attributes['adress'];
        $rentable->postal_code = $attributes['postal_code'];
        $rentable->date_of_hire = $attributes['date'];
        $rentable->start_time_rp = $attributes['start_time'];
        $rentable->end_time_rp = $attributes['end_time'];
        $rentable->price = $attributes['price'];
        $rentable->bankaccount_nr = $attributes['bankaccount_nr'];
        $rentable->description = $attributes['description'];
        $rentable->save();
        return $rentable;
    }

    /**
     * Remove a rentable by it's ID
     *
     * @param int
     */
    public function deleteRentable(int $rentable_id): void
    {
        Rentable::destroy($rentable_id);
    }

}
