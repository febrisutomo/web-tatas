<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login()
    {
        if (Session::get('auth')) {
            return to_route('dashboard');
        }
        return view('login');
    }

    // curl 
    // public function attemptLogin(Request $request)
    // {
    //     $data = $this->validate($request, [
    //         'username' => 'required',
    //         'password' => 'required',
    //     ]);

    //     $url = "http://127.0.0.1:5000/auth/login";
    //     $headers = array(
    //         "Content-Type: application/json"
    //     );

    //     $curl = curl_init($url);
    //     curl_setopt($curl, CURLOPT_URL, $url);
    //     curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    //     curl_setopt($curl, CURLOPT_POST, true);
    //     curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
    //     curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    //     $response = curl_exec($curl);
    //     curl_close($curl);
    //     // echo $response;

    //     $json = json_decode($response);

    //     if ($json->success) {
    //         $request->session()->regenerate();
    //         $request->session()->put('auth.user', $json->data);
    //         $request->session()->put('auth.access_token', $json->access_token);
    //         $request->session()->put('auth.refresh_token', $json->refresh_token);
    //         return to_route('dashboard')->with('message', 'Login berhasil');
    //     }

    //     // throw ValidationException::withMessages([
    //     //     'username' => $json->message,
    //     // ]);
    //     return redirect()->back()->with('error', $json->message);
    //     // dd($json);
    // }

    // guzzle 
    public function attemptLogin(Request $request)
    {
        $validated = $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
        ]);

        $response = Http::post('http://127.0.0.1:5000/auth/login', $validated);


        if ($response->successful()) {
            $resObj = $response->object();
            // dd($resObj);
            $request->session()->regenerate();
            $request->session()->put('auth.user', $resObj->data);
            $request->session()->put('auth.access_token', $resObj->access_token);
            $request->session()->put('auth.refresh_token', $resObj->refresh_token);
            return to_route('dashboard')->with('message', 'Login berhasil');
        } elseif ($response->status() === 403) {
            // throw ValidationException::withMessages([
            //     'username' => $resObj->message,
            // ]);
            return redirect()->back()->with('error', 'Email atau password tidak sesuai!');
        } else {
            return redirect()->back()->with('error', 'Login gagal. Periksa koneksi internet!');
        }
    }

    public function logout(Request $request)
    {
        $request->session()->invalidate();
        return to_route('login');
    }
}
