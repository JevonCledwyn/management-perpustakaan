<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class LoginComponent extends Component
{
    public $email, $password;

    public function render()
    {
        return view('livewire.login-component')->layout('components.layouts.login');
    }

    public function proses()
    {
        $credentials = $this->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'Email must be filled!',
            'password.required' => 'Password must be filled!',
        ]);

        if (Auth::attempt($credentials)) {
            session()->regenerate();

            return redirect()->route('home');
        }

        return back()->withErrors([
            'login' => 'Invalid credentials.',
        ]);
    }

    public function keluar()
    {
        Auth::logout();

        session()->invalidate();

        session()->regenerateToken();

        return redirect()->route('login');
    }
}
