<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
        //     $cart = session('cart', []);

        //     if (empty($cart)) {
        //         return redirect()->back()->with('error', 'Keranjang masih kosong.');
        //     }

        $cart = [
            3 => ['name' => 'Banner', 'length' => 5, 'width' => 3, 'qty' => 1],
            1 => ['name' => 'Kartu Nama', 'qty' => 1],
        ];

        DB::beginTransaction();

        try {
            $customer = Customer::firstOrCreate(
                ['number' => $validated['number']],
                [
                    'name' => $validated['name'],
                    'address' => $validated['address'],
                ]
            );

            $order = Order::create([
                'customer_id' => $customer->id,
                'order_date' => now(),
                'status' => 'dipesan',
                'price_total' => 0,
                'dp_total' => $validated['dp_total'],
            ]);

            $total = 0;

            foreach ($cart as $productId => $item) {
                $product = Product::find($productId);
                if (!$product) {
                    throw new \Exception("Produk dengan ID {$productId} tidak ditemukan");
                }

                // Validasi dimensi jika satuan m2
                if ($product->unit === 'm2' && (!isset($item['length']) || !isset($item['width']))) {
                    throw new \Exception("Produk {$product->name} memerlukan panjang dan lebar.");
                }

                // Hitung subtotal
                if ($product->unit === 'm2') {
                    $subtotal = $item['length'] * $item['width'] * $product->price_unit * $item['qty'];
                } elseif ($product->unit === 'cm2') {
                    $area_m2 = ($item['length'] * $item['width']) / 10000;
                    $subtotal = $area_m2 * $product->price_unit * $item['qty'];
                } else {
                    $subtotal = $product->price_unit * $item['qty'];
                }

                $total += $subtotal;

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $productId,
                    'length' => $item['length'] ?? null,
                    'width' => $item['width'] ?? null,
                    'qty' => $item['qty'],
                    'price' => $subtotal,
                ]);
            }

            $order->update(['price_total' => $total]);

            DB::commit();

            session()->forget('cart');

            return response()->json([
                'success' => true,
                'message' => 'Pesanan berhasil dibuat!',
                'order' => $order,
                'customer' => $customer,
                'cart' => $cart,
                'total_harga' => $total
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }


    public function clearCart()
    {
        session()->forget('cart');
        return redirect()->route('order.index')->with('success', 'Keranjang dikosongkan!');
    }
}
