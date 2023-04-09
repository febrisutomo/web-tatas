<?php

namespace App\Http\Controllers;

use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        // dd(session('access_token'));
        $users = User::all();
        return view('dashboard', ['users' => $users]);
    }
}
