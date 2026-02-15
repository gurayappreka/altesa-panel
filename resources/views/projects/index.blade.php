@extends('layouts.app')
@section('title', 'Projeler')
@section('content')
<div class="flex flex-col md:flex-row md:justify-between md:items-center mb-6 gap-4">
    <div>
        <h1 class="text-2xl font-bold text-gray-800">Projeler</h1>
        <p class="text-gray-600">Toplam {{ $projects->total() }} proje</p>
    </div>
    <a href="{{ route('projects.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        Yeni Proje Oluştur
    </a>
</div>
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @forelse($projects as $project)
    <div class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition">
        <div class="flex justify-between items-start mb-4">
            <h3 class="font-bold text-lg text-gray-800">{{ $project->name }}</h3>
            <span class="px-2 py-1 text-xs rounded-full @if($project->status=='completed')bg-green-100 text-green-800 @elseif($project->status=='active')bg-blue-100 text-blue-800 @elseif($project->status=='on_hold')bg-yellow-100 text-yellow-800 @else bg-gray-100 text-gray-800 @endif">
                {{ ['planning'=>'Planlama','active'=>'Aktif','on_hold'=>'Beklemede','completed'=>'Tamamlandı','cancelled'=>'İptal'][$project->status] ?? $project->status }}
            </span>
        </div>
        <p class="text-gray-600 text-sm mb-4">{{ Str::limit($project->description, 100) ?: 'Açıklama yok' }}</p>
        <div class="flex justify-between items-center text-sm">
            <span class="text-gray-500">{{ $project->customer->name ?? 'Müşteri yok' }}</span>
            <a href="{{ route('projects.show', $project) }}" class="text-blue-600 hover:text-blue-800 font-medium">Detay →</a>
        </div>
    </div>
    @empty
    <div class="col-span-3 text-center py-12 bg-white rounded-lg shadow">
        <p class="text-gray-500 mb-4">Henüz proje yok.</p>
        <a href="{{ route('projects.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg">+ Yeni Proje Oluştur</a>
    </div>
    @endforelse
</div>
@if($projects->hasPages())<div class="mt-6">{{ $projects->links() }}</div>@endif
@endsection
