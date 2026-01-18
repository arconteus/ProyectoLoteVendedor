<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
});

Route::get('/login', function () {
    return view('login');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// Páginas de recuperación de contraseña
Route::get('/forgot-password', function () {
    return view('forgot-password');
})->middleware('guest')->name('password.request');

Route::get('/reset-password', function () {
    return view('reset-password');
})->middleware('guest')->name('password.reset');

// Formulario de registro de usuario (solo vista)
Route::get('/register', function () {
    return view('register');
})->middleware('guest')->name('register');

require __DIR__.'/auth.php';