<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    protected $apiUrl = 'http://host.docker.internal:8081/api';

    public function test()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $response = Http::acceptJson()->post($this->apiUrl . '/login', [
            'email' => $request->email,
            'password' => $request->password,
        ]);

        if ($response->successful()) {
            $data = $response->json();
            if (isset($data['token'])) {
                $token = $data['token'];
                session(['api_token' => $token]);
                return redirect('/homepage');
            } else {
                return back()->withErrors(['message' => 'Token alınamadı.']);
            }
        } else {
            return back()->withErrors(['message' => 'Yanlış E-mail veya Şifre'])->withInput();
        }
    }

    public function logout(Request $request)
    {
        if (session()->has('api_token')) {
            Http::withToken(session('api_token'))->post($this->apiUrl . '/logout');
        }

        session()->forget('api_token');
        Auth::logout();

        return redirect('/login');
    }
}
