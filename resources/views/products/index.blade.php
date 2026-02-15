@extends('layouts.app')
@section('title', 'Ürünler')
@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Ürünler / Stok</h1>
    <a href="{{ route('products.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">+ Yeni Ürün</a>
</div>
<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">SKU</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Ürün Adı</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Stok</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Min. Stok</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Birim</th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">İşlemler</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse($products ?? [] as $product)
            <tr class="{{ $product->stock_quantity <= $product->min_stock_level ? 'bg-red-50' : '' }}">
                <td class="px-6 py-4 whitespace-nowrap font-mono text-sm">{{ $product->sku ?? '-' }}</td>
                <td class="px-6 py-4 whitespace-nowrap font-medium">{{ $product->name }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $product->stock_quantity }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $product->min_stock_level }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $product->unit }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-right">
                    <a href="{{ route('products.edit', $product) }}" class="text-yellow-600 hover:text-yellow-900">Düzenle</a>
                </td>
            </tr>
            @empty
            <tr><td colspan="6" class="px-6 py-4 text-center text-gray-500">Henüz ürün bulunmuyor.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
