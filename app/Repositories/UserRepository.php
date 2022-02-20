<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Mail\UserRegistration;
use App\Models\Department;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Exception;

class UserRepository implements UserRepositoryInterface
{
    public function getAllUsers()
    {
        return User::with('department')->get();
    }

    public function deleteUser($userId)
    {
        return User::destroy($userId);
    }

    public function createUser(array $userDetails)
    {
        return DB::transaction(function () use ($userDetails) {

            try {
                $randomPassword = Str::random(9);
                $hashedPassword = bcrypt($randomPassword);
                $userDetails['password'] = $hashedPassword;
                $userDetails['status'] = 'active';
                $userDetails['tel'] = '+254' . $userDetails['tel'];
                $useData['email'] = strtolower(trim($userDetails['email']));
                $user = User::create($userDetails);
                $details = [
                    'name' => $user->name,
                    'email' => $user->email,
                    'password' => $randomPassword,
                ];

                Mail::to($user->email)->send(new UserRegistration($details));

                return $user;
            } catch (Exception $ex) {
                DB::rollBack();
                return response()->json('User Not Created an errror ...Occured..Please try again ');
            }
        }, 2);
    }

    public function updateUser($user, $newDetails)
    {
        return $user->update($newDetails);
    }

    public function showUser($user)
    {
        return User::where('id', $user)->with('department')->get();
    }


}
