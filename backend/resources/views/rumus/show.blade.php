@extends('layouts.rumus')

@section('title', $jenis . ' — Rumus Matematika')

@section('content')
    <section class="relative overflow-hidden bg-gradient-to-br from-indigo-600 via-violet-600 to-fuchsia-600 text-white">
        <div class="pointer-events-none absolute inset-0 opacity-20" style="background-image: radial-gradient(circle at 1px 1px, white 1px, transparent 0); background-size: 28px 28px;"></div>
        <div class="pointer-events-none absolute -top-24 right-0 h-80 w-80 rounded-full bg-amber-400/30 blur-3xl"></div>
        <div class="pointer-events-none absolute -bottom-24 -left-16 h-80 w-80 rounded-full bg-indigo-300/40 blur-3xl"></div>

        <div class="relative mx-auto max-w-4xl px-4 py-16 sm:px-6 sm:py-20 lg:px-8">
            <nav class="flex items-center gap-2 text-sm text-indigo-200">
                <a href="{{ route('rumus.index') }}" class="flex items-center gap-1.5 font-medium transition hover:text-white">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="m12 19-7-7 7-7"/><path d="M19 12H5"/></svg>
                    Semua Rumus
                </a>
                <span class="text-indigo-300">/</span>
                <span class="text-white">{{ $jenis }}</span>
            </nav>

            <div class="mt-8 flex flex-col items-start gap-6 sm:flex-row sm:items-center">
                <span class="flex h-20 w-20 shrink-0 items-center justify-center rounded-2xl bg-gradient-to-br {{ $gradient }} text-4xl shadow-2xl ring-4 ring-white/20">
                    {{ $emoji }}
                </span>
                <div class="min-w-0 flex-1">
                    <span class="inline-flex items-center gap-2 rounded-full border border-white/25 bg-white/10 px-3 py-1 text-xs font-bold uppercase tracking-wider backdrop-blur">
                        Jenjang {{ $kategoriJenjang }}
                    </span>
                    <h1 class="mt-3 text-3xl font-extrabold leading-tight tracking-tight sm:text-4xl">{{ $jenis }}</h1>
                    <p class="mt-2 max-w-xl text-sm text-indigo-100 sm:text-base">{{ $rumusInfo['keterangan'] }}</p>
                </div>

                <form method="POST" action="{{ route('rumus.bookmark', ['jenis' => $jenis]) }}" class="shrink-0">
                    @csrf
                    <button
                        type="submit"
                        title="{{ $isBookmarked ? 'Hapus dari favorit' : 'Simpan ke favorit' }}"
                        class="inline-flex items-center gap-2 rounded-full border border-white/25 bg-white/10 px-4 py-2 text-sm font-bold backdrop-blur transition hover:bg-white/20 active:scale-95"
                    >
                        @if ($isBookmarked)
                            <svg class="h-5 w-5 fill-amber-300 text-amber-300" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
                            Tersimpan
                        @else
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
                            Simpan
                        @endif
                    </button>
                </form>
            </div>
        </div>

        <svg class="block w-full fill-slate-50 dark:fill-slate-950" viewBox="0 0 1440 60" preserveAspectRatio="none" aria-hidden="true">
            <path d="M0,32 C360,64 1080,0 1440,32 L1440,60 L0,60 Z"></path>
        </svg>
    </section>

    <section class="mx-auto max-w-4xl px-4 py-12 sm:px-6 lg:px-8">
        @if ($rumusInfo['rumus'] !== null)
            <div class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-xl shadow-slate-900/5 dark:border-slate-800 dark:bg-slate-900">
                <div class="flex items-center justify-between border-b border-slate-100 bg-slate-50/70 px-6 py-4 dark:border-slate-800 dark:bg-slate-800/50">
                    <div class="flex items-center gap-1.5">
                        <span class="h-3 w-3 rounded-full bg-rose-400"></span>
                        <span class="h-3 w-3 rounded-full bg-amber-400"></span>
                        <span class="h-3 w-3 rounded-full bg-emerald-400"></span>
                    </div>
                    <span class="font-mono text-xs font-semibold uppercase tracking-wider text-slate-400 dark:text-slate-500">rumus.php</span>
                </div>

                <div class="bg-gradient-to-br from-slate-900 to-slate-800 px-6 py-10 sm:px-10 sm:py-14">
                    <div class="font-mono text-lg leading-10 text-emerald-300 sm:text-2xl sm:leading-relaxed">
                        {!! $rumusInfo['rumus'] !!}
                    </div>
                </div>

                <div class="flex items-start gap-3 px-6 py-6 sm:px-10">
                    <span class="mt-0.5 flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-indigo-100 text-indigo-600 dark:bg-indigo-500/10 dark:text-indigo-400">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4"/><path d="M12 8h.01"/></svg>
                    </span>
                    <div>
                        <h2 class="text-sm font-bold uppercase tracking-wide text-slate-900 dark:text-white">Penjelasan</h2>
                        <p class="mt-1 text-slate-600 dark:text-slate-300">{{ $rumusInfo['keterangan'] }}</p>
                    </div>
                </div>
            </div>
        @endif

        <div class="mt-10 flex flex-col items-center justify-between gap-4 sm:flex-row">
            <a href="{{ route('rumus.index') }}" class="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-white px-6 py-3 text-sm font-bold text-slate-700 shadow-sm ring-1 ring-slate-200 transition hover:bg-slate-50 dark:bg-slate-900 dark:text-slate-200 dark:ring-slate-700 dark:hover:bg-slate-800 sm:w-auto">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="m12 19-7-7 7-7"/><path d="M19 12H5"/></svg>
                Kembali ke Daftar
            </a>
            <a href="{{ route('rumus.index') }}#{{ strtolower($kategoriJenjang) }}" class="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-indigo-500 to-violet-600 px-6 py-3 text-sm font-bold text-white shadow-lg shadow-indigo-500/30 transition hover:opacity-90 sm:w-auto">
                Jelajahi Lebih Banyak 🚀
            </a>
        </div>
    </section>
@endsection