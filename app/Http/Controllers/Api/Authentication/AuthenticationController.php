<?php

namespace App\Http\Controllers\Api\Authentication;

use App\Http\Controllers\Controller;
use App\Http\Requests\Authentication\AuthenticationRequest;
use App\Http\Responses\ApiResponse;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{
    public function register(AuthenticationRequest $request){

        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'email|required|unique:users|max:255',
            'password' => 'required|string|min:8|max:255|confirmed',
            'phone' => 'required|numeric|digits:10|unique:users',
        ]);

        $validatedData['password'] = bcrypt($validatedData['password']);

        $user = User::create($validatedData);

        $accessToken = $user->createToken('authToken')->accessToken;

        return ['user' => $user, 'access_token' => $accessToken];
    }


    public function login(Request $request){

        $validatedData = $request->validate([
            'email' => 'required|email|max:255',
            'password' => 'required|max:255',
        ]);

        if(!auth()->attempt($validatedData)){

            return response()->json(['message' => 'invalid login details'], 401);

        }

        $accessToken = auth()->user()->createToken('authToken')->accessToken;

        return response()->json(['massage'=> 'You logged in successfully', 'user' => auth()->user(), 'access_token' => $accessToken],200);
    }

    public function logout(Request $request){

        Auth::logout();
        return [redirect('/login'),response()->json(['message' => 'You logged out successfully'], 200)];


    }

}
