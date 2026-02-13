<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
// use App\Http\Requests\Api\CreateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\Api\CreateUserRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::all();

        return ($user);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateUserRequest $request)
    {
        try {

            $user = User::create($request->validated());
            
            if($user){
                return (new UserResource($user))->response()->setStatusCode(201);
            }
                
            return response( 'User Cannot Be Created')->setStatusCode(401);       
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return response('')->setStatusCode(422);
        }
      
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return response()->json( $user );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        dd($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
