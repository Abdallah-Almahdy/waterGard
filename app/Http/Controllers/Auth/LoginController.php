<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{

    public function  login(Request $request)
    {
        $request->validate([

            'email' => 'required|email',
            'password' => 'required|max:255'
        ]);

        $user = User::where('email',$request->post('email'))->first();

        if ($user && Hash::check($request->post('password'),$user->password)) {

            $token = $user->createToken('userToken')->plainTextToken;

            return response()->json([
                'token' => $token,
                'user' => $user
        ], 200);

        }

        return response()->json([
            'Massage' => 'invalid Credential'
        ],401);

    }
}
