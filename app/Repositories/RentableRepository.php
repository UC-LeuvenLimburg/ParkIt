<?php

namespace App\Repositories;

use App\Models\Rentable;
use App\Repositories\Interfaces\IRentableRepository;

class RentableRepository implements IRentableRepository
{
    /**
     * Get's all rentables
     *
     * @param \eloquentFilter\QueryFilter\ModelFilters\ModelFilters $query
     * @return rentables
     */
    public function getAllRentables($query)
    {
        return Rentable::filter($query)->with('user')->orderBy('id', 'asc')->get();
    }

    /**
     * Get's all rentables paginated
     *
     * @param \eloquentFilter\QueryFilter\ModelFilters\ModelFilters $query
     * @return Illuminate\Pagination\LengthAwarePaginator
     */
    public function getRentables($query)
    {
        return Rentable::filter($query)->with('user')->orderBy('id', 'asc')->paginate(15);
    }

    /**
     * Get's a rentable by it's ID
     *
     * @param int $rentable_id
     * @return rentable
     */
    public function getRentable(int $rentable_id)
    {
        return Rentable::find($rentable_id);
    }

    /**
     * Get's all rentables by someones ID
     *
     * @param int $user_id
     * @return rentables
     */
    public function getUserRentables(int $user_id)
    {
        return Rentable::where('user_id', $user_id)->paginate(15);
    }

    /**
     * Add a rentable
     *
     * @param mixed $attributes
     * @return rentable
     */
    public function addRentable($attributes)
    {
        // Add rentable to database
        $rentable = Rentable::create($attributes);
        $rentable->save();

        return $rentable;
    }

    /**
     * Update a Rentable
     *
     * @param int $rentable_id
     * @param mixed $attributes
     * @return rentable
     */
    public function updateRentable(int $rentable_id, $attributes)
    {
        // Find existing rentable to update
        $rentable = Rentable::find($rentable_id);

        // Update Rentable
        $rentable->update($attributes);
        $rentable->save();

        return $rentable;
    }

    /**
     * Remove a rentable by it's ID
     *
     * @param int $rentable_id
     */
    public function deleteRentable(int $rentable_id)
    {
        Rentable::destroy($rentable_id);
    }
}
