<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SalesController extends Controller
{
    public function index()
    {
        return view('sales.index');
    }

    public function storeTarget(Request $request)
    {
        // Simpan target harian (contoh: bisa disimpan ke database nanti)
        return redirect()->route('sales.index')->with('success', 'Target berhasil disimpan!');
    }

    public function storeProfit(Request $request)
    {
        // Simpan keuntungan harian
        return redirect()->route('sales.index')->with('success', 'Keuntungan hari ini berhasil disimpan!');
    }

    public function storeMenu(Request $request)
    {
        // Simpan menu makanan/minuman yang terjual
        return redirect()->route('sales.index')->with('success', 'Data menu terjual berhasil disimpan!');
    }
}
