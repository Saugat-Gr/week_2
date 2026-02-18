<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TagController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;



Route::get('/', function(){
    return redirect('/post');
});

Route::get('users/trashed', [UserController::class, 'displayTrashed'])->name('users.trashed');
Route::delete('users/hardDelete/{user}', [UserController::class, 'permanentDelete'])->name('users.hardDelete');
Route::resource('users', UserController::class);

Route::resource('category', CategoryController::class);

Route::get('/post/trash', [PostController::class,'getTrashedPosts'])->name('post.trash.index');
Route::delete('/post/{post}/trash', [PostController::class,'softDelete'])->name('post.trash');
Route::resource('post', PostController::class);


Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login.show');
Route::get('/logout', [LoginController::class,'logout'])->name('users.logout');
Route::post('/login', [LoginController::class,'authenticateUser'])->name('user.authenticate');
Route::post('/register', [LoginController::class,'register'])->name('user.register');

Route::get('/tags/search', [TagController::class, 'search'])->name('tags.search');