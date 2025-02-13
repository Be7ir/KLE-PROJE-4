<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class RegisterController extends Controller
{

    public function showRegisterForm()
    {
        return view('signup');
    }


    public function register(Request $request)
    {
        if ($request->isMethod('post')) {
            $response = Http::acceptJson()->post('http://host.docker.internal:8081/api/register', [
                'username' => $request->input('username'),
                'email' => $request->input('email'),
                'password' => $request->input('password'),
                'password_confirmation' => $request->input('password_confirmation'),
            ]);

            if ($response->successful()) {
                return redirect('/login')->with('success', 'Kayıt başarılı! Şimdi giriş yapabilirsiniz.');
            } else {
                $errorMessages = $response->json();


                $formattedErrors = [];
                if (is_array($errorMessages)) {
                    foreach ($errorMessages as $key => $messages) {
                        if (is_array($messages)) {
                            foreach ($messages as $message) {
                                $formattedErrors[] = $message;
                            }
                        } else {
                            $formattedErrors[] = $messages;
                        }
                    }
                } else {
                    $formattedErrors[] = $errorMessages;
                }

                return back()->withErrors($formattedErrors)->withInput();
            }
        }
    }
}
