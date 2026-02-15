@extends('layouts.app')

@section('title', 'Yeni Teklif')

@section('content')
<div class="max-w-4xl mx-auto">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Yeni Teklif</h1>
    
    <form action="{{ route('quotes.store') }}" method="POST" class="bg-white rounded-lg shadow p-6">
        @csrf
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Müşteri</label>
                <select name="customer_id" class="w-full border-gray-300 rounded-lg shadow-sm" required>
                    <option value="">Seçiniz...</option>
                    @foreach($customers ?? [] as $customer)
                    <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                    @endforeach
                </select>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Geçerlilik Tarihi</label>
                <input type="date" name="valid_until" class="w-full border-gray-300 rounded-lg shadow-sm">
            </div>
        </div>
        
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">Notlar</label>
            <textarea name="notes" rows="3" class="w-full border-gray-300 rounded-lg shadow-sm"></textarea>
        </div>
        
        <div class="flex justify-end space-x-3">
            <a href="{{ route('quotes.index') }}" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">İptal</a>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Kaydet</button>
        </div>
    </form>
</div>
@endsection
