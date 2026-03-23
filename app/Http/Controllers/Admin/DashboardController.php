<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $metrics = [
            'total_revenue' => Order::whereIn('status', ['delivered', 'Delivered'])->sum('total_amount'),
            'orders_today' => Order::whereDate('created_at', today())->count(),
            'total_customers' => User::where('role', 'customer')->count(),
            'low_stock_items' => Product::where('stock', '<=', 5)->count()
        ];

        $recentOrders = Order::with('user')->orderBy('created_at', 'desc')->take(10)->get();
        $lowStockProducts = Product::where('stock', '<=', 5)->orderBy('stock', 'asc')->take(5)->get();

        return view('admin.dashboard', compact('metrics', 'recentOrders', 'lowStockProducts'));
    }
}
