<?php

namespace App\Http\Controllers;

use App\Models\Quote;
use App\Models\Customer;
use Illuminate\Http\Request;

class QuoteController extends Controller
{
    public function index()
    {
        $quotes = Quote::with('customer')->orderBy('created_at', 'desc')->paginate(15);
        return view('quotes.index', compact('quotes'));
    }

    public function create()
    {
        $customers = Customer::orderBy('name')->get();
        return view('quotes.create', compact('customers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'valid_until' => 'nullable|date',
            'notes' => 'nullable|string',
        ]);

        $validated['user_id'] = auth()->id();
        $validated['quote_no'] = 'TKL-' . date('Y') . '-' . str_pad(Quote::count() + 1, 5, '0', STR_PAD_LEFT);
        $validated['status'] = 'draft';

        Quote::create($validated);

        return redirect()->route('quotes.index')->with('success', 'Teklif oluşturuldu.');
    }

    public function show(Quote $quote)
    {
        $quote->load('customer', 'items');
        return view('quotes.show', compact('quote'));
    }

    public function edit(Quote $quote)
    {
        $customers = Customer::orderBy('name')->get();
        return view('quotes.edit', compact('quote', 'customers'));
    }

    public function update(Request $request, Quote $quote)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'status' => 'required|in:draft,sent,approved,rejected',
            'valid_until' => 'nullable|date',
            'notes' => 'nullable|string',
        ]);

        $quote->update($validated);

        return redirect()->route('quotes.index')->with('success', 'Teklif güncellendi.');
    }

    public function destroy(Quote $quote)
    {
        $quote->delete();
        return redirect()->route('quotes.index')->with('success', 'Teklif silindi.');
    }
}
