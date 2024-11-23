<?php

use App\Livewire\HomeComponent;
use App\Livewire\LoginComponent;
use Illuminate\Support\Facades\Auth; // Tambahkan ini
use Illuminate\Support\Facades\Route;

// Rute untuk Home dengan middleware auth
Route::get('/', HomeComponent::class)->middleware('auth')->name('home');

// Rute untuk Login
Route::get('/login', LoginComponent::class)->middleware('guest')->name('login');

// Rute untuk Logout
Route::get('/logout', function () {
    Auth::logout(); // Pastikan Auth diimpor
    session()->invalidate();
    session()->regenerateToken();
    return redirect()->route('login');
})->middleware('auth')->name('logout');
