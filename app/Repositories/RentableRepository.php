<?php

namespace App\Repositories;

use App\Rentable;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\Interfaces\IRentableRepository;

class RentableRepository implements IRentableRepository
{
    /**
     * Get's all rentables
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function getRentables(): Collection
    {
        return Rentable::all();
    }

    /**
     * Get's a rentable by it's ID
     *
     * @param int
     * @return \App\Rentable
     */
    public function getRentable(int $rentable_id): ?Rentable
    {
        return Rentable::find($rentable_id);
    }

    /**
     * Add a rentable
     *
     * @param rentable
     * @return \App\Rentable
     */
    public function addRentable(Rentable $rentable): Rentable
    {
        // Add rentable to database
        $rentable::save();

        return $rentable;
    }

    /**
     * Remove a rentable by it's ID
     *
     * @param int
     */
    public function deleteRentable(int $rentable_id): void
    {
        Rentable::destroy($rentable_id);
    }
}
