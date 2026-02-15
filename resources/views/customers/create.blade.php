@extends('layouts.app')

@section('title', 'Yeni Müşteri')

@section('content')
<div class="space-y-6">
    <div>
        <h2 class="text-2xl font-bold text-gray-900">Yeni Müşteri</h2>
        <p class="text-gray-600">Yeni müşteri bilgilerini girin</p>
    </div>

    <div class="card max-w-2xl">
        <form action="{{ route('customers.store') }}" method="POST" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">İsim *</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required
                           class="mt-1 input @error('name') border-red-500 @enderror">
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="company" class="block text-sm font-medium text-gray-700">Şirket</label>
                    <input type="text" name="company" id="company" value="{{ old('company') }}"
                           class="mt-1 input @error('company') border-red-500 @enderror">
                    @error('company')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">E-posta</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}"
                           class="mt-1 input @error('email') border-red-500 @enderror">
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700">Telefon</label>
                    <input type="text" name="phone" id="phone" value="{{ old('phone') }}"
                           class="mt-1 input @error('phone') border-red-500 @enderror">
                    @error('phone')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="tax_number" class="block text-sm font-medium text-gray-700">Vergi No</label>
                    <input type="text" name="tax_number" id="tax_number" value="{{ old('tax_number') }}"
                           class="mt-1 input @error('tax_number') border-red-500 @enderror">
                    @error('tax_number')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="tax_office" class="block text-sm font-medium text-gray-700">Vergi Dairesi</label>
                    <input type="text" name="tax_office" id="tax_office" value="{{ old('tax_office') }}"
                           class="mt-1 input @error('tax_office') border-red-500 @enderror">
                    @error('tax_office')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label for="address" class="block text-sm font-medium text-gray-700">Adres</label>
                <textarea name="address" id="address" rows="3"
                          class="mt-1 input @error('address') border-red-500 @enderror">{{ old('address') }}</textarea>
                @error('address')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="notes" class="block text-sm font-medium text-gray-700">Notlar</label>
                <textarea name="notes" id="notes" rows="3"
                          class="mt-1 input @error('notes') border-red-500 @enderror">{{ old('notes') }}</textarea>
                @error('notes')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center">
                <input type="checkbox" name="is_active" id="is_active" value="1" checked
                       class="rounded border-gray-300 text-primary-600 focus:ring-primary-500">
                <label for="is_active" class="ml-2 text-sm text-gray-700">Aktif</label>
            </div>

            <div class="flex justify-end space-x-3">
                <a href="{{ route('customers.index') }}" class="btn btn-secondary">
                    İptal
                </a>
                <button type="submit" class="btn btn-primary">
                    Kaydet
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
