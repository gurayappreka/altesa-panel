@extends('layouts.app')
@section('title', 'Stok Girişi')
@section('content')
<div class="max-w-2xl mx-auto">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Stok Girişi</h1>
    <form action="{{ route('stock.in.store') }}" method="POST" class="bg-white rounded-lg shadow p-6">
        @csrf
        <div class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Ürün *</label>
                <select name="product_id" class="w-full border-gray-300 rounded-lg shadow-sm" required>
                    <option value="">Seçiniz...</option>
                    @foreach($products ?? [] as $product)
                    <option value="{{ $product->id }}">{{ $product->name }} (Stok: {{ $product->stock_quantity }})</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Miktar *</label>
                <input type="number" name="quantity" min="1" class="w-full border-gray-300 rounded-lg shadow-sm" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Açıklama</label>
                <textarea name="notes" rows="2" class="w-full border-gray-300 rounded-lg shadow-sm"></textarea>
            </div>
        </div>
        <div class="flex justify-end space-x-3 mt-6">
            <a href="{{ route('products.index') }}" class="px-4 py-2 border border-gray-300 rounded-lg">İptal</a>
            <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">Stok Girişi Yap</button>
        </div>
    </form>
</div>
@endsection
