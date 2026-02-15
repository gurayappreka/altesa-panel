@extends('layouts.app')
@section('title', 'Profil')
@section('content')
<div class="max-w-2xl mx-auto">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Profil Ayarları</h1>
    <form action="{{ route('profile.update') }}" method="POST" class="bg-white rounded-lg shadow p-6">
        @csrf
        @method('PATCH')
        <div class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Ad Soyad</label>
                <input type="text" name="name" value="{{ auth()->user()->name }}" class="w-full border-gray-300 rounded-lg shadow-sm" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">E-posta</label>
                <input type="email" name="email" value="{{ auth()->user()->email }}" class="w-full border-gray-300 rounded-lg shadow-sm" required>
            </div>
            <hr>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Yeni Şifre (opsiyonel)</label>
                <input type="password" name="password" class="w-full border-gray-300 rounded-lg shadow-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Şifre Tekrar</label>
                <input type="password" name="password_confirmation" class="w-full border-gray-300 rounded-lg shadow-sm">
            </div>
        </div>
        <div class="flex justify-end mt-6">
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Güncelle</button>
        </div>
    </form>
</div>
@endsection
