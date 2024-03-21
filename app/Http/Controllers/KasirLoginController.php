<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KasirLoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Login berhasil, arahkan pengguna ke halaman yang sesuai
            return redirect()->intended('/pemesanan');
        }

        // Jika login gagal, redirect kembali dengan pesan error
        return redirect()->back()->withInput($request->only('email'))->withErrors([
            'email' => 'Invalid email or password',
        ]);
    }
}
