@extends('layouts.app')
@section('title', 'Yeni Satın Alma Talebi')
@section('content')
<div class="max-w-2xl mx-auto">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Yeni Satın Alma Talebi</h1>
    <form action="{{ route('purchases.store') }}" method="POST" class="bg-white rounded-lg shadow p-6">
        @csrf
        <div class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Tedarikçi</label>
                <select name="supplier_id" class="w-full border-gray-300 rounded-lg shadow-sm">
                    <option value="">Seçiniz...</option>
                    @foreach($suppliers ?? [] as $supplier)
                    <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Beklenen Teslim Tarihi</label>
                <input type="date" name="expected_date" class="w-full border-gray-300 rounded-lg shadow-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Notlar</label>
                <textarea name="notes" rows="3" class="w-full border-gray-300 rounded-lg shadow-sm"></textarea>
            </div>
        </div>
        <div class="flex justify-end space-x-3 mt-6">
            <a href="{{ route('purchases.index') }}" class="px-4 py-2 border border-gray-300 rounded-lg">İptal</a>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Kaydet</button>
        </div>
    </form>
</div>
@endsection
