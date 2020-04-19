<?php

namespace App\Repositories\Interfaces;

use App\Models\Lease;
use Illuminate\Pagination\LengthAwarePaginator;

interface ILeaseRepository
{
    /**
     * Get's all leases
     *
     * @return Illuminate\Pagination\LengthAwarePaginator
     */
    public function getLeases(): LengthAwarePaginator;

    /**
     * Get's a lease by it's ID
     *
     * @param int
     * @return \App\Models\Lease
     */
    public function getLease(int $lease_id): ?Lease;

    /**
     * Add a lease
     *
     * @param lease
     * @return \App\Models\Lease
     */
    public function addLease(Lease $lease): Lease;

    /**
     * Update a lease
     *
     * @param lease
     * @return \App\Models\Lease
     */
    public function updateLease(Lease $lease): Lease;

    /**
     * Remove a lease by it's ID
     *
     * @param int
     */
    public function deleteLease(int $lease_id): void;
}
