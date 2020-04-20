<?php

namespace App\Repositories\Interfaces;

interface IRentableRepository
{
    /**
     * Get's all rentables
     *
     * @return Illuminate\Pagination\LengthAwarePaginator
     */
    public function getRentables();

    /**
     * Get's a rentable by it's ID
     *
     * @param int rentable_id
     * @return rentables
     */
    public function getRentable(int $rentable_id);

    /**
     * Add a rentable
     *
     * @param mixed attributes
     * @return rentables
     */
    public function addRentable($attributes);

    /**
     * Update a rentable
     *
     * @param int rentable_id
     * @param mixed attributes
     * @return rentables
     */

    public function updateRentable(int $rentable_id, $attributes);

    /**
     * Remove a rentable by it's ID
     *
     * @param int rentable_id
     */
    public function deleteRentable(int $rentable_id);
}
