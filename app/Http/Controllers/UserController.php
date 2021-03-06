<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Repositories\Interfaces\IUserRepository;
use eloquentFilter\QueryFilter\ModelFilters\ModelFilters;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
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
        return view('user.index')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
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
        return redirect('/users/' . $newUser->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('user.show')->with('user', $user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('user.edit', compact('user'));
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
        $this->userRepo->updateUser($user->id, $request->validated());
        if ($user->role === 'admin') {
            return redirect('/users/' . $user->id);
        } else {
            return redirect('/profile');
        }
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
            return redirect('/users')->with('error', 'Admin user cannot be removed.');
        }
        $this->userRepo->deleteUser($user->id);
        return redirect('/users')->with('success', 'User Removed');
    }

    /**
     * Display the specified profile.
     *
     * @param  App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        $user = Auth::user();
        $this->authorize('view', $user);
        return view('user.profile')->with('user', $user);
    }
}
