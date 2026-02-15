<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\Supplier;
use App\Models\Product;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function index()
    {
        $purchases = Purchase::with(['supplier', 'user'])->latest()->paginate(15);
        return view('purchases.index', compact('purchases'));
    }

    public function create()
    {
        $suppliers = Supplier::active()->get();
        $products = Product::active()->get();
        return view('purchases.create', compact('suppliers', 'products'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'supplier_id' => 'nullable|exists:suppliers,id',
            'expected_date' => 'nullable|date',
            'notes' => 'nullable',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'nullable|exists:products,id',
            'items.*.description' => 'required|max:255',
            'items.*.quantity' => 'required|numeric|min:0.01',
            'items.*.unit' => 'required|max:20',
            'items.*.unit_price' => 'nullable|numeric|min:0',
        ]);

        $purchase = Purchase::create([
            'supplier_id' => $validated['supplier_id'],
            'user_id' => auth()->id(),
            'expected_date' => $validated['expected_date'],
            'notes' => $validated['notes'],
            'status' => 'pending',
        ]);

        foreach ($validated['items'] as $item) {
            $purchase->items()->create($item);
        }

        $purchase->calculateTotal();

        return redirect()->route('purchases.show', $purchase)->with('success', 'Satın alma talebi başarıyla oluşturuldu.');
    }

    public function show(Purchase $purchase)
    {
        $purchase->load(['supplier', 'user', 'items.product']);
        return view('purchases.show', compact('purchase'));
    }

    public function edit(Purchase $purchase)
    {
        $suppliers = Supplier::active()->get();
        $products = Product::active()->get();
        $purchase->load('items');
        return view('purchases.edit', compact('purchase', 'suppliers', 'products'));
    }

    public function update(Request $request, Purchase $purchase)
    {
        $validated = $request->validate([
            'supplier_id' => 'nullable|exists:suppliers,id',
            'status' => 'required|in:pending,ordered,delivered,cancelled',
            'expected_date' => 'nullable|date',
            'delivered_date' => 'nullable|date',
            'notes' => 'nullable',
        ]);

        $purchase->update($validated);

        return redirect()->route('purchases.show', $purchase)->with('success', 'Satın alma talebi başarıyla güncellendi.');
    }

    public function destroy(Purchase $purchase)
    {
        $purchase->delete();
        return redirect()->route('purchases.index')->with('success', 'Satın alma talebi başarıyla silindi.');
    }
}
