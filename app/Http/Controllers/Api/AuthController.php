<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        try{
            if($token = Auth::attempt($credentials)){
                return response()->json([
                    'message' => 'success',
                    'token' => $this->respondWithToken($token),
                    'user' => $this->respondUserInfo(auth()->user())
                ]);
            }
            return response()->json([
                'message' => 'error',
                'error' => 'invalid credentials'
            ], 401);
        }
        catch (\Exception $exception){
            return response()->json([
                'message' => "error",
                'error' => 'unexpected error'
            ], 500);
        }
    }

    public function status()
    {
        $user = User::find(auth()->id());
        if ($user) return response()->json([
            'message' => 'success',
            'user' => $this->respondUserInfo($user)
        ]);
        return response()->json(['message' => 'error']);
    }

    public function register(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        $token = auth()->login($user);

        return response()->json([
            'message' => 'success',
            'user' => $this->respondUserInfo($user),
            'token' => $this->respondWithToken($token)
        ]);
    }

    protected function respondWithToken($token)
    {
        return ([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }

    protected function respondUserInfo($user)
    {
        return [
            'name' => $user->name,
            'email' => $user->email,
            'is_superuser' => $user->is_superuser
        ];
    }
}
