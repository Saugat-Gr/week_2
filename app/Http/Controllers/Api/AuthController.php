<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Auth;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        try {

            $credentials = $request->only('email', 'password');
            // // dd($credentials);
            // if (!Auth::attempt($credentials)) {
            //     Log::info('fail', ["user" => Auth::user()]);
            //     return response()->json(['message' => 'Invalid Credentials'], 401);
            //     } else {
            //     $token = Auth::user()->createToken('auth_token')->plainTextToken;
            //     Log::info('success', ["user" => Auth::user(), 'token' => $token]);
            //     return response()->json(["message"=> "Login successful", "token" => $token],200);
            // }

            // Use session-based login for SPA (web middleware)
            if (! Auth::attempt($credentials)) {
                Log::info('fail', ["credentials" => $credentials]);
                return response()->json(['message' => 'Invalid Credentials'], 401);
            }

            // Regenerate session to prevent fixation
            $request->session()->regenerate();

            Log::info('success', ["user" => Auth::user()]);
            return response()->json(['message' => 'Login successful'], 200);

            // Cannot call $request->session()->regenerate() in api.php

            // return response()->json(['message' => 'Successfully logged in', 200]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
