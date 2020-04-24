<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Repositories\Interfaces\IUserRepository;
use App\Http\Controllers\Controller;
use eloquentFilter\QueryFilter\ModelFilters\ModelFilters;
use Illuminate\Http\Request;

class APIUserController extends Controller
{
    private $userRepo;

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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->userRepo->updateUser($user->id, $request->all());
        return response()->json($user);
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
