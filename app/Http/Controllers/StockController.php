<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockMovement;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function alerts()
    {
        $products = Product::whereColumn('stock_quantity', '<=', 'min_stock_level')
            ->where('min_stock_level', '>', 0)
            ->get();
        return view('stock.alerts', compact('products'));
    }

    public function createIn()
    {
        $products = Product::orderBy('name')->get();
        return view('stock.in', compact('products'));
    }

    public function storeIn(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|numeric|min:0.01',
            'notes' => 'nullable|string',
        ]);

        $product = Product::find($validated['product_id']);
        $product->increment('stock_quantity', $validated['quantity']);

        StockMovement::create([
            'product_id' => $validated['product_id'],
            'type' => 'in',
            'quantity' => $validated['quantity'],
            'user_id' => auth()->id(),
            'notes' => $validated['notes'],
        ]);

        return redirect()->route('products.index')->with('success', 'Stok girişi yapıldı.');
    }

    public function createOut()
    {
        $products = Product::where('stock_quantity', '>', 0)->orderBy('name')->get();
        return view('stock.out', compact('products'));
    }

    public function storeOut(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|numeric|min:0.01',
            'notes' => 'nullable|string',
        ]);

        $product = Product::find($validated['product_id']);
        
        if ($product->stock_quantity < $validated['quantity']) {
            return back()->with('error', 'Yetersiz stok.');
        }

        $product->decrement('stock_quantity', $validated['quantity']);

        StockMovement::create([
            'product_id' => $validated['product_id'],
            'type' => 'out',
            'quantity' => $validated['quantity'],
            'user_id' => auth()->id(),
            'notes' => $validated['notes'],
        ]);

        return redirect()->route('products.index')->with('success', 'Stok çıkışı yapıldı.');
    }
}
