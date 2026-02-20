<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
public function login(Request $request)
{
    $credentials = $request->only('email', 'password');

    if (!Auth::attempt($credentials)) {
        return response()->json(['message' => 'Invalid Credentials'], 401);
    }

    // Cannot call $request->session()->regenerate() in api.php
    // $request->session()->regenerate(); <-- remove this

    return response()->json(['message' => 'Successfully logged in']);
}
}
