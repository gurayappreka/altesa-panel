@extends('layouts.app')

@section('title', 'Müşteriler')

@section('content')
<div class="flex flex-col md:flex-row md:justify-between md:items-center mb-6 gap-4">
    <div>
        <h1 class="text-2xl font-bold text-gray-800">Müşteriler</h1>
        <p class="text-gray-600">Toplam {{ $customers->total() }} müşteri</p>
    </div>
    <a href="{{ route('customers.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Yeni Müşteri Ekle
    </a>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Müşteri</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden md:table-cell">Firma</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden lg:table-cell">Telefon</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden lg:table-cell">E-posta</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">İşlemler</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($customers as $customer)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="font-medium text-gray-900">{{ $customer->name }}</div>
                        <div class="text-sm text-gray-500 md:hidden">{{ $customer->company ?? '' }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap hidden md:table-cell text-gray-500">{{ $customer->company ?? '-' }}</td>
                    <td class="px-6 py-4 whitespace-nowrap hidden lg:table-cell text-gray-500">{{ $customer->phone ?? '-' }}</td>
                    <td class="px-6 py-4 whitespace-nowrap hidden lg:table-cell text-gray-500">{{ $customer->email ?? '-' }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2">
                        <a href="{{ route('customers.show', $customer) }}" class="text-blue-600 hover:text-blue-900">Görüntüle</a>
                        <a href="{{ route('customers.edit', $customer) }}" class="text-yellow-600 hover:text-yellow-900">Düzenle</a>
                        <form action="{{ route('customers.destroy', $customer) }}" method="POST" class="inline" onsubmit="return confirm('Silmek istediğinize emin misiniz?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900">Sil</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">Müşteri bulunamadı</h3>
                        <p class="mt-1 text-sm text-gray-500">Yeni bir müşteri ekleyerek başlayın.</p>
                        <div class="mt-6">
                            <a href="{{ route('customers.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                </svg>
                                Yeni Müşteri Ekle
                            </a>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    @if($customers->hasPages())
    <div class="px-6 py-4 border-t">
        {{ $customers->links() }}
    </div>
    @endif
</div>
@endsection
