@extends('layouts.app')
@section('title', 'Stok Uyarıları')
@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Stok Uyarıları</h1>
    <p class="text-gray-600">Minimum stok seviyesinin altındaki ürünler</p>
</div>
<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-red-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-red-700 uppercase">Ürün</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-red-700 uppercase">Mevcut Stok</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-red-700 uppercase">Min. Stok</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-red-700 uppercase">Eksik</th>
                <th class="px-6 py-3 text-right text-xs font-medium text-red-700 uppercase">İşlem</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse($products ?? [] as $product)
            <tr class="bg-red-50">
                <td class="px-6 py-4 whitespace-nowrap font-medium">{{ $product->name }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-red-600 font-bold">{{ $product->stock_quantity }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $product->min_stock_level }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-red-600">{{ $product->min_stock_level - $product->stock_quantity }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-right">
                    <a href="{{ route('stock.in') }}" class="text-blue-600 hover:text-blue-900">Stok Girişi</a>
                </td>
            </tr>
            @empty
            <tr><td colspan="5" class="px-6 py-4 text-center text-green-600">✓ Tüm stoklar yeterli seviyede.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
