@extends('layouts.rumus')

@section('title', 'Kuis ' . $jenis . ' — Rumus Matematika')

@section('content')
    <section class="relative overflow-hidden bg-gradient-to-br from-indigo-600 via-violet-600 to-fuchsia-600 text-white">
        <div class="pointer-events-none absolute inset-0 opacity-20" style="background-image: radial-gradient(circle at 1px 1px, white 1px, transparent 0); background-size: 28px 28px;"></div>
        <div class="relative mx-auto max-w-4xl px-4 py-16 sm:px-6 sm:py-20 lg:px-8">
            <nav class="flex items-center gap-2 text-sm text-indigo-200">
                <a href="{{ route('kuis.index') }}" class="flex items-center gap-1.5 font-medium transition hover:text-white">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="m12 19-7-7 7-7"/><path d="M19 12H5"/></svg>
                    Semua Kuis
                </a>
                <span class="text-indigo-300">/</span>
                <span class="text-white">{{ $jenis }}</span>
            </nav>
            <h1 class="mt-6 text-3xl font-extrabold tracking-tight sm:text-4xl">Kuis {{ $jenis }} ✏️</h1>
            <p class="mt-2 text-indigo-100">{{ count($soal) }} soal pilihan ganda. Pilih jawaban terbaikmu!</p>
        </div>
        <svg class="block w-full fill-slate-50 dark:fill-slate-950" viewBox="0 0 1440 60" preserveAspectRatio="none" aria-hidden="true">
            <path d="M0,32 C360,64 1080,0 1440,32 L1440,60 L0,60 Z"></path>
        </svg>
    </section>

    <section class="mx-auto max-w-4xl px-4 py-12 sm:px-6 lg:px-8">
        <form method="POST" action="{{ route('kuis.submit', ['jenis' => $jenis]) }}" id="quiz-form">
            @csrf

            <ol class="space-y-6">
                @foreach ($soal as $index => $soalItem)
                    <li class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:p-6 dark:border-slate-800 dark:bg-slate-900">
                        <p class="font-bold text-slate-900 dark:text-white">
                            <span class="mr-2 inline-flex h-7 w-7 items-center justify-center rounded-lg bg-gradient-to-br from-indigo-500 to-violet-600 text-sm text-white">{{ $index + 1 }}</span>
                            {{ $soalItem['q'] }}
                        </p>

                        <div class="mt-4 grid grid-cols-1 gap-2 sm:grid-cols-2">
                            @foreach ($soalItem['pil'] as $pilIndex => $pil)
                                <label class="flex cursor-pointer items-center gap-3 rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm font-medium text-slate-700 transition has-[:checked]:border-indigo-400 has-[:checked]:bg-indigo-50 has-[:checked]:text-indigo-700 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-300 dark:has-[:checked]:border-indigo-500 dark:has-[:checked]:bg-indigo-500/10 dark:has-[:checked]:text-indigo-300">
                                    <input type="radio"
                                           name="jawaban[{{ $index }}]"
                                           value="{{ $pilIndex }}"
                                           required
                                           class="h-4 w-4 accent-indigo-600">
                                    <span>{{ letters()[$pilIndex] ?? '' }}. {{ $pil }}</span>
                                </label>
                            @endforeach
                        </div>
                    </li>
                @endforeach
            </ol>

            <div class="sticky bottom-4 mt-8 flex items-center justify-between gap-4 rounded-2xl border border-slate-200 bg-white/90 p-4 shadow-lg backdrop-blur dark:border-slate-800 dark:bg-slate-900/90">
                <p class="text-sm font-semibold text-slate-500 dark:text-slate-400">
                    <span id="answered-count">0</span>/{{ count($soal) }} terjawab
                </p>
                <button type="submit" class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-indigo-500 to-violet-600 px-6 py-3 text-sm font-bold text-white shadow-lg shadow-indigo-500/30 transition hover:opacity-90">
                    Kumpulkan Jawaban 🚀
                </button>
            </div>
        </form>
    </section>

    <script>
        const form = document.getElementById('quiz-form');
        const answeredEl = document.getElementById('answered-count');
        const total = {{ count($soal) }};

        function updateCount() {
            let answered = 0;
            const groups = form.querySelectorAll('input[type="radio"]');
            const seen = new Set();
            groups.forEach((r) => {
                const name = r.name;
                if (!seen.has(name)) {
                    seen.add(name);
                    if (form.querySelector(`input[name="${name}"]:checked`)) answered++;
                }
            });
            answeredEl.textContent = answered;
        }

        form.addEventListener('change', updateCount);
        updateCount();
    </script>
@endsection

@php
    function letters()
    {
        return ['A', 'B', 'C', 'D', 'E', 'F'];
    }
@endphp