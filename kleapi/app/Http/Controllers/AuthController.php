<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{

    public function register(Request $request)
{
    try {
        $validated = $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|confirmed|min:3',
        ], [
            'email.unique' => 'Bu e-posta adresi zaten kullanılıyor. Lütfen başka bir e-posta adresi deneyin.',
            'password.confirmed' => 'Girdiğiniz şifreler uyuşmuyor. Lütfen kontrol edip tekrar deneyin.',
        ]);

        $user = User::create([
            'username' => $validated['username'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        return response()->json([
            'message' => 'Kullanıcı başarıyla kayıt olmuştur.',
            'user' => $user,
        ], 201);
    } catch (ValidationException $e) {
        return response()->json([
            'message' => 'Validasyon hatası.',
            'errors' => $e->errors(),
        ], 422);
    } catch (\Exception $e) {
        return response()->json([
            'message' => 'Kayıt sırasında bir hata oluştu.',
            'error' => $e->getMessage(),
        ], 500);
    }
}


    public function login(Request $request)
    {
        try {
            $validated = $request->validate([
                'email' => 'required|email',
                'password' => 'required|string',
            ]);

            if (!Auth::attempt(['email' => $validated['email'], 'password' => $validated['password']])) {
                return response()->json(['message' => 'E-posta veya şifre hatalı.'], 401);
            }

            $user = Auth::user();
            $token = $user->createToken('API Token')->plainTextToken;

            return response()->json([
                'message' => 'Giriş başarılı.',
                'token' => $token,
                'user' => $user,
            ], 200);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validasyon hatası.',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Giriş sırasında bir hata oluştu.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }


    public function logout(Request $request) {
        if ($request->user() && $request->user()->currentAccessToken()) {
            $request->user()->currentAccessToken()->delete();
        }

        return response()->json([
            'message' => 'Başarıyla çıkış yapıldı.'
        ], 200);

    }
}
