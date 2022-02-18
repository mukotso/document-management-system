<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\Department;
use App\Models\User;
use Illuminate\Support\Str;
class UserRepository implements UserRepositoryInterface
{
    public function getAllUsers()
    {
        return User::all();
    }
    public function deleteUser($userId)
    {
        return  User::destroy($userId);
    }
    public function createUser(array $userDetails)
    {
        $randomPassword = Str::random(9);
        $hashedPassword = bcrypt($randomPassword);
        $userDetails['password']=$hashedPassword;
        $userDetails['status']='active';
        return User::create($userDetails);
    }
    public function updateUser( $user,$newDetails )
    {
        return $user->update($newDetails);
    }

}
