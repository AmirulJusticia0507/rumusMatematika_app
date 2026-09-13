@extends('layouts.rumus')

@section('title', 'Rumus Favorit — Rumus Matematika')

@section('content')
    <section class="relative overflow-hidden bg-gradient-to-br from-indigo-600 via-violet-600 to-fuchsia-600 text-white">
        <div class="pointer-events-none absolute inset-0 opacity-20" style="background-image: radial-gradient(circle at 1px 1px, white 1px, transparent 0); background-size: 28px 28px;"></div>
        <div class="relative mx-auto max-w-6xl px-4 py-16 sm:px-6 sm:py-20 lg:px-8">
            <h1 class="text-3xl font-extrabold tracking-tight sm:text-4xl">⭐ Rumus Favorit</h1>
            <p class="mt-3 max-w-xl text-indigo-100">
                Koleksi rumus yang kamu simpan. Klik bintang di halaman rumus untuk menambahkan atau menghapus.
            </p>
        </div>
        <svg class="block w-full fill-slate-50 dark:fill-slate-950" viewBox="0 0 1440 60" preserveAspectRatio="none" aria-hidden="true">
            <path d="M0,32 C360,64 1080,0 1440,32 L1440,60 L0,60 Z"></path>
        </svg>
    </section>

    <section class="mx-auto max-w-6xl px-4 py-12 sm:px-6 lg:px-8">
        @if (session('status'))
            <div class="mb-6 rounded-2xl border border-emerald-200 bg-emerald-50 px-5 py-4 text-sm font-semibold text-emerald-700 dark:border-emerald-500/20 dark:bg-emerald-500/10 dark:text-emerald-300">{{ session('status') }}</div>
        @endif

        @if (count($rumus) === 0)
            <div class="rounded-3xl border-2 border-dashed border-slate-200 bg-slate-50 px-6 py-16 text-center dark:border-slate-800 dark:bg-slate-900">
                <span class="text-5xl">💫</span>
                <h2 class="mt-4 text-xl font-extrabold text-slate-900 dark:text-white">Belum ada favorit</h2>
                <p class="mx-auto mt-2 max-w-md text-sm text-slate-500 dark:text-slate-400">
                    Temukan rumus favoritmu di daftar rumus, lalu simpan dengan mengklik tombol bintang.
                </p>
                <a href="{{ route('rumus.index') }}" class="mt-6 inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-indigo-500 to-violet-600 px-6 py-3 text-sm font-bold text-white shadow-lg shadow-indigo-500/30 transition hover:opacity-90">
                    Jelajahi Rumus 🔍
                </a>
            </div>
        @else
            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($rumus as $item)
                    <div class="group relative flex flex-col overflow-hidden rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition duration-300 hover:-translate-y-1 hover:border-transparent hover:shadow-xl hover:shadow-indigo-500/10 dark:border-slate-800 dark:bg-slate-900 dark:hover:shadow-indigo-500/20">
                        <div class="pointer-events-none absolute inset-x-0 top-0 h-1 bg-gradient-to-r {{ $item['gradient'] }} opacity-0 transition group-hover:opacity-100"></div>
                        <div class="flex items-start justify-between gap-3">
                            <span class="flex h-12 w-12 items-center justify-center rounded-xl bg-gradient-to-br {{ $item['gradient'] }} text-2xl shadow-lg">{{ $item['emoji'] }}</span>
                            <form method="POST" action="{{ route('rumus.bookmark', ['jenis' => $item['title']]) }}">
                                @csrf
                                <button type="submit" title="Hapus dari favorit" class="rounded-full p-2 text-amber-500 transition hover:bg-amber-100 dark:hover:bg-amber-500/10">
                                    <svg class="h-5 w-5 fill-amber-400 text-amber-400" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
                                </button>
                            </form>
                        </div>
                        <h2 class="mt-4 text-lg font-bold leading-snug text-slate-900 dark:text-white">{{ $item['title'] }}</h2>
                        <p class="mt-1 line-clamp-2 text-sm leading-relaxed text-slate-500 dark:text-slate-400">{{ $item['keterangan'] }}</p>
                        <a href="{{ route('rumus.show', ['jenis' => $item['title']]) }}" class="mt-4 inline-flex items-center gap-1.5 text-sm font-semibold text-indigo-600 group-hover:underline dark:text-indigo-400">
                            Buka Rumus
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                        </a>
                    </div>
                @endforeach
            </div>
        @endif
    </section>
@endsection