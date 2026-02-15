@extends('layouts.app')
@section('title', 'Kullanıcı Düzenle')
@section('content')
<div class="max-w-2xl mx-auto">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Kullanıcı Düzenle</h1>
    <form action="{{ route('users.update', $user ?? 1) }}" method="POST" class="bg-white rounded-lg shadow p-6">
        @csrf
        @method('PUT')
        <div class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Ad Soyad</label>
                <input type="text" name="name" value="{{ $user->name ?? '' }}" class="w-full border-gray-300 rounded-lg shadow-sm" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">E-posta</label>
                <input type="email" name="email" value="{{ $user->email ?? '' }}" class="w-full border-gray-300 rounded-lg shadow-sm" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Rol</label>
                <select name="role" class="w-full border-gray-300 rounded-lg shadow-sm">
                    <option value="staff">Personel</option>
                    <option value="manager">Yönetici</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
            <div>
                <label class="flex items-center">
                    <input type="checkbox" name="is_active" value="1" {{ ($user->is_active ?? true) ? 'checked' : '' }} class="rounded">
                    <span class="ml-2">Aktif</span>
                </label>
            </div>
        </div>
        <div class="flex justify-end space-x-3 mt-6">
            <a href="{{ route('users.index') }}" class="px-4 py-2 border rounded-lg">İptal</a>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg">Güncelle</button>
        </div>
    </form>
</div>
@endsection
