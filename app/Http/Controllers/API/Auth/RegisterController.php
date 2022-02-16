<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function register(UserRequest $request)
    {
        $useData = $request->all();
        $useData['status'] = 'active';


        $useData['password'] = Hash::make($request->password);
        $useData['tel'] = '+254' . $useData['tel'];
        $useData['email'] = strtolower(trim($useData['email']));
        $useData['name'] = strtolower(trim($useData['name']));

        $user = User::create($useData);
        $accessToken = $user->createToken('authToken')->accessToken;
        event(new Registered($user));

        return response([
            'message' => 'You have been successfully registered.',
            'user' => $user,
            'access_token' => $accessToken
        ], 200);


    }


}
