@extends('layouts.app')
@section('title', 'Teklif Detayı')
@section('content')
<div class="max-w-4xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">{{ $quote->quote_no ?? 'Teklif' }}</h1>
        <div class="space-x-2">
            <a href="{{ route('quotes.edit', $quote ?? 1) }}" class="px-4 py-2 bg-yellow-500 text-white rounded-lg">Düzenle</a>
            <a href="{{ route('quotes.index') }}" class="px-4 py-2 border rounded-lg">Geri</a>
        </div>
    </div>
    <div class="bg-white rounded-lg shadow p-6">
        <p class="text-gray-600">Teklif detayları burada görüntülenecek.</p>
    </div>
</div>
@endsection
