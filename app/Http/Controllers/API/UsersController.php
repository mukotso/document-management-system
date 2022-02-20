<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\addUserRequest;
use App\Http\Requests\editUserRequest;
use App\Http\Requests\UserRequest;
use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
//    constructor dependency injection
    public $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        $users = $this->userRepository->getAllUsers();
        return response()->json($users, 200);
    }

    public function store(addUserRequest $request)
    {
        $user = $this->userRepository->createUser($request->all());

        return response()->json($user, 201);
    }

    public function show( $user)
    {
        $user = $this->userRepository->showUser($user);
        return response()->json($user);
    }

    public function update(editUserRequest $request, User $user)
    {
        $user = $this->userRepository->updateUser($user, $request->all());
        return response()->json($user, 201);
    }

    public function destroy(User $user)
    {
        $this->userRepository->deleteUser($user->id);
        return response()->json(200);
    }

    public function getUserPermissions($id)
    {
       $permissions= $this->userRepository->getUserPermissions($id);
        return response()->json($permissions,200);
    }

}
