<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use App\Models\Sales;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $totalOrders = Order::count();
        $totalProfit = Order::sum('profit');
        $targetSales = Sales::latest()->value('target') ?? 0;

        return view('dashboard', compact('totalProducts', 'totalOrders', 'totalProfit', 'targetSales'));
    }
}
