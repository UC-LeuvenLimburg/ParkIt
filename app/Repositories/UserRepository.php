<?php

namespace App\Repositories;

use App\User;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\Interfaces\IUserRepository;

class UserRepository implements IUserRepository
{
    /**
     * Get's all users
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function getUsers(): Collection
    {
        return User::all();
    }

    /**
     * Get's a user by it's ID
     *
     * @param int
     * @return \App\User
     */
    public function getUser(int $user_id): ?User
    {
        return User::find($user_id);
    }

    /**
     * Add a user
     *
     * @param user
     * @return \App\User
     */
    public function addUser(User $user): User
    {
        // Add user to database
        $user::save();

        return $user;
    }

    /**
     * Remove a user by it's ID
     *
     * @param int
     */
    public function deleteUser(int $user_id): void
    {
        User::destroy($user_id);
    }
}
