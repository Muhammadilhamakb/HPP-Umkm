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
        'margin' => 'required|numeric',
    ]);

    $totalMaterialCost = 0;

    foreach ($request->materials as $material) {
        $totalMaterialCost += $material['quantity'] * $material['price'];
    }

    $totalHPP = $totalMaterialCost + $request->overhead_cost;
    $suggestedPrice = $totalHPP + ($totalHPP * ($request->margin / 100));

    $product = Product::create([
        'name' => $request->name,
        'total_hpp' => $totalHPP,
        'suggested_price' => $suggestedPrice,
    ]);

    foreach ($request->materials as $material) {
        $product->materials()->create([
            'name' => $material['name'],
            'quantity' => $material['quantity'],
            'unit' => $material['unit'],
            'price' => $material['price'],
        ]);
    }

    return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan!');
}

}

