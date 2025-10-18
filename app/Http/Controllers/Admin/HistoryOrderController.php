<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HistoryOrderController extends Controller
{
    public function index(): View
    {
        $orders = Order::with('customer')->latest()->get();
        return view('dashboard.historyOrder', compact('orders'));
    }


    public function show(Order $order)
    {
        $order->load(['customer', 'items.product']);
        return view('dashboard.order-detail', compact('order'));
    }
}
