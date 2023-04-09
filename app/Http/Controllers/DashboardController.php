<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->session()->get('auth.user');
        $access_token = $request->session()->get('auth.access_token');
        $refresh_token = $request->session()->get('auth.refresh_token');
        // dd($user);
        return view('dashboard');
    }
}
