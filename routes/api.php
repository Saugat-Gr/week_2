<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful;

Route::get('/', function () {
      return 'Hello World From API';
});

// Route::get('/users', [UserController::class, 'index']);
// Route::post('/users', [UserController::class,'store']);


// Route::apiResource('user', UserController::class);

Route::get('/test', function () {
      return response()->json([
            "message" => "Hello World : CORS."
      ]);
});

Route::middleware(['web', EnsureFrontendRequestsAreStateful::class])->group(function () {
Route::post('login', [AuthController::class, 'login']);

      // Route::post('/login', function() {
      //       return response()->json([
      //             'message'=> 'test'
      //       ]);
      // });
});

Route::middleware('auth:sanctum')->group(function () {
      Route::get('/users', [UserController::class, 'index'])->name('users.index');
});