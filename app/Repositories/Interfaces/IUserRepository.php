<?php

namespace App\Repositories\Interfaces;

interface IUserRepository
{
    /**
     * Get's all users
     *
     * @param \eloquentFilter\QueryFilter\ModelFilters\ModelFilters $query
     * @return users
     */
    public function getAllUsers($query);

    /**
     * Get's all users paginated
     *
     * @param \eloquentFilter\QueryFilter\ModelFilters\ModelFilters $query
     * @return Illuminate\Pagination\LengthAwarePaginator
     */
    public function getUsers($query);

    /**
     * Get's a user by it's ID
     *
     * @param int $user_id
     * @return user
     */
    public function getUser(int $user_id);

    /**
     * Add a user
     *
     * @param mixed $attributes
     * @return user
     */
    public function addUser($attributes);

    /**
     * Update a user
     *
     * @param int $user_id
     * @param mixed $attributes
     * @return user
     */
    public function updateUser($user_id, $attributes);

    /**
     * Remove a user by it's ID
     *
     * @param int $user_id
     */
    public function deleteUser(int $user_id);
}
