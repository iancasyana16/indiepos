<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(): View
    {
        $products = Product::all();
        return view('dashboard.product', compact('products'));
    }


    public function store(StoreProductRequest $request): RedirectResponse
    {
        $data = $request->validate();

        Product::create($data);

        return redirect()->back()->with('success', 'Produk berhasil ditambah');
    }


    public function update(UpdateProductRequest $request, Product $product): RedirectResponse
    {
        $data = $request->validate();

        $product->update($data);

        return redirect()->back()->with('success', 'Produk berhasil diubah');
    }


    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();

        return redirect()->back()->with('success', 'Produk berhasil dihapus');
    }
}
