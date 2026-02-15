<?php

namespace App\Http\Controllers;

use App\Models\Quote;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Http\Request;

class QuoteController extends Controller
{
    public function index()
    {
        $quotes = Quote::with(['customer', 'user'])->latest()->paginate(15);
        return view('quotes.index', compact('quotes'));
    }

    public function create()
    {
        $customers = Customer::active()->get();
        $products = Product::active()->get();
        return view('quotes.create', compact('customers', 'products'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'valid_until' => 'nullable|date',
            'notes' => 'nullable',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'nullable|exists:products,id',
            'items.*.description' => 'required|max:255',
            'items.*.quantity' => 'required|numeric|min:0.01',
            'items.*.unit' => 'required|max:20',
            'items.*.unit_price' => 'required|numeric|min:0',
        ]);

        $quote = Quote::create([
            'customer_id' => $validated['customer_id'],
            'user_id' => auth()->id(),
            'valid_until' => $validated['valid_until'],
            'notes' => $validated['notes'],
            'status' => 'draft',
        ]);

        foreach ($validated['items'] as $item) {
            $quote->items()->create($item);
        }

        $quote->calculateTotals();

        return redirect()->route('quotes.show', $quote)->with('success', 'Teklif başarıyla oluşturuldu.');
    }

    public function show(Quote $quote)
    {
        $quote->load(['customer', 'user', 'items.product']);
        return view('quotes.show', compact('quote'));
    }

    public function edit(Quote $quote)
    {
        $customers = Customer::active()->get();
        $products = Product::active()->get();
        $quote->load('items');
        return view('quotes.edit', compact('quote', 'customers', 'products'));
    }

    public function update(Request $request, Quote $quote)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'status' => 'required|in:draft,sent,approved,rejected',
            'valid_until' => 'nullable|date',
            'notes' => 'nullable',
        ]);

        $quote->update($validated);

        return redirect()->route('quotes.show', $quote)->with('success', 'Teklif başarıyla güncellendi.');
    }

    public function destroy(Quote $quote)
    {
        $quote->delete();
        return redirect()->route('quotes.index')->with('success', 'Teklif başarıyla silindi.');
    }
}
