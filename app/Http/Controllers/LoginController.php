<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\LogUserRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm(){
           return view("login.index");
    }


     public function authenticateUser(LogUserRequest $request): RedirectResponse{

         $credentials = $request->validated();

          $user = Auth::attempt($credentials);
            
          if($user){
             $request->session()->regenerate();

             return redirect()->route('users.index');
          }

          return redirect()->route('login.show')->withErrors([
             'invalid-login' => "Invalid Login Credentials"
          ], 'log-in');
     }

   public function register(CreateUserRequest $request)
{
          $user = new UserController();

          $user->store($request);

          return redirect()->route('users.index');
}

     public function logout(){
           Auth::logout();
          return redirect()->route('login.show');
     }

}
