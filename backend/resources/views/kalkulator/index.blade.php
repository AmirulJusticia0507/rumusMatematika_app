@extends('layouts.rumus')

@section('title', 'Kalkulator Rumus — Rumus Matematika')

@php
    $tabs = [
        'persegi' => ['Persegi', '🟩'],
        'persegipanjang' => ['Persegi Panjang', '📏'],
        'segitiga' => ['Segitiga', '🔺'],
        'lingkaran' => ['Lingkaran', '⭕'],
        'kubus' => ['Kubus', '🧊'],
        'pangkat' => ['Pangkat', '🔢'],
        'persentase' => ['Persentase', '💯'],
    ];
@endphp

@section('content')
    <section class="relative overflow-hidden bg-gradient-to-br from-indigo-600 via-violet-600 to-fuchsia-600 text-white">
        <div class="pointer-events-none absolute inset-0 opacity-20" style="background-image: radial-gradient(circle at 1px 1px, white 1px, transparent 0); background-size: 28px 28px;"></div>
        <div class="relative mx-auto max-w-6xl px-4 py-16 text-center sm:px-6 sm:py-20 lg:px-8">
            <span class="inline-flex items-center gap-2 rounded-full border border-white/25 bg-white/10 px-4 py-1.5 text-xs font-semibold tracking-wide text-white backdrop-blur">
                🖩 Hitung Langsung
            </span>
            <h1 class="mt-6 text-3xl font-extrabold tracking-tight sm:text-4xl lg:text-5xl">Kalkulator Rumus</h1>
            <p class="mx-auto mt-4 max-w-xl text-base text-indigo-100 sm:text-lg">
                Isi angka, hitung hasilnya langsung di sini. Cocok untuk cek PR atau latihan cepat! ✨
            </p>
        </div>
        <svg class="block w-full fill-slate-50 dark:fill-slate-950" viewBox="0 0 1440 60" preserveAspectRatio="none" aria-hidden="true">
            <path d="M0,32 C360,64 1080,0 1440,32 L1440,60 L0,60 Z"></path>
        </svg>
    </section>

    <section class="mx-auto max-w-3xl px-4 py-12 sm:px-6 lg:px-8">
        <div class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-xl shadow-slate-900/5 dark:border-slate-800 dark:bg-slate-900">
            <div class="flex flex-wrap gap-2 border-b border-slate-100 bg-slate-50/70 p-4 dark:border-slate-800 dark:bg-slate-800/50">
                @foreach ($tabs as $key => [$label, $emoji])
                    <button type="button" data-calc-tab data-target="{{ $key }}"
                        onclick="showCalc('{{ $key }}')"
                        class="rounded-xl px-3 py-2 text-sm font-bold transition">
                        {{ $emoji }} {{ $label }}
                    </button>
                @endforeach
            </div>

            <div class="p-6 sm:p-8">
                {{-- Persegi --}}
                <div data-calc-panel="persegi" class="hidden">
                    <h2 class="text-lg font-bold text-slate-900 dark:text-white">🟩 Luas & Keliling Persegi</h2>
                    <p class="mt-1 font-mono text-sm text-slate-500 dark:text-slate-400">Luas = s × s &nbsp;&middot;&nbsp; Keliling = 4 × s</p>
                    <label class="mt-5 block text-sm font-semibold text-slate-600 dark:text-slate-300" for="persegi-s">Panjang sisi (s)</label>
                    <input id="persegi-s" type="number" inputmode="decimal" value="10"
                        class="mt-1 block w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 font-mono text-slate-900 outline-none focus:border-indigo-400 focus:ring-2 focus:ring-indigo-200 dark:border-slate-700 dark:bg-slate-800 dark:text-white dark:focus:ring-indigo-500/30">
                    <div id="persegi-rumus" class="mt-5 rounded-xl bg-gradient-to-r from-indigo-50 to-violet-50 p-4 text-center font-mono text-lg text-indigo-700 dark:from-indigo-500/10 dark:to-violet-500/10 dark:text-indigo-300"></div>
                    <div id="persegi-hasil" class="mt-3 grid grid-cols-2 gap-3"></div>
                </div>

                {{-- Persegi Panjang --}}
                <div data-calc-panel="persegipanjang" class="hidden">
                    <h2 class="text-lg font-bold text-slate-900 dark:text-white">📏 Persegi Panjang</h2>
                    <p class="mt-1 font-mono text-sm text-slate-500 dark:text-slate-400">L = p × l &nbsp;&middot;&nbsp; K = 2 × (p + l)</p>
                    <div class="mt-5 grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-slate-600 dark:text-slate-300" for="pp-p">Panjang (p)</label>
                            <input id="pp-p" type="number" inputmode="decimal" value="15"
                                class="mt-1 block w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 font-mono text-slate-900 outline-none focus:border-indigo-400 focus:ring-2 focus:ring-indigo-200 dark:border-slate-700 dark:bg-slate-800 dark:text-white dark:focus:ring-indigo-500/30">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-600 dark:text-slate-300" for="pp-l">Lebar (l)</label>
                            <input id="pp-l" type="number" inputmode="decimal" value="8"
                                class="mt-1 block w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 font-mono text-slate-900 outline-none focus:border-indigo-400 focus:ring-2 focus:ring-indigo-200 dark:border-slate-700 dark:bg-slate-800 dark:text-white dark:focus:ring-indigo-500/30">
                        </div>
                    </div>
                    <div id="pp-rumus" class="mt-5 rounded-xl bg-gradient-to-r from-indigo-50 to-violet-50 p-4 text-center font-mono text-lg text-indigo-700 dark:from-indigo-500/10 dark:to-violet-500/10 dark:text-indigo-300"></div>
                    <div id="pp-hasil" class="mt-3 grid grid-cols-2 gap-3"></div>
                </div>

                {{-- Segitiga --}}
                <div data-calc-panel="segitiga" class="hidden">
                    <h2 class="text-lg font-bold text-slate-900 dark:text-white">🔺 Luas Segitiga</h2>
                    <p class="mt-1 font-mono text-sm text-slate-500 dark:text-slate-400">L = ½ × alas × tinggi</p>
                    <div class="mt-5 grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-slate-600 dark:text-slate-300" for="seg-a">Alas (a)</label>
                            <input id="seg-a" type="number" inputmode="decimal" value="12"
                                class="mt-1 block w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 font-mono text-slate-900 outline-none focus:border-indigo-400 focus:ring-2 focus:ring-indigo-200 dark:border-slate-700 dark:bg-slate-800 dark:text-white dark:focus:ring-indigo-500/30">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-600 dark:text-slate-300" for="seg-t">Tinggi (t)</label>
                            <input id="seg-t" type="number" inputmode="decimal" value="5"
                                class="mt-1 block w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 font-mono text-slate-900 outline-none focus:border-indigo-400 focus:ring-2 focus:ring-indigo-200 dark:border-slate-700 dark:bg-slate-800 dark:text-white dark:focus:ring-indigo-500/30">
                        </div>
                    </div>
                    <div id="seg-rumus" class="mt-5 rounded-xl bg-gradient-to-r from-indigo-50 to-violet-50 p-4 text-center font-mono text-lg text-indigo-700 dark:from-indigo-500/10 dark:to-violet-500/10 dark:text-indigo-300"></div>
                    <div id="seg-hasil" class="mt-3 grid grid-cols-1 gap-3"></div>
                </div>

                {{-- Lingkaran --}}
                <div data-calc-panel="lingkaran" class="hidden">
                    <h2 class="text-lg font-bold text-slate-900 dark:text-white">⭕ Luas & Keliling Lingkaran</h2>
                    <p class="mt-1 font-mono text-sm text-slate-500 dark:text-slate-400">L = π × r² &nbsp;&middot;&nbsp; K = 2 × π × r &nbsp;(π = 3,14)</p>
                    <label class="mt-5 block text-sm font-semibold text-slate-600 dark:text-slate-300" for="ling-r">Jari-jari (r)</label>
                    <input id="ling-r" type="number" inputmode="decimal" value="7"
                        class="mt-1 block w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 font-mono text-slate-900 outline-none focus:border-indigo-400 focus:ring-2 focus:ring-indigo-200 dark:border-slate-700 dark:bg-slate-800 dark:text-white dark:focus:ring-indigo-500/30">
                    <div id="ling-rumus" class="mt-5 rounded-xl bg-gradient-to-r from-indigo-50 to-violet-50 p-4 text-center font-mono text-lg text-indigo-700 dark:from-indigo-500/10 dark:to-violet-500/10 dark:text-indigo-300"></div>
                    <div id="ling-hasil" class="mt-3 grid grid-cols-2 gap-3"></div>
                </div>

                {{-- Kubus --}}
                <div data-calc-panel="kubus" class="hidden">
                    <h2 class="text-lg font-bold text-slate-900 dark:text-white">🧊 Volume & Luas Permukaan Kubus</h2>
                    <p class="mt-1 font-mono text-sm text-slate-500 dark:text-slate-400">V = s³ &nbsp;&middot;&nbsp; Luas permukaan = 6 × s²</p>
                    <label class="mt-5 block text-sm font-semibold text-slate-600 dark:text-slate-300" for="kubus-s">Panjang rusuk (s)</label>
                    <input id="kubus-s" type="number" inputmode="decimal" value="5"
                        class="mt-1 block w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 font-mono text-slate-900 outline-none focus:border-indigo-400 focus:ring-2 focus:ring-indigo-200 dark:border-slate-700 dark:bg-slate-800 dark:text-white dark:focus:ring-indigo-500/30">
                    <div id="kubus-rumus" class="mt-5 rounded-xl bg-gradient-to-r from-indigo-50 to-violet-50 p-4 text-center font-mono text-lg text-indigo-700 dark:from-indigo-500/10 dark:to-violet-500/10 dark:text-indigo-300"></div>
                    <div id="kubus-hasil" class="mt-3 grid grid-cols-2 gap-3"></div>
                </div>

                {{-- Pangkat --}}
                <div data-calc-panel="pangkat" class="hidden">
                    <h2 class="text-lg font-bold text-slate-900 dark:text-white">🔢 Bilangan Berpangkat</h2>
                    <p class="mt-1 font-mono text-sm text-slate-500 dark:text-slate-400">aⁿ</p>
                    <div class="mt-5 grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-slate-600 dark:text-slate-300" for="pk-a">Bilangan (a)</label>
                            <input id="pk-a" type="number" inputmode="decimal" value="3"
                                class="mt-1 block w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 font-mono text-slate-900 outline-none focus:border-indigo-400 focus:ring-2 focus:ring-indigo-200 dark:border-slate-700 dark:bg-slate-800 dark:text-white dark:focus:ring-indigo-500/30">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-600 dark:text-slate-300" for="pk-n">Pangkat (n)</label>
                            <input id="pk-n" type="number" inputmode="decimal" value="4"
                                class="mt-1 block w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 font-mono text-slate-900 outline-none focus:border-indigo-400 focus:ring-2 focus:ring-indigo-200 dark:border-slate-700 dark:bg-slate-800 dark:text-white dark:focus:ring-indigo-500/30">
                        </div>
                    </div>
                    <div id="pk-rumus" class="mt-5 rounded-xl bg-gradient-to-r from-indigo-50 to-violet-50 p-4 text-center font-mono text-lg text-indigo-700 dark:from-indigo-500/10 dark:to-violet-500/10 dark:text-indigo-300"></div>
                    <div id="pk-hasil" class="mt-3 grid grid-cols-1 gap-3"></div>
                </div>

                {{-- Persentase --}}
                <div data-calc-panel="persentase" class="hidden">
                    <h2 class="text-lg font-bold text-slate-900 dark:text-white">💯 Persentase</h2>
                    <p class="mt-1 font-mono text-sm text-slate-500 dark:text-slate-400">% = (bagian ÷ total) × 100%</p>
                    <div class="mt-5 grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-slate-600 dark:text-slate-300" for="ps-b">Bagian</label>
                            <input id="ps-b" type="number" inputmode="decimal" value="25"
                                class="mt-1 block w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 font-mono text-slate-900 outline-none focus:border-indigo-400 focus:ring-2 focus:ring-indigo-200 dark:border-slate-700 dark:bg-slate-800 dark:text-white dark:focus:ring-indigo-500/30">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-600 dark:text-slate-300" for="ps-t">Total</label>
                            <input id="ps-t" type="number" inputmode="decimal" value="80"
                                class="mt-1 block w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 font-mono text-slate-900 outline-none focus:border-indigo-400 focus:ring-2 focus:ring-indigo-200 dark:border-slate-700 dark:bg-slate-800 dark:text-white dark:focus:ring-indigo-500/30">
                        </div>
                    </div>
                    <div id="ps-rumus" class="mt-5 rounded-xl bg-gradient-to-r from-indigo-50 to-violet-50 p-4 text-center font-mono text-lg text-indigo-700 dark:from-indigo-500/10 dark:to-violet-500/10 dark:text-indigo-300"></div>
                    <div id="ps-hasil" class="mt-3 grid grid-cols-1 gap-3"></div>
                </div>
            </div>
        </div>

        <p class="mt-6 text-center text-xs text-slate-400 dark:text-slate-500">
            Perhitungan dijalankan langsung di peramban (browser) kamu — tidak ada data yang dikirim. 🔒
        </p>
    </section>

    <script>
        const fmt = (n) => Number.isInteger(n) ? n.toLocaleString('id-ID') : n.toLocaleString('id-ID', { maximumFractionDigits: 4 });

        function cfg(panel, inputIds, compute) {
            const run = () => {
                try { compute(); } catch (err) { /* abaikan input kosong */ }
            };
            inputIds.forEach((id) => {
                document.getElementById(id)?.addEventListener('input', run);
            });
            run();
        }

        function showCalc(key) {
            document.querySelectorAll('[data-calc-panel]').forEach((el) => {
                el.classList.toggle('hidden', el.dataset.calcPanel !== key);
            });
            document.querySelectorAll('[data-calc-tab]').forEach((btn) => {
                const active = btn.dataset.target === key;
                btn.classList.toggle('bg-gradient-to-r', active);
                btn.classList.toggle('from-indigo-500', active);
                btn.classList.toggle('to-violet-600', active);
                btn.classList.toggle('text-white', active);
                btn.classList.toggle('shadow', active);
                btn.classList.toggle('text-slate-600', !active);
                btn.classList.toggle('dark:text-slate-300', !active);
            });
        }

        function renderCalc(panel, rumus, rows) {
            document.getElementById(`${panel}-rumus`).innerHTML = rumus;
            const box = document.getElementById(`${panel}-hasil`);
            box.innerHTML = rows.map(([label, value, accent]) => `
                <div class="rounded-2xl border border-slate-100 bg-slate-50 px-4 py-3 text-center dark:border-slate-800 dark:bg-slate-800/60">
                    <div class="text-xs font-semibold uppercase tracking-wide text-slate-400 dark:text-slate-500">${label}</div>
                    <div class="mt-1 font-mono text-xl font-bold ${accent ?? 'text-indigo-600 dark:text-indigo-300'}">${value}</div>
                </div>`).join('');
        }

        // Persegi
        cfg('persegi', ['persegi-s'], () => {
            const s = parseFloat(document.getElementById('persegi-s').value) || 0;
            renderCalc('persegi', `Luas = ${fmt(s)} × ${fmt(s)}`, [
                ['Luas', `${fmt(s * s)} satuan²`, 'text-indigo-600 dark:text-indigo-300'],
                ['Keliling', `${fmt(4 * s)} satuan`],
            ]);
        });

        // Persegi Panjang
        cfg('persegipanjang', ['pp-p', 'pp-l'], () => {
            const p = parseFloat(document.getElementById('pp-p').value) || 0;
            const l = parseFloat(document.getElementById('pp-l').value) || 0;
            renderCalc('pp', `Luas = ${fmt(p)} × ${fmt(l)} &nbsp;&middot;&nbsp; K = 2 × (${fmt(p)} + ${fmt(l)})`, [
                ['Luas', `${fmt(p * l)} satuan²`, 'text-indigo-600 dark:text-indigo-300'],
                ['Keliling', `${fmt(2 * (p + l))} satuan`],
            ]);
        });

        // Segitiga
        cfg('segitiga', ['seg-a', 'seg-t'], () => {
            const a = parseFloat(document.getElementById('seg-a').value) || 0;
            const t = parseFloat(document.getElementById('seg-t').value) || 0;
            renderCalc('seg', `Luas = ½ × ${fmt(a)} × ${fmt(t)}`, [
                ['Luas', `${fmt(0.5 * a * t)} satuan²`, 'text-indigo-600 dark:text-indigo-300'],
            ]);
        });

        // Lingkaran
        cfg('lingkaran', ['ling-r'], () => {
            const r = parseFloat(document.getElementById('ling-r').value) || 0;
            renderCalc('ling', `Luas = 3,14 × ${fmt(r)}² &nbsp;&middot;&nbsp; K = 2 × 3,14 × ${fmt(r)}`, [
                ['Luas', `${fmt(3.14 * r * r)} satuan²`, 'text-indigo-600 dark:text-indigo-300'],
                ['Keliling', `${fmt(2 * 3.14 * r)} satuan`],
            ]);
        });

        // Kubus
        cfg('kubus', ['kubus-s'], () => {
            const s = parseFloat(document.getElementById('kubus-s').value) || 0;
            renderCalc('kubus', `Volume = ${fmt(s)}³ &nbsp;&middot;&nbsp; L.Permukaan = 6 × ${fmt(s)}²`, [
                ['Volume', `${fmt(s * s * s)} satuan³`, 'text-indigo-600 dark:text-indigo-300'],
                ['Luas Permukaan', `${fmt(6 * s * s)} satuan²`],
            ]);
        });

        // Pangkat
        cfg('pangkat', ['pk-a', 'pk-n'], () => {
            const a = parseFloat(document.getElementById('pk-a').value) || 0;
            const n = parseFloat(document.getElementById('pk-n').value) || 0;
            renderCalc('pk', `${fmt(a)}^${fmt(n)}`, [
                ['Hasil', `${fmt(Math.pow(a, n))}`, 'text-indigo-600 dark:text-indigo-300'],
            ]);
        });

        // Persentase
        cfg('persentase', ['ps-b', 'ps-t'], () => {
            const b = parseFloat(document.getElementById('ps-b').value) || 0;
            const t = parseFloat(document.getElementById('ps-t').value) || 0;
            const pct = t === 0 ? 0 : (b / t) * 100;
            renderCalc('ps', `% = (${fmt(b)} ÷ ${fmt(t)}) × 100`, [
                ['Persentase', `${fmt(pct)}%`, 'text-indigo-600 dark:text-indigo-300'],
            ]);
        });

        showCalc('persegi');
    </script>
@endsection