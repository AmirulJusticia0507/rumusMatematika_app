@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
    <h1 class="text-2xl font-extrabold text-slate-900 dark:text-white">Dashboard Admin</h1>
    <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Ringkasan kondisi konten dan pengguna.</p>

    <div class="mt-6 grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-6">
        @php
            $cards = [
                ['Rumus', $rumusTotal, '📚'],
                ['SD', $rumusPerJenjang->get('SD', 0), '🎒'],
                ['SMP', $rumusPerJenjang->get('SMP', 0), '📐'],
                ['SMA', $rumusPerJenjang->get('SMA', 0), '🎓'],
                ['User', $userTotal, '👥'],
                ['Admin', $adminTotal, '🛡️'],
            ];
        @endphp
        @foreach ($cards as [$label, $value, $emoji])
            <div class="rounded-2xl border border-slate-200 bg-white p-4 dark:border-slate-800 dark:bg-slate-900">
                <span class="text-xl">{{ $emoji }}</span>
                <p class="mt-2 font-mono text-2xl font-extrabold text-slate-900 dark:text-white">{{ $value }}</p>
                <p class="text-xs font-semibold uppercase tracking-wide text-slate-400 dark:text-slate-500">{{ $label }}</p>
            </div>
        @endforeach
    </div>

    <div class="mt-8 grid grid-cols-1 gap-4 sm:grid-cols-3">
        <div class="rounded-2xl border border-slate-200 bg-white p-5 dark:border-slate-800 dark:bg-slate-900">
            <p class="text-sm font-semibold text-slate-500 dark:text-slate-400">Favorit tersimpan</p>
            <p class="mt-1 font-mono text-2xl font-extrabold text-indigo-600 dark:text-indigo-400">{{ $bookmarkTotal }}</p>
        </div>
        <div class="rounded-2xl border border-slate-200 bg-white p-5 dark:border-slate-800 dark:bg-slate-900">
            <p class="text-sm font-semibold text-slate-500 dark:text-slate-400">Kuis dikerjakan</p>
            <p class="mt-1 font-mono text-2xl font-extrabold text-indigo-600 dark:text-indigo-400">{{ $quizTotal }}</p>
        </div>
        <div class="rounded-2xl border border-slate-200 bg-white p-5 dark:border-slate-800 dark:bg-slate-900">
            <p class="text-sm font-semibold text-slate-500 dark:text-slate-400">Flashcard diproses</p>
            <p class="mt-1 font-mono text-2xl font-extrabold text-indigo-600 dark:text-indigo-400">{{ $flashTotal }}</p>
        </div>
    </div>

    <h2 class="mt-8 text-lg font-extrabold text-slate-900 dark:text-white">Rumus terakhir diubah</h2>
    <div class="mt-3 overflow-hidden rounded-2xl border border-slate-200 bg-white dark:border-slate-800 dark:bg-slate-900">
        <table class="w-full text-left text-sm">
            <thead class="border-b border-slate-100 bg-slate-50 text-xs font-bold uppercase tracking-wide text-slate-400 dark:border-slate-800 dark:bg-slate-800/50 dark:text-slate-500">
                <tr>
                    <th class="px-4 py-3">Judul</th>
                    <th class="px-4 py-3">Jenjang</th>
                    <th class="px-4 py-3">Diperbarui</th>
                    <th class="px-4 py-3"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                @foreach ($latestRumus as $item)
                    <tr>
                        <td class="px-4 py-3 font-semibold text-slate-800 dark:text-slate-200">{{ $item->emoji }} {{ $item->title }}</td>
                        <td class="px-4 py-3 text-slate-500 dark:text-slate-400">{{ $item->jenjang }}</td>
                        <td class="px-4 py-3 text-slate-500 dark:text-slate-400">{{ $item->updated_at->diffForHumans() }}</td>
                        <td class="px-4 py-3 text-right">
                            <a href="{{ route('admin.rumus.edit', $item) }}" class="font-semibold text-indigo-600 hover:underline dark:text-indigo-400">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection