@extends('admin.layouts.app')

@section('title', 'Kelola Rumus')

@section('content')
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-extrabold text-slate-900 dark:text-white">Kelola Rumus</h1>
            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">{{ $rumus->total() }} rumus tersimpan.</p>
        </div>
        <a href="{{ route('admin.rumus.create') }}" class="inline-flex items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-indigo-500 to-violet-600 px-5 py-2.5 text-sm font-bold text-white shadow-lg shadow-indigo-500/30 transition hover:opacity-90">
            + Tambah Rumus
        </a>
    </div>

    @if (session('status'))
        <div class="mt-5 rounded-2xl border border-emerald-200 bg-emerald-50 px-5 py-4 text-sm font-semibold text-emerald-700 dark:border-emerald-500/20 dark:bg-emerald-500/10 dark:text-emerald-300">{{ session('status') }}</div>
    @endif

    <form method="GET" class="mt-6 flex flex-col gap-2 sm:flex-row">
        <input type="text" name="cari" value="{{ request('cari') }}" placeholder="Cari judul / keterangan…"
            class="flex-1 rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-900 outline-none focus:border-indigo-400 focus:ring-2 focus:ring-indigo-200 dark:border-slate-700 dark:bg-slate-900 dark:text-white dark:focus:ring-indigo-500/30">
        <select name="jenjang" class="rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-900 outline-none dark:border-slate-700 dark:bg-slate-900 dark:text-white">
            <option value="">Semua jenjang</option>
            @foreach (['SD', 'SMP', 'SMA'] as $j)
                <option value="{{ $j }}" @selected(request('jenjang') === $j)>{{ $j }}</option>
            @endforeach
        </select>
        <button type="submit" class="rounded-xl bg-slate-900 px-5 py-2.5 text-sm font-bold text-white transition hover:opacity-90 dark:bg-white dark:text-slate-900">Cari</button>
    </form>

    <div class="mt-6 overflow-hidden rounded-2xl border border-slate-200 bg-white dark:border-slate-800 dark:bg-slate-900">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="border-b border-slate-100 bg-slate-50 text-xs font-bold uppercase tracking-wide text-slate-400 dark:border-slate-800 dark:bg-slate-800/50 dark:text-slate-500">
                    <tr>
                        <th class="px-4 py-3">#</th>
                        <th class="px-4 py-3">Judul</th>
                        <th class="px-4 py-3">Slug</th>
                        <th class="px-4 py-3">Jenjang</th>
                        <th class="px-4 py-3">Urutan</th>
                        <th class="px-4 py-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                    @forelse ($rumus as $item)
                        <tr>
                            <td class="px-4 py-3 text-slate-400">{{ $item->urutan }}</td>
                            <td class="px-4 py-3">
                                <span class="font-semibold text-slate-800 dark:text-slate-200">{{ $item->emoji }} {{ $item->title }}</span>
                            </td>
                            <td class="px-4 py-3 font-mono text-xs text-slate-500 dark:text-slate-400">{{ $item->slug }}</td>
                            <td class="px-4 py-3">
                                <span class="rounded-full px-2.5 py-0.5 text-xs font-bold {{ $item->jenjang === 'SD' ? 'bg-emerald-100 text-emerald-700 dark:bg-emerald-500/10 dark:text-emerald-300' : ($item->jenjang === 'SMP' ? 'bg-orange-100 text-orange-700 dark:bg-orange-500/10 dark:text-orange-300' : 'bg-fuchsia-100 text-fuchsia-700 dark:bg-fuchsia-500/10 dark:text-fuchsia-300') }}">{{ $item->jenjang }}</span>
                            </td>
                            <td class="px-4 py-3 text-slate-500 dark:text-slate-400">{{ $item->urutan }}</td>
                            <td class="px-4 py-3">
                                <div class="flex items-center justify-end gap-3">
                                    <a href="{{ route('rumus.show', $item) }}" target="_blank" rel="noopener" class="text-sm font-semibold text-slate-500 hover:text-indigo-600 dark:text-slate-400 dark:hover:text-indigo-400">Lihat</a>
                                    <a href="{{ route('admin.rumus.edit', $item) }}" class="text-sm font-semibold text-indigo-600 hover:underline dark:text-indigo-400">Edit</a>
                                    <form method="POST" action="{{ route('admin.rumus.destroy', $item) }}" onsubmit="return confirm('Hapus rumus ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-sm font-semibold text-rose-500 hover:underline">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-10 text-center text-slate-400">Tidak ada rumus ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="border-t border-slate-100 p-4 dark:border-slate-800">
            {{ $rumus->links() }}
        </div>
    </div>
@endsection