<?php

use App\Http\Controllers\Api\AuthController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/first', function () {
    return 'Hello World';
});


Route::get('/page', function(){
      $users = User::all();
      return view('pages.index', ['users' => $users]);
});

Route::get('users/trashed', [UserController::class, 'displayTrashed'])->name('users.trashed');
Route::delete('users/hardDelete/{user}', [UserController::class, 'permanentDelete'])->name('users.hardDelete');
Route::resource('users', UserController::class);


// Route::middleware('auth:sanctum')->get('api/login', [AuthController::class,'login']);

// SPA login route (uses web middleware / session)
use App\Http\Controllers\Api\AuthController as ApiAuthController;
Route::post('/login', [ApiAuthController::class, 'login'])->name('spa.login');

