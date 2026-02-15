@extends('layouts.app')
@section('title', 'Teklifler')
@section('content')
<div class="flex flex-col md:flex-row md:justify-between md:items-center mb-6 gap-4">
    <div>
        <h1 class="text-2xl font-bold text-gray-800">Teklifler</h1>
        <p class="text-gray-600">Toplam {{ $quotes->total() }} teklif</p>
    </div>
    <a href="{{ route('quotes.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        Yeni Teklif Oluştur
    </a>
</div>
<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Teklif No</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase hidden md:table-cell">Müşteri</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Toplam</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Durum</th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">İşlemler</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @forelse($quotes as $quote)
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4 font-medium">{{ $quote->quote_no }}</td>
                <td class="px-6 py-4 hidden md:table-cell">{{ $quote->customer->name ?? '-' }}</td>
                <td class="px-6 py-4">₺{{ number_format($quote->total, 2) }}</td>
                <td class="px-6 py-4">
                    <span class="px-2 py-1 text-xs rounded-full @if($quote->status=='approved')bg-green-100 text-green-800 @elseif($quote->status=='sent')bg-blue-100 text-blue-800 @elseif($quote->status=='rejected')bg-red-100 text-red-800 @else bg-yellow-100 text-yellow-800 @endif">
                        {{ ['draft'=>'Hazırlanıyor','sent'=>'Gönderildi','approved'=>'Onaylandı','rejected'=>'Reddedildi'][$quote->status] ?? $quote->status }}
                    </span>
                </td>
                <td class="px-6 py-4 text-right space-x-2">
                    <a href="{{ route('quotes.show', $quote) }}" class="text-blue-600 hover:text-blue-900">Görüntüle</a>
                    <a href="{{ route('quotes.edit', $quote) }}" class="text-yellow-600 hover:text-yellow-900">Düzenle</a>
                </td>
            </tr>
            @empty
            <tr><td colspan="5" class="px-6 py-12 text-center text-gray-500">
                <p>Henüz teklif yok.</p>
                <a href="{{ route('quotes.create') }}" class="mt-4 inline-flex items-center text-blue-600">+ Yeni Teklif Oluştur</a>
            </td></tr>
            @endforelse
        </tbody>
    </table>
    @if($quotes->hasPages())<div class="px-6 py-4 border-t">{{ $quotes->links() }}</div>@endif
</div>
@endsection
