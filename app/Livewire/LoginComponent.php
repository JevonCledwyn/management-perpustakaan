<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth; // Tambahkan ini
use Illuminate\Http\Request; // Tambahkan ini jika Anda memerlukan $request

class LoginComponent extends Component
{
    public $email, $password;

    public function render()
    {
        return view('livewire.login-component');
    }

    public function proses(Request $request) // Tambahkan Request sebagai parameter
    {
        $credentials = $this->validate([
            'email' => 'required|email', // Tambahkan validasi format email
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
            'email' => 'Failed Authenticating',
        ])->onlyInput('email');
    }

    public function keluar()
    {
        Auth::logout();

        session()->invalidate();

        session()->regenerateToken();

        return redirect()->route('home');
    }
}
