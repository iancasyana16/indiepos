<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Customer;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\CheckoutRequest;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Tampilkan daftar produk (halaman order)
    public function index()
    {
        $products = Product::all();
        $cart = session('cart', []);

        return view('dashboard.order', compact('products', 'cart'));
    }

    // Tambahkan produk ke keranjang
    public function addToCart(Request $request, Product $product)
    {
        $cart = session()->get('cart', []);

        // Jika produk sudah ada, tambah quantity
        if (isset($cart[$product->id])) {
            $cart[$product->id]['qty']++;
        } else {
            $cart[$product->id] = [
                'name' => $product->name,
                'price' => $product->price_unit,
                'qty' => 1,
            ];
        }

        session()->put('cart', $cart);

        return redirect()->route('order.index')->with('success', 'Produk ditambahkan ke keranjang!');
    }

    // Proses checkout
    public function checkout(CheckoutRequest $request)
    {
        $validated = $request->validated();
        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()->back()->with('error', 'Keranjang masih kosong.');
        }

        DB::beginTransaction();

        try {
            // Cek apakah customer sudah terdaftar
            $customer = Customer::firstOrCreate(
                ['number' => $validated['number']],
                [
                    'name' => $validated['name'],
                    'address' => $validated['address'],
                ]
            );

            // Buat order baru
            $order = Order::create([
                'customer_id' => $customer->id,
                'order_date' => now(),
                'status' => 'menunggu desain',
                'price_total' => 0, // sementara, nanti diupdate
            ]);

            $total = 0;

            // Simpan item satu per satu
            foreach ($cart as $productId => $item) {
                $subtotal = $item['price'] * $item['qty'];
                $total += $subtotal;

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $productId,
                    'qty' => $item['qty'],
                    'price' => $subtotal,
                ]);
            }

            // Update total harga order
            $order->update(['price_total' => $total]);

            DB::commit();
            session()->forget('cart');

            return redirect()->route('orders.success')->with('success', 'Pesanan berhasil dibuat!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
