<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class HistoryOrderController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();
        $query = Order::with('customer')->latest();

        if ($user->role === 'desainer') {
            $query->where('status', 'diproses');
        } elseif ($user->role === 'kasir') {
            $query->where('status', 'belum lunas');
        }

        $orders = $query->get();

        return view('dashboard.historyOrder', compact('orders'));
    }


    public function show(Order $order)
    {
        $order->load(['customer', 'items.product']);
        return view('dashboard.order-detail', compact('order'));
    }
}
