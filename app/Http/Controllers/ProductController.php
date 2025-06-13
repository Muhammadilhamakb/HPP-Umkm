<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Material;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'suggested_price' => 'required|numeric'
        ]);

        $product->update([
            'name' => $request->name,
            'suggested_price' => $request->suggested_price
        ]);

        return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui!');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus!');
    }

    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'materials' => 'required|array',
        'materials.*.name' => 'required|string|max:255',
        'materials.*.quantity' => 'required|numeric',
        'materials.*.unit' => 'required|string|max:255',
        'materials.*.price' => 'required|numeric',
        'overhead_cost' => 'required|numeric',
        'margin' => 'required|numeric|min:1|max:99',
    ]);

    // Hitung total biaya bahan
    $totalMaterialCost = 0;
    foreach ($request->materials as $material) {
        $totalMaterialCost += $material['quantity'] * $material['price'];
    }

    // Hitung HPP = total bahan + biaya tambahan
    $totalHPP = $totalMaterialCost + $request->overhead_cost;

    // Rumus harga jual = HPP / (1 - margin%)
    $marginPercent = $request->margin / 100;
    $suggestedPrice = ($marginPercent < 1) ? ($totalHPP / (1 - $marginPercent)) : 0;

    // Simpan produk
    $product = Product::create([
        'name' => $request->name,
        'total_hpp' => $totalHPP,
        'suggested_price' => round($suggestedPrice),
    ]);

    // Simpan detail bahan/material
    foreach ($request->materials as $material) {
        Material::create([
            'product_id' => $product->id,
            'name'       => $material['name'],
            'quantity'   => $material['quantity'],
            'unit'       => $material['unit'],
            'price'      => $material['price'],
        ]);
    }

    // ✅ return setelah semua selesai
    return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan!');
}
}