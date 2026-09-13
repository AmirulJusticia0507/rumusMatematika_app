<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title', 'Admin') — RumusKu</title>

        @include('partials.theme')

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700,800" rel="stylesheet" />

        @if (file_exists(public_path('build/manifest.json')))
            @vite(['resources/css/app.css'])
        @else
            <script>
                window.tailwind = { config: { darkMode: 'class' } };
            </script>
            <script src="https://cdn.tailwindcss.com"></script>
        @endif
    </head>
    <body class="bg-slate-100 text-slate-800 antialiased dark:bg-slate-950 dark:text-slate-100">
        <div class="flex min-h-screen">
            {{-- Sidebar --}}
            <aside class="hidden w-60 shrink-0 flex-col border-r border-slate-200 bg-white p-4 dark:border-slate-800 dark:bg-slate-900 md:flex">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2">
                    <span class="flex h-9 w-9 items-center justify-center rounded-xl bg-gradient-to-br from-indigo-500 to-violet-600 text-lg font-black text-white shadow-lg shadow-indigo-500/25">Σ</span>
                    <span class="leading-tight">
                        <span class="block text-sm font-bold text-slate-900 dark:text-white">RumusKu Admin</span>
                        <span class="block text-[11px] font-medium text-slate-500 dark:text-slate-400">Panel Kelola</span>
                    </span>
                </a>

                <nav class="mt-8 flex flex-1 flex-col gap-1">
                    <a href="{{ route('admin.dashboard') }}"
                       class="flex items-center gap-2.5 rounded-lg px-3 py-2.5 text-sm font-semibold transition {{ request()->routeIs('admin.dashboard') ? 'bg-indigo-50 text-indigo-600 dark:bg-indigo-500/10 dark:text-indigo-300' : 'text-slate-600 hover:bg-slate-100 dark:text-slate-300 dark:hover:bg-slate-800' }}">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="9" rx="1"/><rect x="14" y="3" width="7" height="5" rx="1"/><rect x="14" y="12" width="7" height="9" rx="1"/><rect x="3" y="16" width="7" height="5" rx="1"/></svg>
                        Dashboard
                    </a>
                    <a href="{{ route('admin.rumus.index') }}"
                       class="flex items-center gap-2.5 rounded-lg px-3 py-2.5 text-sm font-semibold transition {{ request()->routeIs('admin.rumus.*') ? 'bg-indigo-50 text-indigo-600 dark:bg-indigo-500/10 dark:text-indigo-300' : 'text-slate-600 hover:bg-slate-100 dark:text-slate-300 dark:hover:bg-slate-800' }}">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
                        Rumus
                    </a>
                </nav>

                <div class="border-t border-slate-200 pt-4 dark:border-slate-800">
                    <a href="{{ route('rumus.index') }}" class="flex items-center gap-2.5 rounded-lg px-3 py-2.5 text-sm font-semibold text-slate-600 transition hover:bg-slate-100 dark:text-slate-300 dark:hover:bg-slate-800">
                        ← Kembali ke Situs
                    </a>
                </div>
            </aside>

            {{-- Main --}}
            <div class="flex min-w-0 flex-1 flex-col">
                <header class="sticky top-0 z-40 flex h-16 items-center justify-between gap-2 border-b border-slate-200 bg-white/80 px-4 backdrop-blur-xl dark:border-slate-800 dark:bg-slate-900/80 sm:px-6">
                    <div class="flex items-center gap-2 md:hidden">
                        <a href="{{ route('admin.dashboard') }}" class="flex h-9 w-9 items-center justify-center rounded-xl bg-gradient-to-br from-indigo-500 to-violet-600 text-base font-black text-white">Σ</a>
                    </div>
                    <p class="hidden text-sm font-bold text-slate-500 dark:text-slate-400 md:block">@yield('title', 'Admin')</p>
                    <div class="flex items-center gap-2">
                        <button type="button" onclick="toggleTheme()" aria-label="Ganti tema"
                            class="flex h-9 w-9 items-center justify-center rounded-lg text-slate-600 ring-1 ring-slate-200 transition hover:bg-slate-100 dark:text-slate-300 dark:ring-slate-700 dark:hover:bg-slate-800">
                            <svg class="h-5 w-5 dark:hidden" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9Z"/></svg>
                            <svg class="hidden h-5 w-5 dark:block" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="4"/><path d="M12 2v2M12 20v2M4.93 4.93l1.41 1.41M17.66 17.66l1.41 1.41M2 12h2M20 12h2M6.34 17.66l-1.41 1.41M19.07 4.93l-1.41 1.41"/></svg>
                        </button>
                        <a href="{{ route('profil.edit') }}" class="flex h-9 w-9 items-center justify-center overflow-hidden rounded-full ring-2 ring-indigo-200 dark:ring-slate-700">
                            @if (auth()->user()->photo_url)
                                <img src="{{ auth()->user()->photo_url }}" alt="{{ auth()->user()->name }}" class="h-full w-full object-cover">
                            @else
                                <span class="text-sm font-bold">{{ mb_strtoupper(mb_substr(auth()->user()->name, 0, 1)) }}</span>
                            @endif
                        </a>
                    </div>
                </header>

                <main class="flex-1 px-4 py-8 sm:px-6 lg:px-8">
                    @yield('content')
                </main>
            </div>
        </div>
    </body>
</html>