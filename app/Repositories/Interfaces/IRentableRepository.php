<?php

namespace App\Repositories\Interfaces;

use App\Rentable;
use Illuminate\Database\Eloquent\Collection;

interface IRentableRepository
{
    /**
     * Get's all rentables
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function getRentables(): Collection;

    /**
     * Get's a rentable by it's ID
     *
     * @param int
     * @return \App\Rentable
     */
    public function getRentable(int $rentable_id): ?Rentable;

    /**
     * Add a rentable
     *
     * @param rentable
     * @return \App\Rentable
     */
    public function addRentable(Rentable $rentable): Rentable;

    /**
     * Remove a rentable by it's ID
     *
     * @param int
     */
    public function deleteRentable(int $rentable_id): void;
}
