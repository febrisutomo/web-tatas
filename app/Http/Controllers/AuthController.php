<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        if (Auth::check()) {
            return to_route('dashboard');
        }
        return view('login');
    }

    public function attemptLogin(Request $request)
    {
        $credentials = $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
        ]);

        $response = Http::post('http://127.0.0.1:5000/auth/login', $credentials);

        if ($response->successful()) {
            $responseBody = $response->object();

            session()->regenerate();
            session(['access_token' => $responseBody->access_token]);
            session(['refresh_token' => $responseBody->refresh_token]);

            $user = User::where('USERNAMEX', $request->input('username'))->first();
            Auth::login($user);
            return to_route('dashboard')->with('message', 'Login berhasil');
        } elseif ($response->status() === 403) {
            return back()->withErrors([
                'username' => 'The provided credentials do not match our records.',
            ])->onlyInput('username');
        } else {
            return back()->with('error', 'Login gagal. Periksa koneksi internet!');
        }
    }

    public function logout()
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        return to_route('login');
    }
}
