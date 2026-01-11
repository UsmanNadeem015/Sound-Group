<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    /**
     * Show the login form
     */
    public function showLoginForm()
    {
        return view('login');
    }

    /**
     * Handle login request
     */
    public function login(Request $request)
    {
        // Validate the login credentials
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);

        // Attempt to authenticate the user
        if (Auth::attempt($credentials, $request->filled('remember'))) {
            // Regenerate session to prevent session fixation attacks
            $request->session()->regenerate();

            // Get the authenticated user
            $user = Auth::user();

            // Redirect based on user role
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard')->with('success', 'Welcome back, Admin!');
            }

            // Default redirect for regular users
            return redirect()->route('user.dashboard')->with('success', 'Welcome back, ' . $user->name . '!');
        }

        // If authentication fails, redirect back with error
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput($request->only('email'));
    }

    /**
     * Handle logout request
     */
    public function logout(Request $request)
    {
        Auth::logout();

        // Invalidate the session
        $request->session()->invalidate();

        // Regenerate CSRF token
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'You have been logged out successfully.');
    }
}