<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Closure;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\View\ViewCompilationException;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    use Authenticatable;

   public function __construct(){
         $this->middleware("check.auth");
   }
       
    
   public function redirectRoute(){
     return redirect()->route('login.show');
   }

    /**
     * Display a listing of the resource.
    */
    public function index() 
    {
                                   
         $users = User::paginate(10);
  
        return view('users.index')->with([
        'users' => $users,
        'data_type' => 'Users List'
        ]);

        // return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
                                     

        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateUserRequest $request)
    {

        $validate_data = $request->validated();


        $image = null;

        if($request->hasFile('image')){
              $image = $request->file('image')->store('users', 'public');
        }else{
              $image = 'users/useravatar.jpg';
        }

        ($user = User::create([
            'date_of_birth' => Carbon::parse($validate_data['date_of_birth'])->toDateString(),
             'name' => $validate_data['name'],
             'email' => $validate_data['email'],
             'password' => Hash::make($validate_data['password']),
             'image' => $image
        ]));


        if($user != null){
            Auth::login($user);
             return true;
        }else{
        return false;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('users.show')->with(['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
         return view('users.edit')->with(['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {


         $validated = $request->validated();


         $image = null;

         if($request->hasFile('image')){
              $image = $request->file('image')->store('users', 'public');
         }else{
             $image = $user->image;
         }



         $user->update([
             'date_of_birth' => Carbon::parse($validated['date_of_birth'])->toDateString(),
             'name' => $validated['name'],
             'password' => $validated['password'] ? Hash::make($validated['password']) : $user->password,
             'image' => $image
         ]);

         return redirect()->route('users.show', $user);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index');
    }

    public function displayTrashed(){
          $trahsedUsers = User::onlyTrashed()->get();
          return view('users.trashed')->with('trashed', $trahsedUsers);
    }

    public function permanentDelete($id){
 
    $user = User::onlyTrashed()->find($id);

         $user->forceDelete();
         return redirect()->route('users.index');
    }
}
