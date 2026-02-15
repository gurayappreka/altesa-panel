@extends('layouts.app')
@section('title', 'Tedarikçiler')
@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Tedarikçiler</h1>
    <a href="{{ route('suppliers.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">+ Yeni Tedarikçi</a>
</div>
<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Ad</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Firma</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Telefon</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">E-posta</th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">İşlemler</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse($suppliers ?? [] as $supplier)
            <tr>
                <td class="px-6 py-4 whitespace-nowrap font-medium">{{ $supplier->name }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $supplier->company ?? '-' }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $supplier->phone ?? '-' }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $supplier->email ?? '-' }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-right">
                    <a href="{{ route('suppliers.edit', $supplier) }}" class="text-yellow-600 hover:text-yellow-900">Düzenle</a>
                </td>
            </tr>
            @empty
            <tr><td colspan="5" class="px-6 py-4 text-center text-gray-500">Henüz tedarikçi bulunmuyor.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
