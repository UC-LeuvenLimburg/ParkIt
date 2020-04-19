<?php

namespace App\Repositories\Interfaces;

use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

interface IUserRepository
{
    /**
     * Get's all users
     *
     * @return Illuminate\Pagination\LengthAwarePaginator
     */
    public function getUsers(): LengthAwarePaginator;

    /**
     * Get's a user by it's ID
     *
     * @param int
     * @return \App\Models\User
     */
    public function getUser(int $user_id): ?User;

    /**
     * Add a user
     *
     * @param user
     * @return \App\Models\User
     */
    public function addUser(User $user): User;

    /**
     * Remove a user by it's ID
     *
     * @param int
     */
    public function deleteUser(int $user_id): void;
}
