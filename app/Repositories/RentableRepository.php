<?php

namespace App\Repositories;

use App\Models\Rentable;
use App\Repositories\Interfaces\IRentableRepository;

class RentableRepository implements IRentableRepository
{
    /**
     * Get's all rentables
     *
     * @return Illuminate\Pagination\LengthAwarePaginator
     */
    public function getRentables()
    {
        return Rentable::orderBy('id', 'asc')->paginate(15);
    }

    /**
     * Get's a rentable by it's ID
     *
     * @param int rentable_id
     * @return rentable
     */
    public function getRentable(int $rentable_id)
    {
        return Rentable::find($rentable_id);
    }

    /**
     * Add a rentable
     *
     * @param mixed attributes
     * @return rentable
     */
    public function addRentable($attributes)
    {
        // Add rentable to database
    }

    /**
     * Update a Rentable
     *
     * @param int rentable_id
     * @param mixed attributes
     * @return rentable
     */
    public function updateRentable(int $rentable_id, $attributes)
    {
        // Find Rentable to update
        $rentable = Rentable::find($rentable_id);

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
     * @param int rentable_id
     */
    public function deleteRentable(int $rentable_id)
    {
        Rentable::destroy($rentable_id);
    }
}
