<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm(){
           return view("login.index");
    }


     public function authenticateUser(Request $request): RedirectResponse{

         $credentials = $request->only("email","password");

          $user = Auth::attempt($credentials);
            
          if($user){
             $request->session()->regenerate();

             return redirect()->route('users.index');
          }

          return redirect()->route('login.show');
     }

     public function register(CreateUserRequest $request){
         $user = new UserController();
        $reigstered =  $user->store($request);

        if($reigstered){
       return redirect()->route('users.index');
        }

        return redirect()->route('login.show');
     }

     public function logout(){
           Auth::logout();
          return redirect()->route('login.show');
     }

}
