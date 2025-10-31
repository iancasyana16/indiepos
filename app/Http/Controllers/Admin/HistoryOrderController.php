<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class HistoryOrderController extends Controller
{
    public function index(Request $request): View
    {
        $user = Auth::user();
        $query = Order::with('customer');

        if ($search = $request->input('search')) {
            $query->whereHas('customer', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                ->orWhere('number', 'like', "%{$search}%");
            });
        }

        if ($user->role === 'desainer') {
            $query->where('status', 'diproses');
        } elseif ($user->role === 'kasir') {
            $query->where('status', 'belum lunas');
        }

        $filter = $request->input('sort', 'terbaru');

        if ($filter === 'selesai') {
            $query->where('status', 'selesai');
        } elseif ($filter === 'diproses') {
            $query->where('status', 'diproses');
        } elseif ($filter === 'belum_lunas') {
            $query->where('status', 'belum lunas');
        } elseif ($filter === 'terlama') {
            $query->oldest();
        } else {
            $query->latest();
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
