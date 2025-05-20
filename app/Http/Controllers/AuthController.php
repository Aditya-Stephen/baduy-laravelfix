<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Menampilkan form login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Menampilkan form register
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('homepage');
    }

    // Menangani submit form login atau register
    public function handleAuthSubmit(Request $request)
    {
        // Jika ada field name, berarti registrasi
        if ($request->has('name')) {
            // Validasi input registrasi
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8|confirmed',
            ]);

            // Membuat user baru
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            // Login setelah registrasi
            Auth::login($user);

            // Cek apakah user yang baru register adalah admin
            if ($user->email === 'admin@gmail.com') {
                return redirect()->route('admin.index')->with('success', 'Registration successful!');
            } else {
                // Redirect ke homepage setelah registrasi
                return redirect()->route('homepage')->with('success', 'Registration successful!');
            }
        } else {
            // Jika tidak ada name, berarti login
            $credentials = $request->only('email', 'password');

            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
                
                // Cek apakah user yang login adalah admin
                if (Auth::user()->email === 'admin@gmail.com') {
                    return redirect()->route('admin.index')->with('success', 'Login successful!');
                } else {
                    return redirect()->route('homepage')->with('success', 'Login successful!');
                }
            }

            // Jika login gagal, kembali ke form login dengan error
            return back()->withErrors(['email' => 'The provided credentials do not match our records.']);
        }
    }
}