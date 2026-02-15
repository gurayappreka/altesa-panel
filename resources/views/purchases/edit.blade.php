@extends('layouts.app')
@section('title', 'Satın Alma Düzenle')
@section('content')
<div class="max-w-2xl mx-auto">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Satın Alma Düzenle</h1>
    <form action="{{ route('purchases.update', $purchase ?? 1) }}" method="POST" class="bg-white rounded-lg shadow p-6">
        @csrf
        @method('PUT')
        <div class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Durum</label>
                <select name="status" class="w-full border-gray-300 rounded-lg shadow-sm">
                    <option value="pending">Beklemede</option>
                    <option value="ordered">Sipariş Verildi</option>
                    <option value="delivered">Teslim Edildi</option>
                    <option value="cancelled">İptal</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Notlar</label>
                <textarea name="notes" rows="3" class="w-full border-gray-300 rounded-lg shadow-sm">{{ $purchase->notes ?? '' }}</textarea>
            </div>
        </div>
        <div class="flex justify-end space-x-3 mt-6">
            <a href="{{ route('purchases.index') }}" class="px-4 py-2 border rounded-lg">İptal</a>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg">Güncelle</button>
        </div>
    </form>
</div>
@endsection
