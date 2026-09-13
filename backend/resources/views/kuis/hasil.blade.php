@extends('layouts.rumus')

@section('title', 'Hasil Kuis ' . $jenis . ' — Rumus Matematika')

@php
    $pct = $total > 0 ? (int) round(($score / $total) * 100) : 0;
    $message = $pct >= 90 ? 'Luar biasa! Kamu jago banget! 🏆' : ($pct >= 70 ? 'Kerja bagus! Sedikit lagi sempurna! 💪' : ($pct >= 50 ? 'Lumayan! Terus berlatih ya! 📚' : 'Jangan menyerah, coba lagi! 🔁'));
@endphp

@section('content')
    <section class="relative overflow-hidden bg-gradient-to-br from-indigo-600 via-violet-600 to-fuchsia-600 text-white">
        <div class="pointer-events-none absolute inset-0 opacity-20" style="background-image: radial-gradient(circle at 1px 1px, white 1px, transparent 0); background-size: 28px 28px;"></div>
        <div class="relative mx-auto max-w-5xl px-4 py-16 text-center sm:px-6 sm:py-20 lg:px-8">
            <span class="inline-flex items-center gap-2 rounded-full border border-white/25 bg-white/10 px-4 py-1.5 text-xs font-semibold tracking-wide text-white backdrop-blur">
                {{ $emoji }} Kuis {{ $jenis }}
            </span>
            <h1 class="mt-6 text-3xl font-extrabold tracking-tight sm:text-4xl">{{ $message }}</h1>

            <div class="mx-auto mt-8 flex h-36 w-36 items-center justify-center rounded-full border-8 border-white/20 bg-white/10 backdrop-blur">
                <div>
                    <span class="block font-mono text-4xl font-extrabold">{{ $score }}/{{ $total }}</span>
                    <span class="mt-1 block text-sm font-bold text-indigo-100">{{ $pct }}%</span>
                </div>
            </div>

            <div class="mt-8 flex flex-col items-center justify-center gap-3 sm:flex-row">
                <a href="{{ route('kuis.show', ['jenis' => $jenis]) }}" class="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-white px-6 py-3 text-sm font-bold text-indigo-700 shadow-lg transition hover:bg-indigo-50 sm:w-auto">
                    🔄 Ulangi Kuis
                </a>
                <a href="{{ route('kuis.index') }}" class="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-white/15 px-6 py-3 text-sm font-bold text-white ring-1 ring-white/30 backdrop-blur transition hover:bg-white/25 sm:w-auto">
                    Kuis Lainnya
                </a>
            </div>

            @if (!$saved)
                <p class="mt-6 text-sm text-indigo-100">
                    💡 <a href="{{ route('login') }}" class="font-bold underline">Masuk</a> untuk menyimpan skor & masuk papan peringkat.
                </p>
            @endif
        </div>
        <svg class="block w-full fill-slate-50 dark:fill-slate-950" viewBox="0 0 1440 60" preserveAspectRatio="none" aria-hidden="true">
            <path d="M0,32 C360,64 1080,0 1440,32 L1440,60 L0,60 Z"></path>
        </svg>
    </section>

    <section class="mx-auto max-w-5xl px-4 py-12 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 gap-8 lg:grid-cols-5">
            {{-- Pembahasan --}}
            <div class="lg:col-span-3">
                <h2 class="text-xl font-extrabold text-slate-900 dark:text-white">📝 Pembahasan</h2>
                <ul class="mt-4 space-y-4">
                    @foreach ($details as $index => $d)
                        <li class="rounded-2xl border p-5 {{ $d['correct'] ? 'border-emerald-200 bg-emerald-50/60 dark:border-emerald-500/20 dark:bg-emerald-500/5' : 'border-rose-200 bg-rose-50/60 dark:border-rose-500/20 dark:bg-rose-500/5' }}">
                            <div class="flex items-start gap-3">
                                <span class="font-mono text-2xl">{{ $d['correct'] ? '✅' : '❌' }}</span>
                                <div class="min-w-0">
                                    <p class="font-bold text-slate-900 dark:text-white">
                                        <span class="mr-1 text-slate-400 dark:text-slate-500">{{ $index + 1 }}.</span>{{ $d['q'] }}
                                    </p>
                                    <p class="mt-2 text-sm text-slate-600 dark:text-slate-300">
                                        Jawabanmu:
                                        @if ($d['user'] === null)
                                            <span class="font-semibold text-rose-500">(tidak dijawab)</span>
                                        @else
                                            <span class="font-semibold {{ $d['correct'] ? 'text-emerald-600 dark:text-emerald-400' : 'text-rose-600 dark:text-rose-400' }}">
                                                {{ ['A', 'B', 'C', 'D', 'E', 'F'][$d['user']] }}. {{ $d['pil'][$d['user']] ?? '' }}
                                            </span>
                                        @endif
                                    </p>
                                    @if (!$d['correct'])
                                        <p class="mt-1 text-sm text-slate-600 dark:text-slate-300">
                                            Kunci: <span class="font-semibold text-emerald-600 dark:text-emerald-400">{{ ['A', 'B', 'C', 'D', 'E', 'F'][$d['jwb']] }}. {{ $d['pil'][$d['jwb']] }}</span>
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>

            {{-- Papan peringkat --}}
            <div class="lg:col-span-2">
                <h2 class="text-xl font-extrabold text-slate-900 dark:text-white">🏅 Papan Peringkat</h2>

                @if ($leaderboard->isEmpty())
                    <p class="mt-4 rounded-2xl border border-dashed border-slate-300 bg-slate-50 px-5 py-8 text-center text-sm text-slate-500 dark:border-slate-700 dark:bg-slate-800/50 dark:text-slate-400">
                        Belum ada skor. Jadilah yang pertama! 🚀
                    </p>
                @else
                    <ol class="mt-4 space-y-3">
                        @foreach ($leaderboard as $rank => $entry)
                            <li class="flex items-center gap-3 rounded-2xl border border-slate-200 bg-white px-4 py-3 dark:border-slate-800 dark:bg-slate-900">
                                <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full text-sm font-extrabold
                                    {{ $rank === 0 ? 'bg-amber-100 text-amber-600 dark:bg-amber-500/10 dark:text-amber-300' : ($rank === 1 ? 'bg-slate-200 text-slate-600 dark:bg-slate-800 dark:text-slate-300' : ($rank === 2 ? 'bg-orange-100 text-orange-600 dark:bg-orange-500/10 dark:text-orange-300' : 'bg-indigo-100 text-indigo-600 dark:bg-indigo-500/10 dark:text-indigo-400')) }}">{{ $rank + 1 }}</span>
                                @if ($entry->user && $user = $entry->user)
                                    <span class="flex h-8 w-8 shrink-0 items-center justify-center overflow-hidden rounded-full bg-gradient-to-br from-indigo-500 to-violet-600 text-sm font-bold text-white">
                                        @if ($user->photo_url)
                                            <img src="{{ $user->photo_url }}" alt="{{ $user->name }}" class="h-full w-full object-cover">
                                        @else
                                            {{ mb_strtoupper(mb_substr($user->name, 0, 1)) }}
                                        @endif
                                    </span>
                                @endif
                                <span class="min-w-0 flex-1 truncate text-sm font-semibold text-slate-800 dark:text-slate-200">
                                    {{ $entry->user?->name ?? 'Pengguna' }}
                                    @if (auth()->check() && $entry->user_id === auth()->id())
                                        <span class="text-xs font-bold text-indigo-500">(kamu)</span>
                                    @endif
                                </span>
                                <span class="font-mono text-sm font-bold text-indigo-600 dark:text-indigo-400">{{ $entry->best }} skor</span>
                            </li>
                        @endforeach
                    </ol>
                @endif

                @if ($history->isNotEmpty())
                    <h3 class="mt-8 text-sm font-extrabold uppercase tracking-wide text-slate-500 dark:text-slate-400">Riwayatmu</h3>
                    <ul class="mt-3 space-y-2">
                        @foreach ($history as $h)
                            <li class="flex items-center justify-between text-sm text-slate-600 dark:text-slate-300">
                                <span>{{ $h->score }}/{{ $h->total }}</span>
                                <span class="text-xs text-slate-400">{{ $h->created_at->diffForHumans() }}</span>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </section>
@endsection