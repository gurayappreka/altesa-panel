@extends('layouts.app')
@section('title', 'Tedarikçiler')
@section('content')
<div class="flex flex-col md:flex-row md:justify-between md:items-center mb-6 gap-4">
    <div>
        <h1 class="text-2xl font-bold text-gray-800">Tedarikçiler</h1>
        <p class="text-gray-600">Toplam {{ $suppliers->total() }} tedarikçi</p>
    </div>
    <a href="{{ route('suppliers.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        Yeni Tedarikçi Ekle
    </a>
</div>
<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Ad</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase hidden md:table-cell">Firma</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase hidden lg:table-cell">Telefon</th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">İşlemler</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @forelse($suppliers as $supplier)
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4 font-medium">{{ $supplier->name }}</td>
                <td class="px-6 py-4 hidden md:table-cell">{{ $supplier->company ?? '-' }}</td>
                <td class="px-6 py-4 hidden lg:table-cell">{{ $supplier->phone ?? '-' }}</td>
                <td class="px-6 py-4 text-right space-x-2">
                    <a href="{{ route('suppliers.edit', $supplier) }}" class="text-yellow-600">Düzenle</a>
                    <form action="{{ route('suppliers.destroy', $supplier) }}" method="POST" class="inline" onsubmit="return confirm('Silmek istediğinize emin misiniz?')">@csrf @method('DELETE')<button class="text-red-600">Sil</button></form>
                </td>
            </tr>
            @empty
            <tr><td colspan="4" class="px-6 py-12 text-center text-gray-500">Henüz tedarikçi yok. <a href="{{ route('suppliers.create') }}" class="text-blue-600">+ Ekle</a></td></tr>
            @endforelse
        </tbody>
    </table>
    @if($suppliers->hasPages())<div class="px-6 py-4 border-t">{{ $suppliers->links() }}</div>@endif
</div>
@endsection
