<?php

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
