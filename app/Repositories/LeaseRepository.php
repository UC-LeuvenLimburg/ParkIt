<?php

namespace App\Repositories;

use App\Models\Lease;
use App\Repositories\Interfaces\ILeaseRepository;

class LeaseRepository implements ILeaseRepository
{
    /**
     * Get's all leases
     *
     * @param \eloquentFilter\QueryFilter\ModelFilters\ModelFilters $query
     * @return leases
     */
    public function getAllLeases($query)
    {
        return Lease::filter($query)->with('rentable')->orderBy('id', 'asc')->get();
    }

    /**
     * Get's all leases
     *
     * @param \eloquentFilter\QueryFilter\ModelFilters\ModelFilters $query
     * @return Illuminate\Pagination\LengthAwarePaginator
     */
    public function getLeases($query)
    {
        return Lease::filter($query)->with('rentable')->orderBy('id', 'asc')->paginate(15);
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
     * Get's all leases by someones ID
     *
     * @param int $user_id
     * @param \eloquentFilter\QueryFilter\ModelFilters\ModelFilters $query
     * @return Illuminate\Pagination\LengthAwarePaginator
     */
    public function getUserLeases(int $user_id, $query)
    {
        return lease::filter($query)->where('user_id', $user_id)->paginate(15);
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
        // Find existing lease to update
        $lease = Lease::find($lease_id);

        // Update lease
        $lease->update($attributes);
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

    /**
     * Remove a lease if it is unpayed
     *
     */
    public function deleteUnpayedLease()
    {
        $leases = Lease::where('Payed_at', null)->get();
        dd($leases);
    }
}
