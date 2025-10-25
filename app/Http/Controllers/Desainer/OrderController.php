<?php

namespace App\Http\Controllers\Desainer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OrderController extends Controller
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


    public function update(Request $request, OrderItem $orderItem)
    {
        $newStatus = $request->input('status');

        if (!in_array($newStatus, ['menunggu desain', 'didesain', 'selesai'])) {
            return back()->with('error', 'Status tidak valid.');
        }

        $orderItem->update(['status' => $newStatus]);

        $order = $orderItem->order;
        $allFinished = $order->items()->where('status', '!=', 'selesai')->count() === 0;

        if ($allFinished && $order->status !== 'belum lunas') {
            $order->update(['status' => 'belum lunas']);
        }

        return back()->with('success', 'Status item berhasil diperbarui.');
    }
}
