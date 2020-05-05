<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Repositories\Interfaces\IUserRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use eloquentFilter\QueryFilter\ModelFilters\ModelFilters;

class APIUserController extends Controller
{
    protected $userRepo;

    public function __construct(IUserRepository $userRepo)
    {
        $this->authorizeResource(User::class, 'user');
        $this->userRepo = $userRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @param \eloquentFilter\QueryFilter\ModelFilters\ModelFilters $query
     * @return \Illuminate\Http\Response
     */
    public function index(ModelFilters $query)
    {
        $users = $this->userRepo->getUsers($query);
        return response()->json($users);
    }

    /**
     * Display a listing of the resource.
     *
     * @param \eloquentFilter\QueryFilter\ModelFilters\ModelFilters $query
     * @return \Illuminate\Http\Response
     */
    public function indexall(ModelFilters $query)
    {
        $this->authorize('viewAny', User::class);
        $users = $this->userRepo->getAllUsers($query);
        return response()->json($users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\StoreUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $newUser = $this->userRepo->addUser($request->all());
        return response()->json($newUser);
    }

    /**
     * Display the specified resource.
     *
     * @param  App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\UpdateUserRequest  $request
     * @param  App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $updatedUser = $this->userRepo->updateUser($user->id, $request->all());
        return response()->json($updatedUser);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if ($user->name === 'admin') {
            return response('Admin user cannot be removed', 405);
        }
        $this->userRepo->deleteUser($user->id);
        return response('success', 200);
    }
}
