<?php

namespace App\Repositories\Interfaces;

interface ILeaseRepository
{
    /**
     * Get's all leases
     *
     * @return Illuminate\Pagination\LengthAwarePaginator
     */
    public function getLeases();

    /**
     * Get's a lease by it's ID
     *
     * @param int $lease_id
     * @return lease
     */
    public function getLease(int $lease_id);

    /**
     * Get's all leases by someones ID
     *
     * @param int $user_id
     * @return lease
     */
    public function getUserLeases(int $user_id);

    /**
     * Add a lease
     *
     * @param mixed $attributes
     * @return lease
     */
    public function addLease($attributes);

    /**
     * Update a lease
     *
     * @param int $lease_id
     * @param mixed $attributes
     * @return lease
     */
    public function updateLease($lease_id, $attributes);

    /**
     * Remove a lease by it's ID
     *
     * @param int $lease_id
     */
    public function deleteLease(int $lease_id);
}
