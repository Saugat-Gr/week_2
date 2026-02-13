<?php

use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function(){
     return 'Hello World From API'; 
});

// Route::get('/users', [UserController::class, 'index']);
// Route::post('/users', [UserController::class,'store']);


Route::apiResource('user', UserController::class);