<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\Product;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'name' => 'required|string|max:255',
            'quantity' => 'required|numeric|min:0',
            'unit' => 'required|string|max:50',
            'price' => 'required|numeric|min:0',
        ]);

        Material::create([
            'product_id' => $request->product_id,
            'name' => $request->name,
            'quantity' => $request->quantity,
            'unit' => $request->unit,
            'price' => $request->price,
        ]);

        return redirect()->route('products.show', $request->product_id);
    }
}
