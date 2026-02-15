@extends('layouts.app')
@section('title', 'Yeni Kullanıcı')
@section('content')
<div class="max-w-2xl mx-auto">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Yeni Kullanıcı</h1>
    <form action="{{ route('users.store') }}" method="POST" class="bg-white rounded-lg shadow p-6">
        @csrf
        <div class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Ad Soyad *</label>
                <input type="text" name="name" class="w-full border-gray-300 rounded-lg shadow-sm" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">E-posta *</label>
                <input type="email" name="email" class="w-full border-gray-300 rounded-lg shadow-sm" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Şifre *</label>
                <input type="password" name="password" class="w-full border-gray-300 rounded-lg shadow-sm" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Rol *</label>
                <select name="role" class="w-full border-gray-300 rounded-lg shadow-sm" required>
                    <option value="staff">Personel</option>
                    <option value="manager">Yönetici</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
        </div>
        <div class="flex justify-end space-x-3 mt-6">
            <a href="{{ route('users.index') }}" class="px-4 py-2 border border-gray-300 rounded-lg">İptal</a>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Kaydet</button>
        </div>
    </form>
</div>
@endsection
