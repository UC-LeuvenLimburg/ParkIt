<?php

namespace App\Repositories\Interfaces;

interface ILeaseRepository
{
    /**
     * Get's all leases
     *
     * @param \eloquentFilter\QueryFilter\ModelFilters\ModelFilters $query
     * @return leases
     */
    public function getAllLeases($query);

    /**
     * Get's all leases paginated
     *
     * @param \eloquentFilter\QueryFilter\ModelFilters\ModelFilters $query
     * @return Illuminate\Pagination\LengthAwarePaginator
     */
    public function getLeases($query);

    /**
     * Get's a lease by it's ID
     *
     * @param int $lease_id
     * @return lease
     */
    public function getLease(int $lease_id);

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
