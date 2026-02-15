@extends('layouts.app')
@section('title', 'Yeni Proje')
@section('content')
<div class="max-w-2xl mx-auto">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Yeni Proje</h1>
    <form action="{{ route('projects.store') }}" method="POST" class="bg-white rounded-lg shadow p-6">
        @csrf
        <div class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Proje Adı *</label>
                <input type="text" name="name" class="w-full border-gray-300 rounded-lg shadow-sm" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Müşteri</label>
                <select name="customer_id" class="w-full border-gray-300 rounded-lg shadow-sm">
                    <option value="">Seçiniz...</option>
                    @foreach($customers ?? [] as $customer)
                    <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Başlangıç Tarihi</label>
                    <input type="date" name="start_date" class="w-full border-gray-300 rounded-lg shadow-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Bitiş Tarihi</label>
                    <input type="date" name="end_date" class="w-full border-gray-300 rounded-lg shadow-sm">
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Açıklama</label>
                <textarea name="description" rows="3" class="w-full border-gray-300 rounded-lg shadow-sm"></textarea>
            </div>
        </div>
        <div class="flex justify-end space-x-3 mt-6">
            <a href="{{ route('projects.index') }}" class="px-4 py-2 border border-gray-300 rounded-lg">İptal</a>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Kaydet</button>
        </div>
    </form>
</div>
@endsection
