@extends('layouts.rumus')

@section('title', 'Rangkuman Rumus — Rumus Matematika')

@php
    $grouped = collect($rumus)->groupBy('jenjang')->sortKeysDesc();
@endphp

@section('content')
    <section class="relative overflow-hidden bg-gradient-to-br from-indigo-600 via-violet-600 to-fuchsia-600 text-white print:hidden">
        <div class="pointer-events-none absolute inset-0 opacity-20" style="background-image: radial-gradient(circle at 1px 1px, white 1px, transparent 0); background-size: 28px 28px;"></div>
        <div class="relative mx-auto max-w-6xl px-4 py-16 text-center sm:px-6 sm:py-20 lg:px-8">
            <span class="inline-flex items-center gap-2 rounded-full border border-white/25 bg-white/10 px-4 py-1.5 text-xs font-semibold tracking-wide text-white backdrop-blur">
                📄 Materi Lengkap
            </span>
            <h1 class="mt-6 text-3xl font-extrabold tracking-tight sm:text-4xl lg:text-5xl">Rangkuman Rumus</h1>
            <p class="mx-auto mt-4 max-w-xl text-base text-indigo-100 sm:text-lg">
                Semua rumus dalam satu halaman. Cetak atau simpan sebagai PDF untuk bahan belajar offline! 🖨️
            </p>
            <div class="mt-8 flex flex-col items-center justify-center gap-3 sm:flex-row print:hidden">
                <button onclick="window.print()" class="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-white px-6 py-3 text-sm font-bold text-indigo-700 shadow-lg transition hover:bg-indigo-50 sm:w-auto">
                    🖨️ Cetak / Simpan PDF
                </button>
                <span class="text-xs font-semibold text-indigo-100">Tips: pilih "Simpan sebagai PDF" di menu printer.</span>
            </div>
        </div>
        <svg class="block w-full fill-slate-50 dark:fill-slate-950 print:hidden" viewBox="0 0 1440 60" preserveAspectRatio="none" aria-hidden="true">
            <path d="M0,32 C360,64 1080,0 1440,32 L1440,60 L0,60 Z"></path>
        </svg>
    </section>

    <section class="mx-auto max-w-5xl px-4 py-12 print:max-w-none print:px-0 print:py-0 sm:px-6 lg:px-8">
        @foreach ($grouped as $jenjang => $items)
            <div class="mb-12">
                <h2 class="flex items-center gap-3 text-2xl font-extrabold text-slate-900 dark:text-white">
                    <span class="rounded-xl bg-gradient-to-br {{ $jenjang === 'SD' ? 'from-emerald-500 to-teal-600' : ($jenjang === 'SMP' ? 'from-orange-500 to-amber-600' : 'from-fuchsia-500 to-pink-600') }} px-3 py-1 text-sm font-bold text-white">{{ $jenjang }}</span>
                    Rangkuman
                </h2>
                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">{{ count($items) }} rumus</p>

                <dl class="mt-6 space-y-4">
                    @foreach ($items as $item)
                        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm print:break-inside-avoid print:rounded-none print:border-x-0 print:border-t-0 print:shadow-none dark:border-slate-800 dark:bg-slate-900">
                            <dt class="flex items-center gap-2 font-bold text-slate-900 dark:text-white">
                                <span>{{ $item['emoji'] }}</span>
                                {{ $item['title'] }}
                            </dt>
                            <dd class="mt-2 font-mono text-base leading-relaxed text-slate-700 dark:text-slate-200">
                                {!! $item['rumus'] !!}
                            </dd>
                            <dd class="mt-2 text-sm leading-relaxed text-slate-500 dark:text-slate-400">{{ $item['keterangan'] }}</dd>
                        </div>
                    @endforeach
                </dl>
            </div>
        @endforeach

        <p class="mt-8 border-t border-slate-200 pt-6 text-center text-xs text-slate-400 dark:border-slate-800 dark:text-slate-500">
            Dihasilkan dari RumusKu — kunjungi <a href="{{ route('rumus.index') }}" class="underline">rumusmatematika.app</a>
        </p>
    </section>

    <style>
        @media print {
            body { background: white !important; }
            nav, footer, .print\:hidden { display: none !important; }
        }
    </style>
@endsection