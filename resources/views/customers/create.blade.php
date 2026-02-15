@extends('layouts.app')

@section('title', 'Yeni Müşteri')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-6">
        <a href="{{ route('customers.index') }}" class="text-blue-600 hover:text-blue-800 flex items-center">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Müşterilere Dön
        </a>
        <h1 class="text-2xl font-bold text-gray-800 mt-2">Yeni Müşteri Ekle</h1>
    </div>

    <form action="{{ route('customers.store') }}" method="POST" class="bg-white rounded-lg shadow p-6">
        @csrf
        
        @if($errors->any())
        <div class="mb-4 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Ad Soyad <span class="text-red-500">*</span></label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label for="company" class="block text-sm font-medium text-gray-700 mb-2">Firma Adı</label>
                    <input type="text" name="company" id="company" value="{{ old('company') }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Telefon</label>
                    <input type="text" name="phone" id="phone" value="{{ old('phone') }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">E-posta</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="tax_number" class="block text-sm font-medium text-gray-700 mb-2">Vergi No</label>
                    <input type="text" name="tax_number" id="tax_number" value="{{ old('tax_number') }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label for="tax_office" class="block text-sm font-medium text-gray-700 mb-2">Vergi Dairesi</label>
                    <input type="text" name="tax_office" id="tax_office" value="{{ old('tax_office') }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>
            </div>

            <div>
                <label for="address" class="block text-sm font-medium text-gray-700 mb-2">Adres</label>
                <textarea name="address" id="address" rows="3"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ old('address') }}</textarea>
            </div>

            <div>
                <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">Notlar</label>
                <textarea name="notes" id="notes" rows="2"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ old('notes') }}</textarea>
            </div>
        </div>

        <div class="flex justify-end space-x-3 mt-6 pt-6 border-t">
            <a href="{{ route('customers.index') }}" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">
                İptal
            </a>
            <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                Müşteriyi Kaydet
            </button>
        </div>
    </form>
</div>
@endsection
