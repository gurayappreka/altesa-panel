@extends('layouts.app')
@section('title', 'Müşteri Detayı')
@section('content')
<div class="max-w-4xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">{{ $customer->name ?? 'Müşteri' }}</h1>
        <a href="{{ route('customers.edit', $customer ?? 1) }}" class="px-4 py-2 bg-yellow-500 text-white rounded-lg">Düzenle</a>
    </div>
    <div class="bg-white rounded-lg shadow p-6">
        <dl class="grid grid-cols-2 gap-4">
            <div><dt class="text-gray-500">Firma</dt><dd class="font-medium">{{ $customer->company ?? '-' }}</dd></div>
            <div><dt class="text-gray-500">E-posta</dt><dd class="font-medium">{{ $customer->email ?? '-' }}</dd></div>
            <div><dt class="text-gray-500">Telefon</dt><dd class="font-medium">{{ $customer->phone ?? '-' }}</dd></div>
            <div><dt class="text-gray-500">Adres</dt><dd class="font-medium">{{ $customer->address ?? '-' }}</dd></div>
        </dl>
    </div>
</div>
@endsection
