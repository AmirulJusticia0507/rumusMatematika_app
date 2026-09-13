@extends('layouts.rumus')

@section('title', 'Rumus Matematika — SD, SMP, SMA')

@section('content')
    {{-- Hero --}}
    <section class="relative overflow-hidden bg-gradient-to-br from-indigo-600 via-violet-600 to-fuchsia-600 text-white">
        <div class="pointer-events-none absolute inset-0 opacity-20" style="background-image: radial-gradient(circle at 1px 1px, white 1px, transparent 0); background-size: 28px 28px;"></div>
        <div class="pointer-events-none absolute -top-24 -right-24 h-96 w-96 rounded-full bg-fuchsia-400/40 blur-3xl"></div>
        <div class="pointer-events-none absolute -bottom-32 -left-24 h-96 w-96 rounded-full bg-indigo-300/40 blur-3xl"></div>

        <div class="relative mx-auto max-w-6xl px-4 py-20 text-center sm:px-6 sm:py-24 lg:px-8">
            <span class="inline-flex items-center gap-2 rounded-full border border-white/25 bg-white/10 px-4 py-1.5 text-xs font-semibold tracking-wide text-white backdrop-blur">
                🎓 SD · SMP · SMA
            </span>

            <h1 class="mx-auto mt-6 max-w-3xl text-4xl font-extrabold leading-tight tracking-tight sm:text-5xl lg:text-6xl">
                Rumus Matematika <br class="hidden sm:block">
                <span class="bg-gradient-to-r from-amber-300 to-pink-300 bg-clip-text text-transparent">Tanpa Ribet</span>
            </h1>

            <p class="mx-auto mt-6 max-w-xl text-base text-indigo-100 sm:text-lg">
                Kumpulan rumus matematika dari SD sampai SMA, dikemas singkat, jelas, dan mudah dipelajari. Pilih materimu dan mulai berhitung! 💡
            </p>

            <form action="{{ route('rumus.index') }}" method="GET" class="mx-auto mt-8 flex max-w-xl items-center gap-2 rounded-2xl bg-white p-2 shadow-2xl shadow-indigo-900/30">
                <input
                    type="text"
                    name="cari"
                    value="{{ request('cari') }}"
                    placeholder="Cari rumus… misal: pecahan, kuadrat, luas"
                    class="w-full rounded-xl border-0 bg-transparent px-4 py-3 text-sm text-slate-800 placeholder-slate-400 outline-none focus:ring-0"
                >
                <button type="submit" class="shrink-0 rounded-xl bg-gradient-to-r from-indigo-500 to-violet-600 px-5 py-3 text-sm font-bold text-white transition hover:opacity-90">
                    🔍 Cari
                </button>
            </form>

            <div class="mt-10 flex flex-wrap items-center justify-center gap-6 text-sm font-semibold text-indigo-100">
                <span class="flex items-center gap-2"><span class="h-2.5 w-2.5 rounded-full bg-emerald-400"></span>{{ count($rumus) }} Rumus</span>
                <span class="flex items-center gap-2"><span class="h-2.5 w-2.5 rounded-full bg-amber-300"></span>3 Jenjang</span>
                <span class="flex items-center gap-2"><span class="h-2.5 w-2.5 rounded-full bg-pink-300"></span>Gratis Selamanya</span>
            </div>
        </div>

        <svg class="block w-full fill-slate-50 dark:fill-slate-950" viewBox="0 0 1440 60" preserveAspectRatio="none" aria-hidden="true">
            <path d="M0,32 C360,64 1080,0 1440,32 L1440,60 L0,60 Z"></path>
        </svg>
    </section>

    {{-- Section rumus --}}
    <section class="mx-auto max-w-6xl px-4 py-16 sm:px-6 lg:px-8">
        @foreach (['SD' => 'sd', 'SMP' => 'smp', 'SMA' => 'sma'] as $jenjang => $anchor)
            @php
                $items = array_values(array_filter($rumus, fn ($r) => $r['jenjang'] === $jenjang));
            @endphp

            @if (count($items))
                <div id="{{ $anchor }}" class="scroll-mt-24">
                    <div class="mb-8 flex items-end justify-between gap-4">
                        <div>
                            <span class="inline-flex items-center gap-2 rounded-full px-3 py-1 text-xs font-bold uppercase tracking-wide
                                {{ $jenjang === 'SD' ? 'bg-emerald-100 text-emerald-700 dark:bg-emerald-500/10 dark:text-emerald-300' : ($jenjang === 'SMP' ? 'bg-orange-100 text-orange-700 dark:bg-orange-500/10 dark:text-orange-300' : 'bg-fuchsia-100 text-fuchsia-700 dark:bg-fuchsia-500/10 dark:text-fuchsia-300') }}">
                                Jenjang {{ $jenjang }}
                            </span>
                            <h2 class="mt-3 text-2xl font-extrabold text-slate-900 dark:text-white sm:text-3xl">
                                {{ $jenjang === 'SD' ? 'Dasar-dasar Membangun Bakat' : ($jenjang === 'SMP' ? 'Materi Menantang & Seru' : 'Rumus Naga untuk Para Juara') }}
                            </h2>
                            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">{{ count($items) }} materi siap dipelajari</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
                        @foreach ($items as $item)
                            <a href="{{ route('rumus.show', ['rumus' => $item['slug']]) }}" class="group relative flex flex-col overflow-hidden rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition duration-300 hover:-translate-y-1 hover:border-transparent hover:shadow-xl hover:shadow-indigo-500/10 dark:border-slate-800 dark:bg-slate-900 dark:hover:shadow-indigo-500/20">
                                <div class="pointer-events-none absolute inset-x-0 top-0 h-1 bg-gradient-to-r {{ $item['gradient'] }} opacity-0 transition group-hover:opacity-100"></div>

                                <div class="flex items-start justify-between gap-3">
                                    <span class="flex h-12 w-12 items-center justify-center rounded-xl bg-gradient-to-br {{ $item['gradient'] }} text-2xl shadow-lg">
                                        {{ $item['emoji'] }}
                                    </span>
                                    <span class="ml-auto inline-flex items-center text-slate-300 transition group-hover:text-indigo-500 dark:text-slate-600 dark:group-hover:text-indigo-400">
                                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                                    </span>
                                </div>

                                <h3 class="mt-4 text-lg font-bold leading-snug text-slate-900 group-hover:text-indigo-600 dark:text-white dark:group-hover:text-indigo-400">{{ $item['title'] }}</h3>

                                <p class="mt-1 line-clamp-2 text-sm leading-relaxed text-slate-500 dark:text-slate-400">{{ $item['keterangan'] }}</p>

                                <div class="mt-4 rounded-xl bg-slate-50 p-3 font-mono text-sm leading-relaxed text-slate-700 dark:bg-slate-800 dark:text-slate-200">
                                    {!! $item['rumus'] !!}
                                </div>

                                <span class="mt-4 inline-flex items-center gap-1.5 text-sm font-semibold text-indigo-600 dark:text-indigo-400">
                                    Buka Rumus
                                    <svg class="transition group-hover:translate-x-1" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                                </span>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif
        @endforeach
    </section>
@endsection