<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderHistoryController extends Controller
{
    public function index(Request $request)
    {
        // Filter berdasarkan waktu
        $filter = $request->input('filter', 'this_month');

        $query = Order::with('product');

        switch ($filter) {
            case 'last_month':
                $query->whereMonth('order_date', now()->subMonth()->month);
                break;
            case 'this_year':
                $query->whereYear('order_date', now()->year);
                break;
            case 'last_week':
                $query->whereBetween('order_date', [now()->subWeek()->startOfWeek(), now()->subWeek()->endOfWeek()]);
                break;
            case 'last_today':
                $query->whereDate('order_date', now()->subDay());
                break;
            case 'this_week':
                $query->whereBetween('order_date', [now()->startOfWeek(), now()->endOfWeek()]);
                break;
            case 'today':
                $query->whereDate('order_date', now());
                break;
            case 'last_12_months':
                $query->where('order_date', '>=', now()->subMonths(12));
                break;
            default:
                $query->whereMonth('order_date', now()->month);
                break;
        }

        $orders = Order::with('product')
                ->whereMonth('order_date', now()->month)
                ->orderByDesc('order_date')
                ->get();

    $totalProfit = $orders->sum('profit');
    $targetProfit = 500000;

        // Hitung presentase keuntungan/kerugian
        $profitDifference = $totalProfit - $targetProfit;

        return view('order-history.index', compact('orders', 'totalProfit', 'targetProfit', 'profitDifference', 'filter'));
    }
}
