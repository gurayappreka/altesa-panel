@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="space-y-6">
    <div>
        <h2 class="text-2xl font-bold text-gray-900">Dashboard</h2>
        <p class="text-gray-600">Hoş geldiniz, {{ auth()->user()->name }}</p>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <div class="card">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Aktif Müşteriler</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['customers'] }}</p>
                </div>
                <div class="p-3 bg-blue-100 rounded-full">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Bekleyen Teklifler</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['quotes'] }}</p>
                </div>
                <div class="p-3 bg-yellow-100 rounded-full">
                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Satın Alma Talepleri</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['purchases'] }}</p>
                </div>
                <div class="p-3 bg-green-100 rounded-full">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Düşük Stok Uyarıları</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['low_stock'] }}</p>
                </div>
                <div class="p-3 bg-red-100 rounded-full">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Aktif Projeler</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['active_projects'] }}</p>
                </div>
                <div class="p-3 bg-purple-100 rounded-full">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Görevlerim</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['my_tasks'] }}</p>
                </div>
                <div class="p-3 bg-indigo-100 rounded-full">
                    <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Quotes & Tasks -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="card">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Son Teklifler</h3>
            <div class="space-y-3">
                @forelse($recent_quotes as $quote)
                <div class="flex items-center justify-between py-2 border-b last:border-0">
                    <div>
                        <p class="font-medium text-gray-900">{{ $quote->quote_no }}</p>
                        <p class="text-sm text-gray-600">{{ $quote->customer->name }}</p>
                    </div>
                    <span class="badge badge-{{ $quote->status_color }}">
                        {{ $quote->status_label }}
                    </span>
                </div>
                @empty
                <p class="text-gray-500 text-center py-4">Henüz teklif yok</p>
                @endforelse
            </div>
        </div>

        <div class="card">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Görevlerim</h3>
            <div class="space-y-3">
                @forelse($my_tasks as $task)
                <div class="flex items-center justify-between py-2 border-b last:border-0">
                    <div>
                        <p class="font-medium text-gray-900">{{ $task->title }}</p>
                        <p class="text-sm text-gray-600">{{ $task->project->name }}</p>
                    </div>
                    <span class="badge badge-{{ $task->status_color }}">
                        {{ $task->status_label }}
                    </span>
                </div>
                @empty
                <p class="text-gray-500 text-center py-4">Görev yok</p>
                @endforelse
            </div>
        </div>
    </div>

    @if($low_stock_products->count() > 0)
    <div class="card">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Düşük Stok Uyarıları</h3>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Ürün</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Stok</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Min. Seviye</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Tedarikçi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($low_stock_products as $product)
                    <tr>
                        <td class="px-4 py-3 text-sm">{{ $product->name }}</td>
                        <td class="px-4 py-3 text-sm text-red-600 font-medium">{{ $product->stock_quantity }} {{ $product->unit }}</td>
                        <td class="px-4 py-3 text-sm">{{ $product->min_stock_level }} {{ $product->unit }}</td>
                        <td class="px-4 py-3 text-sm">{{ $product->supplier->name ?? '-' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif
</div>
@endsection
