<header class="bg-white shadow-sm sticky top-0 z-30">
    <div class="px-4 py-3 flex items-center justify-between">
        <div class="flex items-center space-x-3">
            <button @click="toggle" class="lg:hidden text-gray-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
            <h1 class="text-xl font-bold text-gray-800">Altesa Panel</h1>
        </div>

        <div class="flex items-center space-x-4">
            <div class="relative" x-data="dropdown">
                <button @click="toggle" class="flex items-center space-x-2 text-gray-700 hover:text-gray-900">
                    <span class="text-sm font-medium">{{ auth()->user()->name }}</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>

                <div x-show="open" @click.away="close" 
                     class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-1 z-50"
                     x-transition>
                    <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                        Profil
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Çıkış Yap
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>
