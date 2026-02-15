@extends('layouts.app')
@section('title', 'Kullanıcılar')
@section('content')
<div class="flex flex-col md:flex-row md:justify-between md:items-center mb-6 gap-4">
    <div>
        <h1 class="text-2xl font-bold text-gray-800">Kullanıcı Yönetimi</h1>
        <p class="text-gray-600">Toplam {{ $users->total() }} kullanıcı</p>
    </div>
    <a href="{{ route('users.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        Yeni Kullanıcı Ekle
    </a>
</div>
<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Ad Soyad</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase hidden md:table-cell">E-posta</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Rol</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Durum</th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">İşlemler</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @forelse($users as $user)
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4 font-medium">{{ $user->name }}</td>
                <td class="px-6 py-4 hidden md:table-cell">{{ $user->email }}</td>
                <td class="px-6 py-4">
                    <span class="px-2 py-1 text-xs rounded-full @if($user->role=='admin')bg-red-100 text-red-800 @elseif($user->role=='manager')bg-blue-100 text-blue-800 @else bg-gray-100 text-gray-800 @endif">
                        {{ ['admin'=>'Admin','manager'=>'Yönetici','staff'=>'Personel'][$user->role] ?? $user->role }}
                    </span>
                </td>
                <td class="px-6 py-4">
                    @if($user->is_active)<span class="text-green-600">● Aktif</span>@else<span class="text-red-600">● Pasif</span>@endif
                </td>
                <td class="px-6 py-4 text-right space-x-2">
                    <a href="{{ route('users.edit', $user) }}" class="text-yellow-600">Düzenle</a>
                    @if($user->id !== auth()->id())
                    <form action="{{ route('users.destroy', $user) }}" method="POST" class="inline" onsubmit="return confirm('Kullanıcıyı silmek istediğinize emin misiniz?')">@csrf @method('DELETE')<button class="text-red-600">Sil</button></form>
                    @endif
                </td>
            </tr>
            @empty
            <tr><td colspan="5" class="px-6 py-12 text-center text-gray-500">Henüz kullanıcı yok.</td></tr>
            @endforelse
        </tbody>
    </table>
    @if($users->hasPages())<div class="px-6 py-4 border-t">{{ $users->links() }}</div>@endif
</div>
@endsection
