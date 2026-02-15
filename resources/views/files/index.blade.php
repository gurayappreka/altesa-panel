@extends('layouts.app')
@section('title', 'Dosyalar')
@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Dosya Yönetimi</h1>
    <button onclick="document.getElementById('uploadModal').classList.remove('hidden')" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">+ Dosya Yükle</button>
</div>
<div class="grid grid-cols-1 md:grid-cols-4 gap-6">
    <div class="md:col-span-1 bg-white rounded-lg shadow p-4">
        <h3 class="font-medium mb-4">Klasörler</h3>
        <ul class="space-y-2">
            <li><a href="{{ route('files.index') }}" class="text-blue-600 hover:underline">📁 Ana Dizin</a></li>
            @foreach($folders ?? [] as $folder)
            <li><a href="{{ route('files.index', $folder->id) }}" class="text-gray-700 hover:text-blue-600">📁 {{ $folder->name }}</a></li>
            @endforeach
        </ul>
    </div>
    <div class="md:col-span-3 bg-white rounded-lg shadow p-4">
        <h3 class="font-medium mb-4">Dosyalar</h3>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            @forelse($files ?? [] as $file)
            <div class="border rounded-lg p-4 text-center">
                <div class="text-4xl mb-2">📄</div>
                <p class="text-sm truncate">{{ $file->original_name }}</p>
                <a href="{{ route('files.download', $file) }}" class="text-xs text-blue-600">İndir</a>
            </div>
            @empty
            <div class="col-span-4 text-center py-8 text-gray-500">Dosya bulunmuyor.</div>
            @endforelse
        </div>
    </div>
</div>
<div id="uploadModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
    <div class="bg-white rounded-lg p-6 w-full max-w-md">
        <h3 class="text-lg font-bold mb-4">Dosya Yükle</h3>
        <form action="{{ route('files.upload') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" name="file" class="w-full mb-4" required>
            <div class="flex justify-end space-x-2">
                <button type="button" onclick="document.getElementById('uploadModal').classList.add('hidden')" class="px-4 py-2 border rounded-lg">İptal</button>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg">Yükle</button>
            </div>
        </form>
    </div>
</div>
@endsection
