@extends('layouts.app')
@section('title', 'Müşteri Düzenle')
@section('content')
<div class="max-w-2xl mx-auto">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Müşteri Düzenle</h1>
    <form action="{{ route('customers.update', $customer ?? 1) }}" method="POST" class="bg-white rounded-lg shadow p-6">
        @csrf
        @method('PUT')
        <div class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Ad Soyad *</label>
                <input type="text" name="name" value="{{ $customer->name ?? '' }}" class="w-full border-gray-300 rounded-lg shadow-sm" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Firma</label>
                <input type="text" name="company" value="{{ $customer->company ?? '' }}" class="w-full border-gray-300 rounded-lg shadow-sm">
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Telefon</label>
                    <input type="text" name="phone" value="{{ $customer->phone ?? '' }}" class="w-full border-gray-300 rounded-lg shadow-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">E-posta</label>
                    <input type="email" name="email" value="{{ $customer->email ?? '' }}" class="w-full border-gray-300 rounded-lg shadow-sm">
                </div>
            </div>
        </div>
        <div class="flex justify-end space-x-3 mt-6">
            <a href="{{ route('customers.index') }}" class="px-4 py-2 border rounded-lg">İptal</a>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg">Güncelle</button>
        </div>
    </form>
</div>
@endsection
