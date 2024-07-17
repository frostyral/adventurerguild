<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BoardController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\AuthController;
use App\Models\Board;
use Illuminate\Support\Facades\Route;

// Default Page
Route::get('/', [DashboardController::class,'index'])->name('dashboard');

// Create Board
Route::post('/board', [BoardController::class,'store'])->name('board.create');

// Delete Board
Route::delete('/board/{board}', [BoardController::class,'destroy'])->name('board.destroy');

// View Board
Route::get('/board/{board}', [BoardController::class,'show'])->name('board.show');

// Edit Board
Route::get('/board/{board}/edit', [BoardController::class,'edit'])->name('board.edit');

// Update Board
Route::put('/board/{board}', [BoardController::class,'update'])->name('board.update');

// Comment Board
Route::post('/board/{board}/comments', [CommentController::class,'store'])->name('board.comments.create');

// Register Page
Route::get('/register', [AuthController::class,'register'])->name('register');
Route::post('/register', [AuthController::class,'store'])->name('login');

