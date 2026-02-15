@extends('layouts.app')
@section('title', 'Görevler')
@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Tüm Görevler</h1>
</div>
<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Görev</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Proje</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Atanan</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Durum</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tarih</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse($tasks ?? [] as $task)
            <tr>
                <td class="px-6 py-4 font-medium">{{ $task->title }}</td>
                <td class="px-6 py-4">{{ $task->project->name ?? '-' }}</td>
                <td class="px-6 py-4">{{ $task->assignee->name ?? '-' }}</td>
                <td class="px-6 py-4">
                    <span class="px-2 py-1 text-xs rounded-full 
                        @if($task->status == 'done') bg-green-100 text-green-800
                        @elseif($task->status == 'in_progress') bg-blue-100 text-blue-800
                        @else bg-gray-100 text-gray-800 @endif">{{ $task->status }}</span>
                </td>
                <td class="px-6 py-4">{{ $task->due_date ? $task->due_date->format('d.m.Y') : '-' }}</td>
            </tr>
            @empty
            <tr><td colspan="5" class="px-6 py-4 text-center text-gray-500">Görev bulunmuyor.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
