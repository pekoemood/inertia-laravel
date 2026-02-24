<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Features;

Route::get('/', function () {
    return Inertia::render('welcome', [
        'canRegister' => Features::enabled(Features::registration()),
    ]);
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/settings.php';

Route::get('/hello', function() {
    return Inertia::render('hello', ['name' => 'world']);
});

Route::get('/about', function() {
    return Inertia::render('about');
});

Route::post('/hello', function(Request $request) {
    $validated = $request->validate([
        'message' => 'required|min:3',
    ]);

    return back()->with('success', '送信できました:' . $validated['message']);
});
