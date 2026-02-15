@extends('layouts.app')
@section('title', 'Proje Detayı')
@section('content')
<div class="max-w-4xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">{{ $project->name ?? 'Proje' }}</h1>
        <a href="{{ route('projects.edit', $project ?? 1) }}" class="px-4 py-2 bg-yellow-500 text-white rounded-lg">Düzenle</a>
    </div>
    <div class="bg-white rounded-lg shadow p-6 mb-6">
        <p class="text-gray-600">{{ $project->description ?? 'Açıklama yok' }}</p>
    </div>
    <h2 class="text-xl font-bold mb-4">Görevler</h2>
    <div class="bg-white rounded-lg shadow p-4">
        <p class="text-gray-500">Henüz görev eklenmemiş.</p>
    </div>
</div>
@endsection
