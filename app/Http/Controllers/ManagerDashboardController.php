<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Catalog;
use App\Models\Article;
use Illuminate\Support\Carbon;

class ManagerDashboardController extends Controller
{
    public function index()
    {
        // Summary
        $totalOrders = Order::count();
        $totalIncome = Order::where('status', 'accepted')->get()->sum(function($order) {
            return collect(json_decode($order->items, true))->sum(function($item) {
                return $item['qty'] * $item['price'];
            });
        });
        $totalProducts = Catalog::count();
        $totalArticles = Article::count();

        // Orders per day (7 days)
        $days = collect(range(0,6))->map(function($i){
            return now()->subDays(6-$i)->format('Y-m-d');
        });
        $ordersPerDay = $days->map(function($date) {
            return Order::whereDate('created_at', $date)->count();
        });

        // Status pie
        $statusCounts = [
            'pending' => Order::where('status','pending')->count(),
            'accepted' => Order::where('status','accepted')->count(),
            'rejected' => Order::where('status','rejected')->count(),
        ];

        // Top 5 products
        $productSales = [];
        foreach(Order::where('status','accepted')->get() as $order) {
            foreach(json_decode($order->items, true) as $item) {
                if(!isset($productSales[$item['name']])) $productSales[$item['name']] = 0;
                $productSales[$item['name']] += $item['qty'];
            }
        }
        arsort($productSales);
        $topProducts = array_slice($productSales,0,5,true);

        return view('manager.dashboard', compact(
            'totalOrders','totalIncome','totalProducts','totalArticles',
            'days','ordersPerDay','statusCounts','topProducts'
        ));
    }
} 