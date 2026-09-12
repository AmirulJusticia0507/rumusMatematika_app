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

        <nav class="flex items-center gap-1 sm:gap-2">
            <a href="{{ route('rumus.index') }}#sd" class="rounded-lg px-3 py-2 text-sm font-semibold text-slate-700 transition hover:bg-slate-100">SD</a>
            <a href="{{ route('rumus.index') }}#smp" class="rounded-lg px-3 py-2 text-sm font-semibold text-slate-700 transition hover:bg-slate-100">SMP</a>
            <a href="{{ route('rumus.index') }}#sma" class="rounded-lg px-3 py-2 text-sm font-semibold text-slate-700 transition hover:bg-slate-100">SMA</a>
        </nav>
    </div>
</header>