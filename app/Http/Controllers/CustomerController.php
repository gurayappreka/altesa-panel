<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::latest()->paginate(15);
        return view('customers.index', compact('customers'));
    }

    public function create()
    {
        return view('customers.create');
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

        Customer::create($validated);

        return redirect()->route('customers.index')->with('success', 'Müşteri başarıyla oluşturuldu.');
    }

    public function show(Customer $customer)
    {
        $customer->load(['quotes', 'projects']);
        return view('customers.show', compact('customer'));
    }

    public function edit(Customer $customer)
    {
        return view('customers.edit', compact('customer'));
    }

    public function update(Request $request, Customer $customer)
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

        $customer->update($validated);

        return redirect()->route('customers.index')->with('success', 'Müşteri başarıyla güncellendi.');
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect()->route('customers.index')->with('success', 'Müşteri başarıyla silindi.');
    }
}
