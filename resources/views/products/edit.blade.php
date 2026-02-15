@extends('layouts.app')
@section('title', 'Ürün Düzenle')
@section('content')
<div class="max-w-2xl mx-auto">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Ürün Düzenle</h1>
    <form action="{{ route('products.update', $product ?? 1) }}" method="POST" class="bg-white rounded-lg shadow p-6">
        @csrf
        @method('PUT')
        <div class="space-y-4">
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Ürün Adı *</label>
                    <input type="text" name="name" value="{{ $product->name ?? '' }}" class="w-full border-gray-300 rounded-lg shadow-sm" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">SKU</label>
                    <input type="text" name="sku" value="{{ $product->sku ?? '' }}" class="w-full border-gray-300 rounded-lg shadow-sm">
                </div>
            </div>
            <div class="grid grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Birim</label>
                    <input type="text" name="unit" value="{{ $product->unit ?? 'Adet' }}" class="w-full border-gray-300 rounded-lg shadow-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Stok</label>
                    <input type="number" name="stock_quantity" value="{{ $product->stock_quantity ?? 0 }}" class="w-full border-gray-300 rounded-lg shadow-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Min. Stok</label>
                    <input type="number" name="min_stock_level" value="{{ $product->min_stock_level ?? 0 }}" class="w-full border-gray-300 rounded-lg shadow-sm">
                </div>
            </div>
        </div>
        <div class="flex justify-end space-x-3 mt-6">
            <a href="{{ route('products.index') }}" class="px-4 py-2 border rounded-lg">İptal</a>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg">Güncelle</button>
        </div>
    </form>
</div>
@endsection
