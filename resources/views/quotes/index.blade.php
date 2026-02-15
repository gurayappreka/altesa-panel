@extends('layouts.app')

@section('title', 'Teklifler')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Teklifler</h1>
    <a href="{{ route('quotes.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
        + Yeni Teklif
    </a>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Teklif No</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Müşteri</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Toplam</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Durum</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tarih</th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">İşlemler</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse($quotes ?? [] as $quote)
            <tr>
                <td class="px-6 py-4 whitespace-nowrap font-medium">{{ $quote->quote_no }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $quote->customer->name ?? '-' }}</td>
                <td class="px-6 py-4 whitespace-nowrap">₺{{ number_format($quote->total, 2) }}</td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span class="px-2 py-1 text-xs rounded-full 
                        @if($quote->status == 'approved') bg-green-100 text-green-800
                        @elseif($quote->status == 'sent') bg-blue-100 text-blue-800
                        @elseif($quote->status == 'rejected') bg-red-100 text-red-800
                        @else bg-yellow-100 text-yellow-800 @endif">
                        {{ ucfirst($quote->status) }}
                    </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $quote->created_at->format('d.m.Y') }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-right">
                    <a href="{{ route('quotes.show', $quote) }}" class="text-blue-600 hover:text-blue-900 mr-3">Görüntüle</a>
                    <a href="{{ route('quotes.edit', $quote) }}" class="text-yellow-600 hover:text-yellow-900">Düzenle</a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="px-6 py-4 text-center text-gray-500">Henüz teklif bulunmuyor.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
