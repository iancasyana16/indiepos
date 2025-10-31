<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request): View
    {
        $query = Product::query();

        if ($search = $request->input('search')) {
            $query->where('name', 'like', "%{$search}%")
                ->orWhere('unit', 'like', "%{$search}%");
        }

        $filter = $request->input('sort', 'terbaru');

        if ($filter === 'terlama') {
            $query->oldest();
        } else {
            $query->latest();
        }

        $products = $query->paginate(5)->appends($request->only('search', 'filter'));

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
