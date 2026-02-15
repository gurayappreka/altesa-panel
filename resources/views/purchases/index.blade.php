@extends('layouts.app')
@section('title', 'Satın Alma')
@section('content')
<div class="flex flex-col md:flex-row md:justify-between md:items-center mb-6 gap-4">
    <div>
        <h1 class="text-2xl font-bold text-gray-800">Satın Alma Talepleri</h1>
        <p class="text-gray-600">Toplam {{ $purchases->total() }} talep</p>
    </div>
    <a href="{{ route('purchases.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        Yeni Talep Oluştur
    </a>
</div>
<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Talep No</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase hidden md:table-cell">Tedarikçi</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Durum</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase hidden lg:table-cell">Tarih</th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">İşlemler</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @forelse($purchases as $purchase)
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4 font-medium">{{ $purchase->purchase_no }}</td>
                <td class="px-6 py-4 hidden md:table-cell">{{ $purchase->supplier->name ?? '-' }}</td>
                <td class="px-6 py-4">
                    <span class="px-2 py-1 text-xs rounded-full @if($purchase->status=='delivered')bg-green-100 text-green-800 @elseif($purchase->status=='ordered')bg-blue-100 text-blue-800 @else bg-yellow-100 text-yellow-800 @endif">
                        {{ ['pending'=>'Beklemede','ordered'=>'Sipariş Verildi','delivered'=>'Teslim Edildi','cancelled'=>'İptal'][$purchase->status] ?? $purchase->status }}
                    </span>
                </td>
                <td class="px-6 py-4 hidden lg:table-cell">{{ $purchase->created_at->format('d.m.Y') }}</td>
                <td class="px-6 py-4 text-right space-x-2">
                    <a href="{{ route('purchases.edit', $purchase) }}" class="text-yellow-600">Düzenle</a>
                </td>
            </tr>
            @empty
            <tr><td colspan="5" class="px-6 py-12 text-center text-gray-500">Henüz talep yok. <a href="{{ route('purchases.create') }}" class="text-blue-600">+ Ekle</a></td></tr>
            @endforelse
        </tbody>
    </table>
    @if($purchases->hasPages())<div class="px-6 py-4 border-t">{{ $purchases->links() }}</div>@endif
</div>
@endsection
