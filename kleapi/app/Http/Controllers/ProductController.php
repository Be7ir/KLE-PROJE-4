<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return response()->json($products);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'urun_adı' => 'required|string|max:255',
            'urun_fiyatı' => 'required|numeric',
            'urun_açıklaması' => 'required|string',
        ], [
            'urun_adı.required' => 'Ürün adı boş bırakılamaz.',
            'urun_fiyatı.required' => 'Ürün fiyatı boş bırakılamaz.',
            'urun_açıklaması.required' => 'Ürün açıklaması boş bırakılamaz.',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $product = Product::create([
            'urun_adı' => $request->urun_adı,
            'urun_fiyatı' => $request->urun_fiyatı,
            'urun_açıklaması' => $request->urun_açıklaması,
        ]);

        return response()->json($product, 201);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'urun_adı' => 'required|string|max:255',
            'urun_fiyatı' => 'required|numeric',
            'urun_açıklaması' => 'required|string',
        ], [
            'urun_adı.required' => 'Ürün adı boş bırakılamaz.',
            'urun_fiyatı.required' => 'Ürün fiyatı boş bırakılamaz.',
            'urun_açıklaması.required' => 'Ürün açıklaması boş bırakılamaz.',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $product = Product::findOrFail($id);
        $product->update([
            'urun_adı' => $request->urun_adı,
            'urun_fiyatı' => $request->urun_fiyatı,
            'urun_açıklaması' => $request->urun_açıklaması,
        ]);

        return response()->json($product);
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return response()->json(['message' => 'Ürün başarıyla silindi']);
    }
}
