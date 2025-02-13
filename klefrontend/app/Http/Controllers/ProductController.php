<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Http;

class ProductController extends Controller
{
    public function index()
    {
        if (!session()->has('api_token')) {
            return redirect('/login')->withErrors(['message' => 'Oturumunuz açılamadı. Lütfen tekrar giriş yapınız.']);
        }

        $response = Http::withToken(session('api_token'))->get('http://host.docker.internal:8081/api/products');

        if ($response->successful()) {
            $products = $response->json();
            return view('homepage', compact('products'));
        }

        return back()->withErrors(['message' => 'Ürünleri listeleme başarısız.']);
    }

    public function store(Request $request)
    {
        if (!session()->has('api_token')) {
            return redirect('/login')->withErrors(['message' => 'Oturumunuzun süresi doldu, lütfen tekrar giriş yapın.']);
        }

        $response = Http::withToken(session('api_token'))->post('http://host.docker.internal:8081/api/products', [
            'urun_adı' => $request->urun_adı,
            'urun_fiyatı' => $request->urun_fiyatı,
            'urun_açıklaması' => $request->urun_açıklaması,
        ]);

        if ($response->successful()) {
            return back()->with('message', 'Ürün başarıyla eklendi.');
        }


        return back()->withErrors($response->json());
    }

    public function update(Request $request, $id)
    {
        if (!session()->has('api_token')) {
            return redirect('/login')->withErrors(['message' => 'Oturumunuzun süresi doldu, lütfen tekrar giriş yapın.']);
        }

        $response = Http::withToken(session('api_token'))->put('http://host.docker.internal:8081/api/products/' . $id, [
            'urun_adı' => $request->urun_adı,
            'urun_fiyatı' => $request->urun_fiyatı,
            'urun_açıklaması' => $request->urun_açıklaması,
        ]);

        if ($response->successful()) {
            return back()->with('message', 'Ürün başarıyla güncellendi.');
        }


        return back()->withErrors($response->json());
    }

    public function destroy($id)
    {
        if (!session()->has('api_token')) {
            return redirect('/login')->withErrors(['message' => 'Oturumunuzun süresi doldu, lütfen tekrar giriş yapın.']);
        }

        $response = Http::withToken(session('api_token'))->delete('http://host.docker.internal:8081/api/products/' . $id);

        if ($response->successful()) {
            return back()->with('message', 'Ürün başarıyla silindi.');
        }

        return back()->withErrors(['message' => 'Ürün silinirken bir hata oluştu.']);
    }
}
