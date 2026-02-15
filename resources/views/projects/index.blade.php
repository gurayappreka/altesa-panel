@extends('layouts.app')
@section('title', 'Projeler')
@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Projeler</h1>
    <a href="{{ route('projects.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">+ Yeni Proje</a>
</div>
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @forelse($projects ?? [] as $project)
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex justify-between items-start mb-4">
            <h3 class="font-bold text-lg">{{ $project->name }}</h3>
            <span class="px-2 py-1 text-xs rounded-full 
                @if($project->status == 'completed') bg-green-100 text-green-800
                @elseif($project->status == 'active') bg-blue-100 text-blue-800
                @elseif($project->status == 'on_hold') bg-yellow-100 text-yellow-800
                @else bg-gray-100 text-gray-800 @endif">
                {{ ucfirst($project->status) }}
            </span>
        </div>
        <p class="text-gray-600 text-sm mb-4">{{ Str::limit($project->description, 100) }}</p>
        <div class="flex justify-between items-center text-sm text-gray-500">
            <span>{{ $project->customer->name ?? 'Müşteri yok' }}</span>
            <a href="{{ route('projects.show', $project) }}" class="text-blue-600 hover:text-blue-800">Detay →</a>
        </div>
    </div>
    @empty
    <div class="col-span-3 text-center py-12 text-gray-500">Henüz proje bulunmuyor.</div>
    @endforelse
</div>
@endsection
