<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\IUserRepository;
use Illuminate\Support\Facades\Hash;

class UserRepository implements IUserRepository
{
    /**
     * Get's all users
     *
     * @param \eloquentFilter\QueryFilter\ModelFilters\ModelFilters $query
     * @return users
     */
    public function getAllUsers($query)
    {
        return User::filter($query)->orderBy('email', 'asc')->get();
    }

    /**
     * Get's all users paginated
     *
     * @param \eloquentFilter\QueryFilter\ModelFilters\ModelFilters $query
     * @return Illuminate\Pagination\LengthAwarePaginator
     */
    public function getUsers($query)
    {
        return User::filter($query)->orderBy('email', 'asc')->paginate(15);
    }

    /**
     * Get's a user by it's ID
     *
     * @param int $user_id
     * @return user
     */
    public function getUser(int $user_id)
    {
        return User::find($user_id);
    }

    /**
     * Add a user
     *
     * @param mixed $attributes
     * @return user
     */
    public function addUser($attributes)
    {
        // Add user to database
        $user = User::create($attributes);
        $user->password = Hash::make($attributes['password']);
        $user->save();

        return $user;
    }

    /**
     * Update a user
     *
     * @param int $user_id
     * @param mixed $attributes
     * @return user
     */
    public function updateUser($user_id, $attributes)
    {
        // Find existing user to update
        $user = User::find($user_id);

        // Update user
        $user->update($attributes);
        $user->save();

        return $user;
    }

    /**
     * Remove a user by it's ID
     *
     * @param int $user_id
     */
    public function deleteUser(int $user_id)
    {
        User::destroy($user_id);
    }
}
