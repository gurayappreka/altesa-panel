@extends('layouts.app')
@section('title', 'Teklif Düzenle')
@section('content')
<div class="max-w-4xl mx-auto">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Teklif Düzenle</h1>
    <form action="{{ route('quotes.update', $quote ?? 1) }}" method="POST" class="bg-white rounded-lg shadow p-6">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Müşteri</label>
                <select name="customer_id" class="w-full border-gray-300 rounded-lg shadow-sm">
                    @foreach($customers ?? [] as $customer)
                    <option value="{{ $customer->id }}" {{ ($quote->customer_id ?? '') == $customer->id ? 'selected' : '' }}>{{ $customer->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Durum</label>
                <select name="status" class="w-full border-gray-300 rounded-lg shadow-sm">
                    <option value="draft">Hazırlanıyor</option>
                    <option value="sent">Gönderildi</option>
                    <option value="approved">Onaylandı</option>
                    <option value="rejected">Reddedildi</option>
                </select>
            </div>
        </div>
        <div class="flex justify-end space-x-3">
            <a href="{{ route('quotes.index') }}" class="px-4 py-2 border border-gray-300 rounded-lg">İptal</a>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Güncelle</button>
        </div>
    </form>
</div>
@endsection
