<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Traits\ApiResponseHelper;
use Auth;

class AuthController extends Controller
{
    use ApiResponseHelper;

    public function register(RegisterRequest $request)
    {
        // Create the user
        $user = User::create($request->all());

        // Generate an access token for the user
        $accessToken = Auth::guard('api')->login($user);

        // Return the user and access token in the response
        return $this->setCode(201)->setSuccess('Registerd Successfully!')->setData([
            'access_token' => $accessToken,
            'user' => $user,
        ])->send();
    }

    public function login(LoginRequest $request)
    {
        $validatedData = $request->all();
        // Attempt to authenticate the user
        if ( !Auth::attempt($validatedData) ) {
            return response()->json(['message' => 'Invalid username or password'], 401);
        }

        // Retrieve the authenticated user
        $user = User::where('username', $validatedData['username'])->firstOrFail();

        // Generate an access token for the user
        $accessToken = Auth::guard('api')->login($user);

        // Return the user and access token in the response
        return $this->setSuccess('Logged In Successfully!')->setData([
            'access_token' => $accessToken,
            'user' => $user,
        ])->send();
    }


}
