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

        $qty = (int) $request->input('qty', 1);

        if ($product->unit === 'm2') {
            $length = (float) $request->input('length', 1);
            $width = (float) $request->input('width', 1);

            // Buat key unik: id-lengthxwidth
            $key = $product->id . '-' . $length . 'x' . $width;

            if (isset($cart[$key])) {
                $cart[$key]['qty'] += $qty;
            } else {
                $cart[$key] = [
                    'name' => $product->name,
                    'price' => $product->price_unit,
                    'qty' => $qty,
                    'unit' => $product->unit,
                    'length' => $length,
                    'width' => $width,
                ];
            }
        } else {
            // Kalau pcs atau unit lain, hanya qty saja
            if (isset($cart[$product->id])) {
                $cart[$product->id]['qty'] += $qty;
            } else {
                $cart[$product->id] = [
                    'name' => $product->name,
                    'price' => $product->price_unit,
                    'unit' => $product->unit,

                    'qty' => $qty,
                ];
            }
        }

        session()->put('cart', $cart);

        return redirect()->route('order.index')->with('success', 'Produk ditambahkan ke keranjang!');
    }


    public function incrementCart($id)
    {
        $cart = session('cart', []);
        if (isset($cart[$id])) {
            $cart[$id]['qty'] += 1;
            session(['cart' => $cart]);
        }

        return back();
    }

    public function decrementCart($id)
    {
        $cart = session('cart', []);
        if (isset($cart[$id])) {
            if ($cart[$id]['qty'] > 1) {
                $cart[$id]['qty'] -= 1;
            } else {
                unset($cart[$id]);
            }
            session(['cart' => $cart]);
        }

        return back();
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

            foreach ($cart as $key => $item) {
                // Ambil ID asli produk dari key unik (misalnya "1-2x3" jadi "1")
                $productId = explode('-', $key)[0];
                $product = Product::find($productId);

                if (!$product) {
                    throw new \Exception("Produk dengan ID {$productId} tidak ditemukan");
                }

                // Validasi dimensi kalau unit m2
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
                    'order_id'   => $order->id,
                    'product_id' => $productId,
                    'length'     => $item['length'] ?? null,
                    'width'      => $item['width'] ?? null,
                    'qty'        => $item['qty'],
                    'price'      => $subtotal,
                ]);
            }


            $order->update(['price_total' => $total]);

            DB::commit();

            session()->forget('cart');

            return redirect()->route('history-order.index')->with('success', 'Pesanan berhasil dibuat');
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
