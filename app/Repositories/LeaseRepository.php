<?php

namespace App\Repositories;

use App\Models\Lease;
use App\Repositories\Interfaces\ILeaseRepository;

class LeaseRepository implements ILeaseRepository
{
    /**
     * Get's all leases
     *
     * @return Illuminate\Pagination\LengthAwarePaginator
     */
    public function getLeases()
    {

        return Lease::orderBy('id', 'asc')->paginate(15);
    }

    /**
     * Get's a lease by it's ID
     *
     * @param int $lease_id
     * @return lease
     */
    public function getLease(int $lease_id)
    {
        return Lease::find($lease_id);
    }

    /**
     * Add a lease
     *
     * @param mixed $attributes
     * @return lease
     */
    public function addLease($attributes)
    {
        // Add lease to database
        $lease = Lease::create($attributes);
        $lease->save();

        return $lease;
    }

    /**
     * Update a lease
     *
     * @param int $lease_id
     * @param mixed $attributes
     * @return lease
     */
    public function updateLease($lease_id, $attributes)
    {
        // Find existing lease
        $lease = Lease::find($lease_id);

        // Update lease
        // todo update code
        $lease->save();

        return $lease;
    }

    /**
     * Remove a lease by it's ID
     *
     * @param int $lease_id
     */
    public function deleteLease(int $lease_id)
    {
        Lease::destroy($lease_id);
    }
}
