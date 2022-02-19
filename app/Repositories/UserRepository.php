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
        return User::with('department')->get();
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
        $userDetails['tel'] = '+254' . $userDetails['tel'];
        $useData['email'] = strtolower(trim($userDetails['email']));
        return User::create($userDetails);
    }
    public function updateUser( $user,$newDetails )
    {
        return $user->update($newDetails);
    }

    public function showUser($user)
    {
        return User::where('id', $user)->with('department')->get();
    }


}
