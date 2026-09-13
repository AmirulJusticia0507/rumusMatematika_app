<header class="sticky top-0 z-40 border-b border-slate-200/70 bg-white/80 backdrop-blur-xl dark:border-slate-800 dark:bg-slate-900/80">
    <div class="mx-auto flex h-16 max-w-6xl items-center justify-between gap-2 px-4 sm:px-6 lg:px-8">
        <a href="{{ route('rumus.index') }}" class="flex shrink-0 items-center gap-2">
            <span class="flex h-9 w-9 items-center justify-center rounded-xl bg-gradient-to-br from-indigo-500 to-violet-600 text-lg font-black text-white shadow-lg shadow-indigo-500/25">
                Σ
            </span>
            <span class="leading-tight">
                <span class="block text-sm font-bold text-slate-900 dark:text-white">RumusKu</span>
                <span class="block text-[11px] font-medium text-slate-500 dark:text-slate-400">Matematika Seru</span>
            </span>
        </a>

        @php
            $navItems = [
                ['route' => 'kalkulator.index', 'label' => 'Kalkulator'],
                ['route' => 'kuis.index', 'label' => 'Kuis'],
                ['route' => 'flashcard.index', 'label' => 'Flashcard'],
                ['route' => 'rangkuman', 'label' => 'Rangkuman'],
            ];
        @endphp

        <nav class="hidden items-center gap-1 lg:flex">
            @foreach ($navItems as $item)
                <a href="{{ route($item['route']) }}"
                   class="rounded-lg px-3 py-2 text-sm font-semibold transition {{ request()->routeIs($item['route']) ? 'bg-indigo-50 text-indigo-600 dark:bg-indigo-500/10 dark:text-indigo-300' : 'text-slate-700 hover:bg-slate-100 dark:text-slate-300 dark:hover:bg-slate-800' }}">
                    {{ $item['label'] }}
                </a>
            @endforeach
            @auth
                <a href="{{ route('favorit.index') }}"
                   class="rounded-lg px-3 py-2 text-sm font-semibold transition {{ request()->routeIs('favorit.index') ? 'bg-indigo-50 text-indigo-600 dark:bg-indigo-500/10 dark:text-indigo-300' : 'text-slate-700 hover:bg-slate-100 dark:text-slate-300 dark:hover:bg-slate-800' }}">
                    Favorit
                </a>
            @endauth
        </nav>

        <div class="flex items-center gap-1.5 sm:gap-2">
            {{-- Dark mode toggle --}}
            <button
                type="button"
                onclick="toggleTheme()"
                aria-label="Ganti tema"
                class="flex h-9 w-9 items-center justify-center rounded-lg text-slate-600 ring-1 ring-slate-200 transition hover:bg-slate-100 dark:text-slate-300 dark:ring-slate-700 dark:hover:bg-slate-800"
            >
                <svg class="h-5 w-5 dark:hidden" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9Z"/></svg>
                <svg class="hidden h-5 w-5 dark:block" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="4"/><path d="M12 2v2M12 20v2M4.93 4.93l1.41 1.41M17.66 17.66l1.41 1.41M2 12h2M20 12h2M6.34 17.66l-1.41 1.41M19.07 4.93l-1.41 1.41"/></svg>
            </button>

            @auth
                {{-- Profile dropdown --}}
                <details class="relative">
                    <summary class="flex cursor-pointer list-none items-center gap-2 rounded-full p-0.5 ring-2 ring-indigo-200 transition hover:ring-indigo-400 dark:ring-slate-700 dark:hover:ring-indigo-500 [&::-webkit-details-marker]:hidden">
                        <img src="{{ auth()->user()->photo_url }}" alt="{{ auth()->user()->name }}" class="h-8 w-8 rounded-full object-cover">
                    </summary>
                    <div class="absolute right-0 mt-2 w-52 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-xl dark:border-slate-700 dark:bg-slate-800">
                        <div class="border-b border-slate-100 px-4 py-3 dark:border-slate-700">
                            <p class="truncate text-sm font-bold text-slate-900 dark:text-white">{{ auth()->user()->name }}</p>
                            <p class="truncate text-xs text-slate-500 dark:text-slate-400">{{ auth()->user()->email }}</p>
                        </div>
                        <a href="{{ route('profil.edit') }}" class="flex items-center gap-2.5 px-4 py-2.5 text-sm font-medium text-slate-700 transition hover:bg-slate-50 dark:text-slate-200 dark:hover:bg-slate-700">
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="4"/><path d="M6 21v-2a4 4 0 0 1 4-4h4a4 4 0 0 1 4 4v2"/></svg>
                            Profil Saya
                        </a>
                        <a href="{{ route('favorit.index') }}" class="flex items-center gap-2.5 px-4 py-2.5 text-sm font-medium text-slate-700 transition hover:bg-slate-50 dark:text-slate-200 dark:hover:bg-slate-700">
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11.5 2.7l2.4 4.9 5.4.8-3.9 3.8.9 5.4-4.8-2.5-4.8 2.5.9-5.4L3.7 8.4l5.4-.8z"/></svg>
                            Rumus Favorit
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="flex w-full items-center gap-2.5 border-t border-slate-100 px-4 py-2.5 text-left text-sm font-medium text-rose-600 transition hover:bg-rose-50 dark:border-slate-700 dark:text-rose-400 dark:hover:bg-rose-500/10">
                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" x2="9" y1="12" y2="12"/></svg>
                                Keluar
                            </button>
                        </form>
                    </div>
                </details>
            @else
                <a href="{{ route('login') }}" class="hidden rounded-lg px-3 py-2 text-sm font-semibold text-slate-700 transition hover:bg-slate-100 dark:text-slate-300 dark:hover:bg-slate-800 sm:block">Masuk</a>
                <a href="{{ route('register') }}" class="rounded-lg bg-gradient-to-r from-indigo-500 to-violet-600 px-4 py-2 text-sm font-bold text-white shadow-md shadow-indigo-500/25 transition hover:opacity-90">
                    Daftar
                </a>
            @endauth

            {{-- Mobile menu --}}
            <details class="relative lg:hidden">
                <summary class="flex h-9 w-9 cursor-pointer list-none items-center justify-center rounded-lg text-slate-600 ring-1 ring-slate-200 transition hover:bg-slate-100 dark:text-slate-300 dark:ring-slate-700 dark:hover:bg-slate-800 [&::-webkit-details-marker]:hidden">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="4" x2="20" y1="12" y2="12"/><line x1="4" x2="20" y1="6" y2="6"/><line x1="4" x2="20" y1="18" y2="18"/></svg>
                </summary>
                <div class="absolute right-0 mt-2 w-52 overflow-hidden rounded-2xl border border-slate-200 bg-white py-1 shadow-xl dark:border-slate-700 dark:bg-slate-800">
                    <a href="{{ route('rumus.index') }}" class="block px-4 py-2.5 text-sm font-medium text-slate-700 transition hover:bg-slate-50 dark:text-slate-200 dark:hover:bg-slate-700">Semua Rumus</a>
                    @foreach ($navItems as $item)
                        <a href="{{ route($item['route']) }}" class="block px-4 py-2.5 text-sm font-medium text-slate-700 transition hover:bg-slate-50 dark:text-slate-200 dark:hover:bg-slate-700">{{ $item['label'] }}</a>
                    @endforeach
                    @auth
                        <a href="{{ route('favorit.index') }}" class="block px-4 py-2.5 text-sm font-medium text-slate-700 transition hover:bg-slate-50 dark:text-slate-200 dark:hover:bg-slate-700">Favorit</a>
                        <a href="{{ route('profil.edit') }}" class="block px-4 py-2.5 text-sm font-medium text-slate-700 transition hover:bg-slate-50 dark:text-slate-200 dark:hover:bg-slate-700">Profil Saya</a>
                    @else
                        <a href="{{ route('login') }}" class="block border-t border-slate-100 px-4 py-2.5 text-sm font-medium text-slate-700 transition hover:bg-slate-50 dark:border-slate-700 dark:text-slate-200 dark:hover:bg-slate-700">Masuk</a>
                    @endauth
                </div>
            </details>
        </div>
    </div>
</header>