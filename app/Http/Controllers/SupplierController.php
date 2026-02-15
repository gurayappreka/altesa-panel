<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::latest()->paginate(15);
        return view('suppliers.index', compact('suppliers'));
    }

    public function create()
    {
        return view('suppliers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'company' => 'nullable|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|max:50',
            'address' => 'nullable',
            'tax_number' => 'nullable|max:50',
            'tax_office' => 'nullable|max:100',
            'notes' => 'nullable',
            'is_active' => 'boolean',
        ]);

        Supplier::create($validated);

        return redirect()->route('suppliers.index')->with('success', 'Tedarikçi başarıyla oluşturuldu.');
    }

    public function show(Supplier $supplier)
    {
        $supplier->load(['products', 'purchases']);
        return view('suppliers.show', compact('supplier'));
    }

    public function edit(Supplier $supplier)
    {
        return view('suppliers.edit', compact('supplier'));
    }

    public function update(Request $request, Supplier $supplier)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'company' => 'nullable|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|max:50',
            'address' => 'nullable',
            'tax_number' => 'nullable|max:50',
            'tax_office' => 'nullable|max:100',
            'notes' => 'nullable',
            'is_active' => 'boolean',
        ]);

        $supplier->update($validated);

        return redirect()->route('suppliers.index')->with('success', 'Tedarikçi başarıyla güncellendi.');
    }

    public function destroy(Supplier $supplier)
    {
        $supplier->delete();
        return redirect()->route('suppliers.index')->with('success', 'Tedarikçi başarıyla silindi.');
    }
}
