<?php

use App\Livewire\HomeComponent;
use App\Livewire\LoginComponent;
use App\Livewire\UserComponent; 
use App\Livewire\MemberComponent; 
use App\Livewire\KategoriComponent; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Rute untuk Home dengan middleware auth
Route::get('/', HomeComponent::class)->middleware('auth')->name('home');

// Rute untuk User dengan middleware auth
Route::get('/user', UserComponent::class)->name('user')->middleware('auth');

Route::get('/member', MemberComponent::class)->name('member')->middleware('auth');

Route::get('/categories', KategoriComponent::class)->name('categories')->middleware('auth');

// Rute untuk Login
Route::get('/login', LoginComponent::class)->middleware('guest')->name('login');

// Rute untuk Logout
Route::get('/logout', function () {
    Auth::logout(); // Pastikan Auth diimpor
    session()->invalidate();
    session()->regenerateToken();
    return redirect()->route('login');
})->middleware('auth')->name('logout');
