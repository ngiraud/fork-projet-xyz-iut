<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->middleware('auth')->name('home');

Route::get('/login', [LoginController::class, 'login'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->middleware('guest');

Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');

Route::post('/register/verify-code', [RegisterController::class, 'verifyCode'])->name('register.verify-code');

Route::get('/register/{code:code}/terms', [RegisterController::class, 'terms'])->name('register.terms');
Route::post('/register/{code:code}/verify-terms', [RegisterController::class, 'verifyTerms'])->name('register.verify-terms');

Route::get('/register/{code:code}', [RegisterController::class, 'create'])->name('register');
Route::post('/register/{code:code}', [RegisterController::class, 'store']);
