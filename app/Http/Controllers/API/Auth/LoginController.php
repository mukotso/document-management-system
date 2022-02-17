<?php

namespace App\Http\Controllers\API\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function login()
    {

        if (Auth::attempt(['email' => request('email'), 'password' => request('password'), 'status' => 'active'])) {
            $user = Auth::user();
            if($user->status != 'active'){
                return response()->json(['error'=>'Account Disabled Please Contact The System Administrator'], 400);
            }
            $success['token'] =  $user->createToken('MyApp')-> accessToken;
            return response()->json(['token' => $success , 'user'=>$user], 200);
        } else {
            return response()->json(['error'=>'Provided Credentials Do Not Match Any Record'], 400);
        }
    }

    public function logout(Request $request)
    {

        $userData = auth()->user();
        $accessToken = $userData->token();
        $accessToken->revoke();

        error_log('logout successfully');
        return response([
            'success' => true,
            'message' => 'You have been successfully logged out.'
        ]);

    }

    public function unauthorized() {

        return response([
            'success' => false,
            'message' => 'unauthorized'
        ], 401);
    }
}
