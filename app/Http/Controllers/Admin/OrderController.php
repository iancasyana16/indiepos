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
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Ambil produk, bisa difilter berdasarkan nama
        $query = Product::query();

        if ($search) {
            $query->where('name', 'like', "%{$search}%");
        }

        $products = $query->get();
        $cart = session('cart', []);

        return view('dashboard.order', compact('products', 'cart'));
    }

    // Tambahkan produk ke keranjang
    public function addToCart(Request $request, Product $product)
    {
        $cart = session()->get('cart', []);

        $qty = (int) $request->input('qty', 1);
        $description = (string) $request->input('description');

        if ($product->unit !== 'pcs') {
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
                    'description' => $description
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
                    'description' => $description,
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
            // Buat atau ambil customer berdasarkan nomor HP / identitas unik
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
                'status' => 'diproses',
                'price_total' => 0,
                'dp_total' => $validated['dp_total'],
            ]);

            $total = 0;

            foreach ($cart as $key => $item) {
                $length_m = null;
                $width_m = null;
                // Ambil ID asli produk dari key unik di session
                $productId = explode('-', $key)[0];

                /** @var \App\Models\Product $product */
                $product = Product::findOrFail($productId);

                // Validasi untuk produk dengan satuan m2
                if ($product->unit !== 'pcs' && (!isset($item['length']) || !isset($item['width']))) {
                    throw new \Exception("Produk {$product->name} memerlukan panjang dan lebar.");
                }

                // Konversi cm → meter (hanya jika produk per m2)
                if ($product->unit === 'm2') {
                    $length_m = isset($item['length']) ? $item['length'] / 100 : null;
                    $width_m  = isset($item['width']) ? $item['width'] / 100 : null;
                } elseif ($product->unit === 'cm2') {
                    $length_m = isset($item['length']) ? $item['length'] : null;
                    $width_m  = isset($item['width']) ? $item['width'] : null;
                }
                
                // Hitung subtotal
                if ($product->unit !== 'pcs') {
                    $subtotal = $length_m * $width_m * $product->price_unit * $item['qty'];
                } else {
                    $subtotal = $product->price_unit * $item['qty'];
                }

                $total += $subtotal;

                // Simpan ke order_items (panjang & lebar dalam meter)
                OrderItem::create([
                    'order_id'   => $order->id,
                    'product_id' => $productId,
                    'length'     => $length_m,
                    'width'      => $width_m,
                    'qty'        => $item['qty'],
                    'price'      => $subtotal,
                    'description' => $item['description'],
                ]);
            }

            // Update total harga di order
            $order->update(['price_total' => $total]);

            DB::commit();

            // Kosongkan keranjang
            session()->forget('cart');

            return redirect()->route('history-order.index')->with('success', 'Pesanan berhasil dibuat.');
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
