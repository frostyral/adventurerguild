<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BoardController;
use App\Http\Controllers\BoardLikeController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Default Page
Route::get('/', [DashboardController::class,'index'])->name('dashboard');

// Board Group Routes
Route::group([ 'prefix'=>'board','as'=>'board.'], function () {
    // Create Board
    Route::post('', [BoardController::class,'store'])->name('create');

    // View Board
    Route::get('/{board}', [BoardController::class,'show'])->name('show');

    // Need auth
    Route::group(['middleware'=>['auth']], function () {

        // Delete Board
        Route::delete('/{board}', [BoardController::class,'destroy'])->name('destroy');

        // Edit Board
        Route::get('/{board}/edit', [BoardController::class,'edit'])->name('edit');

        // Update Board
        Route::put('/{board}', [BoardController::class,'update'])->name('update');

        // Comment Board
        Route::post('/{board}/comments', [CommentController::class,'store'])->name('comments.create');

    });
});

// Pages that need auth

// Register Page
Route::get('/register', [AuthController::class,'register'])->name('register');
Route::post('/register', [AuthController::class,'store']);

// Login Page
Route::get('/login', [AuthController::class,'login'])->name('login');
Route::post('/login', [AuthController::class,'authenticate']);

// Logout Function
Route::post('/logout', [AuthController::class,'logout'])->name('logout');

// User Page
Route::resource('users',UserController::class)->only('show','edit','update')->middleware('auth');

// User Page
Route::get('profile',[UserController::class,'profile'])->name('profile')->middleware('auth');

// Follow / Unfollow Function
Route::post('users/{user}/follow',[FollowerController::class,'follow'])->middleware('auth')->name('users.follow');
Route::delete('users/{user}/unfollow',[FollowerController::class,'unfollow'])->middleware('auth')->name('users.unfollow');

// About Page
Route::get('/about',function(){
    return view('about');
})->name('about');

// Follow / Unfollow Function
Route::post('boards/{board}/like',[BoardLikeController::class,'like'])->middleware('auth')->name('boards.like');
Route::delete('boards/{board}/unlike',[BoardLikeController::class,'unlike'])->middleware('auth')->name('boards.unlike');
