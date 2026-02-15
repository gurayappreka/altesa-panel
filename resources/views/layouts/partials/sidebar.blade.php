<aside class="fixed inset-y-0 left-0 z-40 w-64 bg-white shadow-lg transform transition-transform lg:translate-x-0"
       :class="open ? 'translate-x-0' : '-translate-x-full'">
    <div class="h-full flex flex-col pt-16">
        <nav class="flex-1 px-3 py-4 space-y-1 overflow-y-auto">
            <a href="{{ route('dashboard') }}" class="flex items-center px-3 py-2 text-sm font-medium rounded-lg {{ request()->routeIs('dashboard') ? 'bg-primary-50 text-primary-700' : 'text-gray-700 hover:bg-gray-100' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                Dashboard
            </a>

            <div class="pt-4 pb-2 px-3">
                <h3 class="text-xs font-semibold text-gray-500 uppercase">Teklif & Satış</h3>
            </div>
            <a href="{{ route('customers.index') }}" class="flex items-center px-3 py-2 text-sm font-medium rounded-lg {{ request()->routeIs('customers.*') ? 'bg-primary-50 text-primary-700' : 'text-gray-700 hover:bg-gray-100' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
                Müşteriler
            </a>
            <a href="{{ route('quotes.index') }}" class="flex items-center px-3 py-2 text-sm font-medium rounded-lg {{ request()->routeIs('quotes.*') ? 'bg-primary-50 text-primary-700' : 'text-gray-700 hover:bg-gray-100' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                Teklifler
            </a>

            <div class="pt-4 pb-2 px-3">
                <h3 class="text-xs font-semibold text-gray-500 uppercase">Satın Alma</h3>
            </div>
            <a href="{{ route('suppliers.index') }}" class="flex items-center px-3 py-2 text-sm font-medium rounded-lg {{ request()->routeIs('suppliers.*') ? 'bg-primary-50 text-primary-700' : 'text-gray-700 hover:bg-gray-100' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                </svg>
                Tedarikçiler
            </a>
            <a href="{{ route('purchases.index') }}" class="flex items-center px-3 py-2 text-sm font-medium rounded-lg {{ request()->routeIs('purchases.*') ? 'bg-primary-50 text-primary-700' : 'text-gray-700 hover:bg-gray-100' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
                Satın Alma
            </a>

            <div class="pt-4 pb-2 px-3">
                <h3 class="text-xs font-semibold text-gray-500 uppercase">Stok & Depo</h3>
            </div>
            <a href="{{ route('products.index') }}" class="flex items-center px-3 py-2 text-sm font-medium rounded-lg {{ request()->routeIs('products.*') ? 'bg-primary-50 text-primary-700' : 'text-gray-700 hover:bg-gray-100' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                </svg>
                Ürünler
            </a>
            <a href="{{ route('stock.alerts') }}" class="flex items-center px-3 py-2 text-sm font-medium rounded-lg {{ request()->routeIs('stock.*') ? 'bg-primary-50 text-primary-700' : 'text-gray-700 hover:bg-gray-100' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
                Stok Uyarıları
            </a>

            <div class="pt-4 pb-2 px-3">
                <h3 class="text-xs font-semibold text-gray-500 uppercase">Proje Yönetimi</h3>
            </div>
            <a href="{{ route('projects.index') }}" class="flex items-center px-3 py-2 text-sm font-medium rounded-lg {{ request()->routeIs('projects.*') ? 'bg-primary-50 text-primary-700' : 'text-gray-700 hover:bg-gray-100' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
                Projeler
            </a>
            <a href="{{ route('tasks.my') }}" class="flex items-center px-3 py-2 text-sm font-medium rounded-lg {{ request()->routeIs('tasks.*') ? 'bg-primary-50 text-primary-700' : 'text-gray-700 hover:bg-gray-100' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                </svg>
                Görevlerim
            </a>

            <div class="pt-4 pb-2 px-3">
                <h3 class="text-xs font-semibold text-gray-500 uppercase">Diğer</h3>
            </div>
            <a href="{{ route('files.index') }}" class="flex items-center px-3 py-2 text-sm font-medium rounded-lg {{ request()->routeIs('files.*') ? 'bg-primary-50 text-primary-700' : 'text-gray-700 hover:bg-gray-100' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/>
                </svg>
                Dosyalar
            </a>

            @if(auth()->user()->isAdmin())
            <div class="pt-4 pb-2 px-3">
                <h3 class="text-xs font-semibold text-gray-500 uppercase">Yönetim</h3>
            </div>
            <a href="{{ route('users.index') }}" class="flex items-center px-3 py-2 text-sm font-medium rounded-lg {{ request()->routeIs('users.*') ? 'bg-primary-50 text-primary-700' : 'text-gray-700 hover:bg-gray-100' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>
                Kullanıcılar
            </a>
            @endif
        </nav>
    </div>
</aside>

@if(request()->routeIs('dashboard'))
<div x-show="open" @click="toggle" class="fixed inset-0 bg-black bg-opacity-50 z-30 lg:hidden" x-transition></div>
@endif
