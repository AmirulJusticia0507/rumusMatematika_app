@extends('layouts.rumus')

@section('title', 'Kuis Matematika — Rumus Matematika')

@section('content')
    <section class="relative overflow-hidden bg-gradient-to-br from-indigo-600 via-violet-600 to-fuchsia-600 text-white">
        <div class="pointer-events-none absolute inset-0 opacity-20" style="background-image: radial-gradient(circle at 1px 1px, white 1px, transparent 0); background-size: 28px 28px;"></div>
        <div class="relative mx-auto max-w-6xl px-4 py-16 text-center sm:px-6 sm:py-20 lg:px-8">
            <span class="inline-flex items-center gap-2 rounded-full border border-white/25 bg-white/10 px-4 py-1.5 text-xs font-semibold tracking-wide text-white backdrop-blur">
                🏆 Uji Kemampuanmu
            </span>
            <h1 class="mt-6 text-3xl font-extrabold tracking-tight sm:text-4xl lg:text-5xl">Kuis Matematika</h1>
            <p class="mx-auto mt-4 max-w-xl text-base text-indigo-100 sm:text-lg">
                Pilih materi, jawab soal-soalnya, dan lihat skormu di papan peringkat! 🔥
            </p>
        </div>
        <svg class="block w-full fill-slate-50 dark:fill-slate-950" viewBox="0 0 1440 60" preserveAspectRatio="none" aria-hidden="true">
            <path d="M0,32 C360,64 1080,0 1440,32 L1440,60 L0,60 Z"></path>
        </svg>
    </section>

    <section class="mx-auto max-w-5xl px-4 py-12 sm:px-6 lg:px-8">
        @if (session('status'))
            <div class="mb-6 rounded-2xl border border-emerald-200 bg-emerald-50 px-5 py-4 text-sm font-semibold text-emerald-700 dark:border-emerald-500/20 dark:bg-emerald-500/10 dark:text-emerald-300">{{ session('status') }}</div>
        @endif

        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($kuis as $item)
                <a href="{{ route('kuis.show', ['jenis' => $item['title']]) }}"
                   class="group relative flex flex-col overflow-hidden rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition duration-300 hover:-translate-y-1 hover:border-transparent hover:shadow-xl hover:shadow-indigo-500/10 dark:border-slate-800 dark:bg-slate-900 dark:hover:shadow-indigo-500/20">
                    <span class="flex h-12 w-12 items-center justify-center rounded-xl bg-gradient-to-br from-indigo-500 to-violet-600 text-2xl shadow-lg">
                        {{ $item['emoji'] }}
                    </span>
                    <h2 class="mt-4 text-lg font-bold text-slate-900 dark:text-white">{{ $item['title'] }}</h2>
                    <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">{{ $item['soalCount'] }} soal</p>

                    <div class="mt-4 flex items-center gap-2">
                        @if ($item['best'] !== null)
                            <span class="inline-flex items-center gap-1.5 rounded-full bg-amber-100 px-3 py-1 text-xs font-bold text-amber-700 dark:bg-amber-500/10 dark:text-amber-300">
                                🏅 Skor terbaik: {{ $item['best'] }}/{{ $item['soalCount'] }}
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1.5 rounded-full bg-slate-100 px-3 py-1 text-xs font-bold text-slate-500 dark:bg-slate-800 dark:text-slate-400">
                                Belum dicoba
                            </span>
                        @endif
                    </div>

                    <span class="mt-4 inline-flex items-center gap-1.5 text-sm font-semibold text-indigo-600 group-hover:underline dark:text-indigo-400">
                        Mulai Kuis
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                    </span>
                </a>
            @endforeach
        </div>

        @guest
            <div class="mt-8 rounded-2xl border border-dashed border-slate-300 bg-slate-50 px-5 py-4 text-center text-sm text-slate-500 dark:border-slate-700 dark:bg-slate-800/50 dark:text-slate-400">
                💡 <a href="{{ route('login') }}" class="font-bold text-indigo-600 underline dark:text-indigo-400">Masuk</a> untuk menyimpan skor dan tampil di papan peringkat.
            </div>
        @endguest
    </section>
@endsection