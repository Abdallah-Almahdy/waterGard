<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class registerController extends Controller
{

public function register(Request $Request)
{
    $Request->validate([
        'name' => 'required|max:255',
        'email' => 'required|email|unique:users',
        'password' => 'required|max:255'
    ]);

    $user = User::create([
        'name' => $Request->post('name'),
        'email' => $Request->post('email'),
        'password' => Hash::make($Request->post('password'))
    ]);

    $token = $user->createToken('userToken')->plainTextToken;

    return response()->json([
        'token' => $token,
        'user' => $user
    ], 200);


}

}
