<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(): View
    {
        $products = Product::paginate(5);
        return view('dashboard.product', compact('products'));
    }

    public function create(): View
    {
        return view('dashboard.addProduct');
    }

    public function store(StoreProductRequest $request): RedirectResponse
    {
        $data = $request->validated();

        Product::create($data);

        return redirect()->route('product.index')->with('success', 'Produk berhasil ditambah');
    }

    public function edit(Product $product): View
    {
        return view('dashboard.editProduct', compact('product'));
    }

    public function update(UpdateProductRequest $request, Product $product): RedirectResponse
    {
        $data = $request->validated();

        $product->update($data);

        return redirect()->route('product.index')->with('success', 'Produk berhasil diubah');
    }


    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();

        return redirect()->route('product.index')->with('success', 'Produk berhasil dihapus');
    }
}
