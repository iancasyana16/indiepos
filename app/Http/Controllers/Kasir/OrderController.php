<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function index(): View
    {
        $orders = Order::with('customer')
            ->where('status', 'belum lunas')
            ->latest()
            ->get();

        return view('dashboard.historyOrder', compact('orders'));
    }



    public function show(Order $order)
    {
        $order->load(['customer', 'items.product']);
        return view('dashboard.order-detail', compact('order'));
    }


    public function update(Request $request, Order $order)
    {
        // Validasi input
        $validated = $request->validate([
            'remaining_payment' => 'required|numeric|min:0',
        ]);

        $remainingPayment = $validated['remaining_payment'];

        // Hitung total yang sudah dibayar (DP + pelunasan)
        $totalPaid = $order->dp_total + $remainingPayment;

        // Cek apakah sudah lunas
        $isPaidOff = $totalPaid >= $order->price_total;

        // Update data order
        $order->update([
            'remaining_payment' => $remainingPayment,
            'paid_date' => $isPaidOff ? now() : null,
            'status' => $isPaidOff ? 'selesai' : 'belum lunas',
        ]);

        // Optional: kirim notifikasi atau flash message
        return back()->with('success', $isPaidOff
            ? 'Pembayaran telah lunas dan status order diperbarui menjadi selesai.'
            : 'Data pelunasan berhasil diperbarui.');
    }
}
