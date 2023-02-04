<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

class UserController extends Controller
{

    public function subscribe(Request $request)
    {
        $user = $request->user();
        $follower_id = $request->follower_id;


        return response()->json([
           'message' => 'success',

        ]);
    }

    public function getUserSubscriptions(Request $request)
    {
        $user = $request->user();

        return response()->json([
           'message' => 'success',
           'subscriptions' => $user->followingUsers()->get()
        ]);
    }

    public function getUserFollowers(Request $request)
    {
        $user = $request->user();

        return response()->json([
            'message' => 'success',
            'followers' => $user->followers()->get()
        ]);
    }
}
