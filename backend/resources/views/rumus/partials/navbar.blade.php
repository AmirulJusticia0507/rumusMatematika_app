<header class="sticky top-0 z-40 border-b border-slate-200/70 bg-white/80 backdrop-blur-xl">
    <div class="mx-auto flex h-16 max-w-6xl items-center justify-between px-4 sm:px-6 lg:px-8">
        <a href="{{ route('rumus.index') }}" class="flex items-center gap-2">
            <span class="flex h-9 w-9 items-center justify-center rounded-xl bg-gradient-to-br from-indigo-500 to-violet-600 text-lg font-black text-white shadow-lg shadow-indigo-500/25">
                Σ
            </span>
            <span class="leading-tight">
                <span class="block text-sm font-bold text-slate-900">RumusKu</span>
                <span class="block text-[11px] font-medium text-slate-500">Matematika Seru</span>
            </span>
        </a>

        <nav class="flex items-center gap-1.5 sm:gap-2">
            <a href="{{ route('rumus.index') }}#sd" class="hidden rounded-lg px-3 py-2 text-sm font-semibold text-slate-700 transition hover:bg-slate-100 sm:block">SD</a>
            <a href="{{ route('rumus.index') }}#smp" class="hidden rounded-lg px-3 py-2 text-sm font-semibold text-slate-700 transition hover:bg-slate-100 sm:block">SMP</a>
            <a href="{{ route('rumus.index') }}#sma" class="hidden rounded-lg px-3 py-2 text-sm font-semibold text-slate-700 transition hover:bg-slate-100 sm:block">SMA</a>

            @auth
                <form method="POST" action="{{ route('logout') }}" class="inline-flex">
                    @csrf
                    <button
                        type="submit"
                        class="inline-flex items-center gap-2 rounded-lg px-3 py-1.5 text-sm font-bold text-slate-700 ring-1 ring-slate-200 transition hover:bg-slate-100"
                    >
                        <span class="hidden sm:inline">Keluar</span>
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" x2="9" y1="12" y2="12"/></svg>
                    </button>
                </form>
                <a href="#" title="{{ auth()->user()->name }}" class="flex h-9 w-9 items-center justify-center overflow-hidden rounded-full ring-2 ring-indigo-200 transition hover:ring-indigo-400">
                    <img src="{{ auth()->user()->photo_url }}" alt="{{ auth()->user()->name }}" class="h-full w-full object-cover">
                </a>
            @else
                <a href="{{ route('login') }}" class="rounded-lg px-3 py-2 text-sm font-semibold text-slate-700 transition hover:bg-slate-100">Masuk</a>
                <a href="{{ route('register') }}" class="rounded-lg bg-gradient-to-r from-indigo-500 to-violet-600 px-4 py-2 text-sm font-bold text-white shadow-md shadow-indigo-500/25 transition hover:opacity-90">
                    Daftar
                </a>
            @endauth
        </nav>
    </div>
</header>