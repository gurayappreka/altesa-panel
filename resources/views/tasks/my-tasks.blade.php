@extends('layouts.app')
@section('title', 'Görevlerim')
@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Görevlerim</h1>
    <p class="text-gray-600">Bana atanan görevler</p>
</div>
<div class="grid gap-4">
    @forelse($tasks ?? [] as $task)
    <div class="bg-white rounded-lg shadow p-4 flex justify-between items-center">
        <div>
            <h3 class="font-medium">{{ $task->title }}</h3>
            <p class="text-sm text-gray-500">{{ $task->project->name ?? 'Proje yok' }}</p>
        </div>
        <span class="px-3 py-1 text-sm rounded-full 
            @if($task->status == 'done') bg-green-100 text-green-800
            @elseif($task->status == 'in_progress') bg-blue-100 text-blue-800
            @else bg-gray-100 text-gray-800 @endif">{{ $task->status }}</span>
    </div>
    @empty
    <div class="text-center py-12 text-gray-500">Atanmış görev bulunmuyor.</div>
    @endforelse
</div>
@endsection
