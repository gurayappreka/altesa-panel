@extends('layouts.app')
@section('title', 'Ürünler')
@section('content')
<div class="flex flex-col md:flex-row md:justify-between md:items-center mb-6 gap-4">
    <div>
        <h1 class="text-2xl font-bold text-gray-800">Ürünler / Stok</h1>
        <p class="text-gray-600">Toplam {{ $products->total() }} ürün</p>
    </div>
    <div class="flex space-x-2">
        <a href="{{ route('stock.in') }}" class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg">+ Stok Girişi</a>
        <a href="{{ route('stock.out') }}" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg">- Stok Çıkışı</a>
        <a href="{{ route('products.create') }}" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg">+ Yeni Ürün</a>
    </div>
</div>
<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">SKU</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Ürün Adı</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Stok</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase hidden md:table-cell">Min.</th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">İşlemler</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @forelse($products as $product)
            <tr class="hover:bg-gray-50 {{ $product->stock_quantity <= $product->min_stock_level && $product->min_stock_level > 0 ? 'bg-red-50' : '' }}">
                <td class="px-6 py-4 font-mono text-sm">{{ $product->sku ?? '-' }}</td>
                <td class="px-6 py-4 font-medium">{{ $product->name }}</td>
                <td class="px-6 py-4 {{ $product->stock_quantity <= $product->min_stock_level && $product->min_stock_level > 0 ? 'text-red-600 font-bold' : '' }}">{{ $product->stock_quantity }} {{ $product->unit }}</td>
                <td class="px-6 py-4 hidden md:table-cell">{{ $product->min_stock_level }}</td>
                <td class="px-6 py-4 text-right space-x-2">
                    <a href="{{ route('products.edit', $product) }}" class="text-yellow-600">Düzenle</a>
                    <form action="{{ route('products.destroy', $product) }}" method="POST" class="inline" onsubmit="return confirm('Silmek istediğinize emin misiniz?')">@csrf @method('DELETE')<button class="text-red-600">Sil</button></form>
                </td>
            </tr>
            @empty
            <tr><td colspan="5" class="px-6 py-12 text-center text-gray-500">Henüz ürün yok. <a href="{{ route('products.create') }}" class="text-blue-600">+ Ekle</a></td></tr>
            @endforelse
        </tbody>
    </table>
    @if($products->hasPages())<div class="px-6 py-4 border-t">{{ $products->links() }}</div>@endif
</div>
@endsection
