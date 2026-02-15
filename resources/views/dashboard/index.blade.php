@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Dashboard</h1>
    <p class="text-gray-600">Hoş geldin, {{ auth()->user()->name }}!</p>
</div>

<!-- Stats -->
<div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4 mb-8">
    <div class="bg-white rounded-lg shadow p-4">
        <div class="text-3xl font-bold text-blue-600">{{ $stats['customers'] ?? 0 }}</div>
        <div class="text-gray-500 text-sm">Müşteri</div>
    </div>
    <div class="bg-white rounded-lg shadow p-4">
        <div class="text-3xl font-bold text-green-600">{{ $stats['quotes'] ?? 0 }}</div>
        <div class="text-gray-500 text-sm">Teklif</div>
    </div>
    <div class="bg-white rounded-lg shadow p-4">
        <div class="text-3xl font-bold text-purple-600">{{ $stats['projects'] ?? 0 }}</div>
        <div class="text-gray-500 text-sm">Aktif Proje</div>
    </div>
    <div class="bg-white rounded-lg shadow p-4">
        <div class="text-3xl font-bold text-indigo-600">{{ $stats['products'] ?? 0 }}</div>
        <div class="text-gray-500 text-sm">Ürün</div>
    </div>
    <div class="bg-white rounded-lg shadow p-4">
        <div class="text-3xl font-bold text-yellow-600">{{ $stats['purchases'] ?? 0 }}</div>
        <div class="text-gray-500 text-sm">Bekleyen Sipariş</div>
    </div>
    <div class="bg-white rounded-lg shadow p-4">
        <div class="text-3xl font-bold {{ ($stats['low_stock'] ?? 0) > 0 ? 'text-red-600' : 'text-green-600' }}">{{ $stats['low_stock'] ?? 0 }}</div>
        <div class="text-gray-500 text-sm">Düşük Stok</div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- Son Teklifler -->
    <div class="bg-white rounded-lg shadow">
        <div class="p-4 border-b">
            <h2 class="font-bold text-gray-800">Son Teklifler</h2>
        </div>
        <div class="p-4">
            @forelse($recentQuotes ?? [] as $quote)
            <div class="flex justify-between items-center py-2 border-b last:border-0">
                <div>
                    <div class="font-medium">{{ $quote->quote_no }}</div>
                    <div class="text-sm text-gray-500">{{ $quote->customer->name ?? '-' }}</div>
                </div>
                <span class="px-2 py-1 text-xs rounded-full 
                    @if($quote->status == 'approved') bg-green-100 text-green-800
                    @elseif($quote->status == 'sent') bg-blue-100 text-blue-800
                    @else bg-yellow-100 text-yellow-800 @endif">
                    {{ $quote->status }}
                </span>
            </div>
            @empty
            <p class="text-gray-500 text-center py-4">Henüz teklif yok.</p>
            @endforelse
        </div>
    </div>

    <!-- Son Projeler -->
    <div class="bg-white rounded-lg shadow">
        <div class="p-4 border-b">
            <h2 class="font-bold text-gray-800">Son Projeler</h2>
        </div>
        <div class="p-4">
            @forelse($recentProjects ?? [] as $project)
            <div class="flex justify-between items-center py-2 border-b last:border-0">
                <div>
                    <div class="font-medium">{{ $project->name }}</div>
                    <div class="text-sm text-gray-500">{{ $project->customer->name ?? '-' }}</div>
                </div>
                <span class="px-2 py-1 text-xs rounded-full 
                    @if($project->status == 'completed') bg-green-100 text-green-800
                    @elseif($project->status == 'active') bg-blue-100 text-blue-800
                    @else bg-gray-100 text-gray-800 @endif">
                    {{ $project->status }}
                </span>
            </div>
            @empty
            <p class="text-gray-500 text-center py-4">Henüz proje yok.</p>
            @endforelse
        </div>
    </div>
</div>

<!-- Görevlerim -->
@if(isset($myTasks) && $myTasks->count() > 0)
<div class="mt-6 bg-white rounded-lg shadow">
    <div class="p-4 border-b">
        <h2 class="font-bold text-gray-800">Görevlerim</h2>
    </div>
    <div class="p-4">
        @foreach($myTasks as $task)
        <div class="flex justify-between items-center py-2 border-b last:border-0">
            <div>
                <div class="font-medium">{{ $task->title }}</div>
                <div class="text-sm text-gray-500">{{ $task->project->name ?? '-' }}</div>
            </div>
            <span class="text-sm text-gray-500">{{ $task->due_date ? $task->due_date->format('d.m.Y') : '-' }}</span>
        </div>
        @endforeach
    </div>
</div>
@endif
@endsection
