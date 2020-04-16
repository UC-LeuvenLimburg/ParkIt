<?php

namespace App\Repositories\Interfaces;

use App\User;
use Illuminate\Database\Eloquent\Collection;

interface IUserRepository
{
    /**
     * Get's all users
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function getUsers(): Collection;

    /**
     * Get's a user by it's ID
     *
     * @param int
     * @return \App\User
     */
    public function getUser(int $user_id): ?User;

    /**
     * Add a user
     *
     * @param user
     * @return \App\User
     */
    public function addUser(User $user): User;

    /**
     * Remove a user by it's ID
     *
     * @param int
     */
    public function deleteUser(int $user_id): void;
}
