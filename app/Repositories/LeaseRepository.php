<?php

namespace App\Repositories;

use App\Models\Lease;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\Interfaces\ILeaseRepository;

class LeaseRepository implements ILeaseRepository
{
    /**
     * Get's all leases
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function getLeases(): Collection
    {
        return Lease::all();
    }

    /**
     * Get's a lease by it's ID
     *
     * @param int
     * @return \App\Models\Lease
     */
    public function getLease(int $lease_id): ?Lease
    {
        return Lease::find($lease_id);
    }

    /**
     * Add a lease
     *
     * @param lease
     * @return \App\Models\Lease
     */
    public function addLease(Lease $lease): Lease
    {
        // Add lease to database
        $lease::save();

        return $lease;
    }

    /**
     * Remove a lease by it's ID
     *
     * @param int
     */
    public function deleteLease(int $lease_id): void
    {
        Lease::destroy($lease_id);
    }
}
