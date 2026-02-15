<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('supplier')->latest()->paginate(15);
        return view('products.index', compact('products'));
    }

    public function create()
    {
        $suppliers = Supplier::active()->get();
        return view('products.create', compact('suppliers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'sku' => 'nullable|max:100|unique:products',
            'description' => 'nullable',
            'unit' => 'required|max:20',
            'stock_quantity' => 'required|numeric|min:0',
            'min_stock_level' => 'required|numeric|min:0',
            'supplier_id' => 'nullable|exists:suppliers,id',
            'location' => 'nullable|max:100',
            'is_active' => 'boolean',
        ]);

        Product::create($validated);

        return redirect()->route('products.index')->with('success', 'Ürün başarıyla oluşturuldu.');
    }

    public function show(Product $product)
    {
        $product->load(['supplier', 'stockMovements.user']);
        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $suppliers = Supplier::active()->get();
        return view('products.edit', compact('product', 'suppliers'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'sku' => 'nullable|max:100|unique:products,sku,' . $product->id,
            'description' => 'nullable',
            'unit' => 'required|max:20',
            'min_stock_level' => 'required|numeric|min:0',
            'supplier_id' => 'nullable|exists:suppliers,id',
            'location' => 'nullable|max:100',
            'is_active' => 'boolean',
        ]);

        $product->update($validated);

        return redirect()->route('products.index')->with('success', 'Ürün başarıyla güncellendi.');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Ürün başarıyla silindi.');
    }
}
