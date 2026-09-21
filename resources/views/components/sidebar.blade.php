<aside class="w-64 bg-slate-900 text-slate-100 min-h-screen flex flex-col border-r border-slate-800 flex-shrink-0">
    <!-- Logo / Başlık -->
    <div class="h-16 flex items-center px-6 border-b border-slate-800">
        <span class="text-xl font-bold tracking-wide text-amber-500">
            Mert<span class="text-white">Nakliyat</span>
        </span>
    </div>

    <!-- Menü Linkleri -->
    <nav class="flex-1 px-4 py-6 space-y-1">
        <!-- Nakliye -->
        <a href="{{ route('nakliye.index') }}"
           class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('nakliye.*') ? 'bg-amber-500 text-slate-950 font-semibold' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 100-4 2 2 0 000 4zm10 0a2 2 0 100-4 2 2 0 000 4z"></path>
            </svg>
            <span>Nakliye</span>
        </a>

        <!-- Komisyon -->
        <a href="{{ route('komisyon.index') }}"
           class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('komisyon.*') ? 'bg-amber-500 text-slate-950 font-semibold' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <span>Masraf</span>
        </a>
    </nav>
</aside>
