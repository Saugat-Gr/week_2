<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function(){
     return 'Hello World From API'; 
});

// Route::get('/users', [UserController::class, 'index']);
// Route::post('/users', [UserController::class,'store']);


// Route::apiResource('user', UserController::class);

Route::get('/test', function(){
       return response()->json([
          "message" => "Hello World : CORS."         
       ]);
});

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function(){
      Route::get('/users', [UserController::class,'index'])->name('users.index');
});