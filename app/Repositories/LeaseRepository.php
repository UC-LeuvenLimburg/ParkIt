<?php

namespace App\Repositories;

use App\Models\Lease;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Repositories\Interfaces\ILeaseRepository;

class LeaseRepository implements ILeaseRepository
{
    /**
     * Get's all leases
     *
     * @return Illuminate\Pagination\LengthAwarePaginator
     */
    public function getLeases(): LengthAwarePaginator
    {
        return Lease::orderBy('id', 'asc')->paginate(15);
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
