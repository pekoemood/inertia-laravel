<?php

use App\Http\Controllers\PostController;
use Dom\Comment;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


Route::get('/', [PostController::class, 'index'])->name('post.index');
Route::get('/register', [Authenticatable::class, 'register'])->name('auth.register');
Route::get('/posts/{post}', [PostController::class, 'show'])->name('post.show');
Route::post('/post/{post}', [PostController::class, 'store'])->name('post.store');
Route::post('/post/{post}/comment',[Comment::class, 'store'])->name('comment.store');

