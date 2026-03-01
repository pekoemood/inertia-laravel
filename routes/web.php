<?php

use App\Http\Controllers\PostController;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


Route::get('/', [PostController::class, 'index'])->name('post.index');
Route::get('/register', [Authenticatable::class, 'register'])->name('auth.register');
Route::Get('/posts/{post}', [PostController::class, 'show'])
