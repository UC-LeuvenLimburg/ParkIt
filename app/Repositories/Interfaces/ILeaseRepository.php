<?php

namespace App\Repositories\Interfaces;

use App\Lease;
use Illuminate\Database\Eloquent\Collection;

interface ILeaseRepository
{
    /**
     * Get's all leases
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function getLeases(): Collection;

    /**
     * Get's a lease by it's ID
     *
     * @param int
     * @return \App\Lease
     */
    public function getLease(int $lease_id): ?Lease;

    /**
     * Add a lease
     *
     * @param lease
     * @return \App\Lease
     */
    public function addLease(Lease $lease): Lease;

    /**
     * Remove a lease by it's ID
     *
     * @param int
     */
    public function deleteLease(int $lease_id): void;
}
