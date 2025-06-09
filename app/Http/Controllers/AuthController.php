<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function handleAuthSubmit(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Check if login or register
        if ($request->has('register')) {
            // Register logic here
            // ...
            
            // After registration, log them in
            // ...
            
            // Then redirect based on role
            return $this->redirectBasedOnRole(Auth::user());
        } 
        else {
            // Login attempt
            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
                
                // Redirect based on user role
                return $this->redirectBasedOnRole(Auth::user());
            }
            
            return back()->withErrors([
                'email' => 'Email atau password salah',
            ])->withInput();
        }
    }
    
    /**
     * Redirect the user based on their role
     */
    protected function redirectBasedOnRole($user)
    {
        if ($user->role === 'superadmin') {
            return redirect()->route('superadmin.dashboard');
        } 
        else if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } 
        else {
            // Regular user
            return redirect()->route('homepage');
        }
    }
}