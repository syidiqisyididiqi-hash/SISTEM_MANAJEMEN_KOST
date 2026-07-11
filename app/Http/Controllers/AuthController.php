<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Menampilkan halaman login.
     */
    public function showLogin()
    {
        return view('auth.login');
    }

    /**
     * Register
     */
    public function showRegister()
    {
        return view('auth.register');
    }

    /**
     * Proses login.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $remember = $request->boolean('remember');

        if (!Auth::attempt($credentials, $remember)) {
            return back()->withErrors([
                'email' => 'Username atau password salah.',
            ])->onlyInput('email');
        }

        $request->session()->regenerate();

        $user = Auth::user();

        switch ($user->role) {
            case 'admin':
                return redirect()->route('admin.dashboard');

            case 'tenant':
                return redirect()->route('tenant.dashboard');

            default:
                Auth::logout();
                return redirect()->route('login')->withErrors([
                    'email' => 'Role akun tidak dikenali.',
                ]);
        }
    }

    /**
     * Proses register.
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'min:8', 'confirmed'],
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'tenant',
        ]);

        return redirect()->route('login')->with(
            'success',
            'Registrasi berhasil. Silakan login.'
        );
    }

    /**
     * Logout.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}