@extends('layouts.guest')

@section('title', 'Giriş Yap')

@section('content')
<div class="bg-white rounded-lg shadow-lg p-8">
    <div class="text-center mb-8">
        <h2 class="text-3xl font-bold text-gray-900">Altesa Panel</h2>
        <p class="mt-2 text-sm text-gray-600">Hesabınıza giriş yapın</p>
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">E-posta</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" required
                   class="mt-1 input @error('email') border-red-500 @enderror">
            @error('email')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password" class="block text-sm font-medium text-gray-700">Şifre</label>
            <input type="password" name="password" id="password" required
                   class="mt-1 input @error('password') border-red-500 @enderror">
            @error('password')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center justify-between">
            <label class="flex items-center">
                <input type="checkbox" name="remember" class="rounded border-gray-300 text-primary-600 focus:ring-primary-500">
                <span class="ml-2 text-sm text-gray-600">Beni hatırla</span>
            </label>
        </div>

        <button type="submit" class="w-full btn btn-primary">
            Giriş Yap
        </button>
    </form>

    <div class="mt-6 text-center text-sm text-gray-600">
        <p><strong>Test Hesapları:</strong></p>
        <p>Admin: admin@altesa.com / password</p>
        <p>Manager: manager@altesa.com / password</p>
        <p>Staff: staff@altesa.com / password</p>
    </div>
</div>
@endsection
