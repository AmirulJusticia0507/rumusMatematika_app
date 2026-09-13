@extends('layouts.rumus')

@section('title', 'Flashcard — Rumus Matematika')

@php
    $filter = request('jenjang', 'semua');
@endphp

@section('content')
    <section class="relative overflow-hidden bg-gradient-to-br from-indigo-600 via-violet-600 to-fuchsia-600 text-white">
        <div class="pointer-events-none absolute inset-0 opacity-20" style="background-image: radial-gradient(circle at 1px 1px, white 1px, transparent 0); background-size: 28px 28px;"></div>
        <div class="relative mx-auto max-w-5xl px-4 py-16 text-center sm:px-6 sm:py-20 lg:px-8">
            <span class="inline-flex items-center gap-2 rounded-full border border-white/25 bg-white/10 px-4 py-1.5 text-xs font-semibold tracking-wide text-white backdrop-blur">
                🃏 Hafalan Cepat
            </span>
            <h1 class="mt-6 text-3xl font-extrabold tracking-tight sm:text-4xl lg:text-5xl">Flashcard Rumus</h1>
            <p class="mx-auto mt-4 max-w-xl text-base text-indigo-100 sm:text-lg">
                Balik kartunya, cek apakah kamu sudah hafal rumusnya. Jujur pada diri sendiri ya! 😉
            </p>
        </div>
        <svg class="block w-full fill-slate-50 dark:fill-slate-950" viewBox="0 0 1440 60" preserveAspectRatio="none" aria-hidden="true">
            <path d="M0,32 C360,64 1080,0 1440,32 L1440,60 L0,60 Z"></path>
        </svg>
    </section>

    <section class="mx-auto max-w-3xl px-4 py-12 sm:px-6 lg:px-8">
        @if (session('status'))
            <div class="mb-6 rounded-2xl border border-emerald-200 bg-emerald-50 px-5 py-4 text-sm font-semibold text-emerald-700 dark:border-emerald-500/20 dark:bg-emerald-500/10 dark:text-emerald-300">{{ session('status') }}</div>
        @endif

        {{-- Filter jenjang --}}
        <div class="mb-6 flex flex-wrap items-center justify-center gap-2">
            <a href="{{ route('flashcard.index') }}" class="rounded-full px-4 py-1.5 text-sm font-bold transition {{ $filter === 'semua' ? 'bg-gradient-to-r from-indigo-500 to-violet-600 text-white shadow' : 'bg-white text-slate-600 ring-1 ring-slate-200 hover:text-indigo-600 dark:bg-slate-900 dark:text-slate-300 dark:ring-slate-700 dark:hover:text-indigo-400' }}">Semua</a>
            @foreach (['SD', 'SMP', 'SMA'] as $j)
                <a href="{{ route('flashcard.index', ['jenjang' => $j]) }}" class="rounded-full px-4 py-1.5 text-sm font-bold transition {{ $filter === $j ? 'bg-gradient-to-r from-indigo-500 to-violet-600 text-white shadow' : 'bg-white text-slate-600 ring-1 ring-slate-200 hover:text-indigo-600 dark:bg-slate-900 dark:text-slate-300 dark:ring-slate-700 dark:hover:text-indigo-400' }}">{{ $j }}</a>
            @endforeach
        </div>

        @if (count($rumus) === 0)
            <div class="rounded-3xl border-2 border-dashed border-slate-200 bg-slate-50 px-6 py-16 text-center dark:border-slate-800 dark:bg-slate-900">
                <span class="text-5xl">🃏</span>
                <h2 class="mt-4 text-xl font-extrabold text-slate-900 dark:text-white">Tidak ada kartu</h2>
                <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">Pilih jenjang lain atau kembali ke semua kartu.</p>
            </div>
        @else
            {{-- Deck --}}
            <div id="deck" class="relative min-h-[22rem]">
                @foreach ($rumus as $i => $item)
                    @php
                        $isKnown = $progress->get($item['title']);
                    @endphp
                    <div class="card absolute inset-0 transition duration-300"
                         data-index="{{ $i }}"
                         data-total="{{ count($rumus) }}"
                         data-title="{{ $item['title'] }}"
                         data-known="{{ $isKnown === null ? 'null' : ($isKnown ? '1' : '0') }}">
                        <div class="flex min-h-[22rem] flex-col overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-xl shadow-slate-900/5 dark:border-slate-800 dark:bg-slate-900">
                            <div class="flex h-12 items-center justify-between border-b border-slate-100 px-6 dark:border-slate-800">
                                <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-bold text-slate-500 dark:bg-slate-800 dark:text-slate-400">{{ $item['jenjang'] }}</span>
                                @if ($isKnown !== null)
                                    <span class="rounded-full px-3 py-1 text-xs font-bold {{ $isKnown ? 'bg-emerald-100 text-emerald-700 dark:bg-emerald-500/10 dark:text-emerald-300' : 'bg-rose-100 text-rose-700 dark:bg-rose-500/10 dark:text-rose-300' }}">
                                        {{ $isKnown ? 'Sudah tahu' : 'Perlu latihan' }}
                                    </span>
                                @endif
                            </div>

                            <div class="front flex flex-1 flex-col items-center justify-center p-8 text-center">
                                <span class="text-6xl">{{ $item['emoji'] }}</span>
                                <h2 class="mt-5 text-2xl font-extrabold text-slate-900 dark:text-white">{{ $item['title'] }}</h2>
                                <p class="mt-2 text-sm text-slate-400 dark:text-slate-500">Kamu hafal rumus ini? Balik kartunya! 👀</p>
                                <div class="mt-6 flex gap-3">
                                    <button type="button" class="answer-btn rounded-xl bg-rose-500 px-5 py-2.5 text-sm font-bold text-white transition hover:bg-rose-600" data-known="0">Belum Tahu</button>
                                    <button type="button" class="answer-btn rounded-xl bg-emerald-500 px-5 py-2.5 text-sm font-bold text-white transition hover:bg-emerald-600" data-known="1">Saya Tahu</button>
                                </div>
                            </div>

                            <div class="back hidden flex-1 flex-col p-8">
                                <p class="text-sm font-bold uppercase tracking-wide text-slate-400 dark:text-slate-500">{{ $item['keterangan'] }}</p>
                                <div class="mt-3 flex flex-1 items-center justify-center rounded-2xl bg-gradient-to-br from-slate-900 to-slate-800 p-6 font-mono text-lg leading-relaxed text-emerald-300">
                                    {!! $item['rumus'] !!}
                                </div>
                                <div class="mt-6 flex justify-center">
                                    <button type="button" class="next-btn rounded-xl bg-gradient-to-r from-indigo-500 to-violet-600 px-6 py-2.5 text-sm font-bold text-white shadow-lg shadow-indigo-500/30 transition hover:opacity-90">
                                        Lanjut ➜
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Progress / nav --}}
            <div class="mt-6 flex items-center justify-between gap-4">
                <button type="button" id="shuffle-btn" class="rounded-xl bg-white px-4 py-2 text-sm font-bold text-slate-600 ring-1 ring-slate-200 transition hover:text-indigo-600 dark:bg-slate-900 dark:text-slate-300 dark:ring-slate-700 dark:hover:text-indigo-400">🔀 Acak</button>
                <div class="h-2 flex-1 overflow-hidden rounded-full bg-slate-200 dark:bg-slate-800">
                    <div id="progress-bar" class="h-full w-0 rounded-full bg-gradient-to-r from-indigo-500 to-violet-600 transition-all duration-300"></div>
                </div>
                <span id="progress-text" class="text-sm font-bold text-slate-500 dark:text-slate-400">0/{{ count($rumus) }}</span>
            </div>

            {{-- Ringkasan hasil --}}
            <div id="summary" class="mt-8 hidden rounded-3xl border border-slate-200 bg-white p-8 text-center shadow-xl shadow-slate-900/5 dark:border-slate-800 dark:bg-slate-900">
                <span class="text-5xl">🎉</span>
                <h2 class="mt-3 text-2xl font-extrabold text-slate-900 dark:text-white">Selesai!</h2>
                <p class="mt-2 text-slate-600 dark:text-slate-300">
                    Kamu hafal <span id="summary-known" class="font-bold text-emerald-600 dark:text-emerald-400">0</span> dari
                    <span id="summary-total" class="font-bold">0</span> kartu.
                </p>

                <form id="progress-form" method="POST" action="{{ route('flashcard.progress') }}" class="mt-6 hidden">
                    @csrf
                    <div id="progress-inputs"></div>
                    <button type="submit" class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-indigo-500 to-violet-600 px-6 py-3 text-sm font-bold text-white shadow-lg shadow-indigo-500/30 transition hover:opacity-90">
                        💾 Simpan Progres
                    </button>
                </form>

                @guest
                    <p class="mt-6 text-sm text-slate-500 dark:text-slate-400">
                        💡 <a href="{{ route('login') }}" class="font-bold text-indigo-600 underline dark:text-indigo-400">Masuk</a> untuk menyimpan progres belajarmu.
                    </p>
                @endguest

                <a href="{{ route('flashcard.index') }}" class="mt-6 inline-flex items-center gap-2 rounded-xl bg-white px-6 py-3 text-sm font-bold text-slate-700 shadow-sm ring-1 ring-slate-200 transition hover:bg-slate-50 dark:bg-slate-800 dark:text-slate-200 dark:ring-slate-700 dark:hover:bg-slate-700">
                    🔄 Ulangi Lagi
                </a>
            </div>
        @endif
    </section>

    <script>
        const cards = Array.from(document.querySelectorAll('#deck .card'));
        const auth = {{ auth()->check() ? 'true' : 'false' }};
        let index = 0;
        const results = {};

        function showCard() {
            cards.forEach((c, i) => {
                if (i === index) {
                    c.classList.remove('opacity-0', 'pointer-events-none', 'scale-95');
                } else {
                    c.classList.add('opacity-0', 'pointer-events-none', 'scale-95');
                }
            });

            const card = cards[index];
            if (card) {
                card.querySelector('.front').classList.remove('hidden');
                card.querySelector('.back').classList.add('hidden');
                document.getElementById('progress-text').textContent = `${index}/${cards.length}`;
                document.getElementById('progress-bar').style.width = `${(index / cards.length) * 100}%`;
            }
        }

        function answer(btn) {
            const card = btn.closest('.card');
            const known = btn.dataset.known;
            results[card.dataset.title] = known;
            card.querySelector('.front').classList.add('hidden');
            card.querySelector('.back').classList.remove('hidden');
        }

        function next() {
            index++;
            if (index >= cards.length) {
                finish();
            } else {
                showCard();
            }
        }

        function finish() {
            cards.forEach((c) => c.classList.add('opacity-0', 'pointer-events-none'));
            document.getElementById('summary').classList.remove('hidden');
            document.getElementById('progress-bar').style.width = '100%';

            const knownCount = Object.values(results).filter((v) => v === '1').length;
            document.getElementById('summary-known').textContent = knownCount;
            document.getElementById('summary-total').textContent = cards.length;

            if (auth) {
                const form = document.getElementById('progress-form');
                const inputs = document.getElementById('progress-inputs');
                inputs.innerHTML = '';
                cards.forEach((card) => {
                    const known = results[card.dataset.title];
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = `jawaban[${card.dataset.title}]`;
                    input.value = known === '1' ? '1' : '0';
                    inputs.appendChild(input);
                });
                form.classList.remove('hidden');
            }
        }

        document.querySelectorAll('.answer-btn').forEach((btn) => btn.addEventListener('click', () => answer(btn)));
        document.querySelectorAll('.next-btn').forEach((btn) => btn.addEventListener('click', next));

        document.getElementById('shuffle-btn')?.addEventListener('click', () => {
            const deck = document.getElementById('deck');
            const divs = Array.from(deck.children);
            for (let i = divs.length - 1; i > 0; i--) {
                const j = Math.floor(Math.random() * (i + 1));
                [divs[i], divs[j]] = [divs[j], divs[i]];
            }
            divs.forEach((d) => deck.appendChild(d));
            Object.keys(results).forEach((k) => delete results[k]);
            index = 0;
            showCard();
        });

        showCard();
    </script>
@endsection