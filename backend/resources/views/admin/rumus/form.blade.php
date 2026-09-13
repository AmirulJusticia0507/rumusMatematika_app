@extends('admin.layouts.app')

@section('title', $rumus->exists ? 'Edit Rumus' : 'Tambah Rumus')

@section('content')
    <div class="mx-auto max-w-3xl">
        <h1 class="text-2xl font-extrabold text-slate-900 dark:text-white">
            {{ $rumus->exists ? '✏️ Edit Rumus' : '➕ Tambah Rumus' }}
        </h1>
        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">{{ $rumus->exists ? 'Perbarui detail rumus "' . $rumus->title . '".' : 'Lengkapi detail rumus baru.' }}</p>

        <form method="POST" action="{{ $rumus->exists ? route('admin.rumus.update', $rumus) : route('admin.rumus.store') }}" class="mt-6 space-y-5 rounded-3xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900 sm:p-8">
            @csrf
            @if ($rumus->exists)
                @method('PUT')
            @endif

            @if ($errors->any())
                <div class="rounded-2xl border border-rose-200 bg-rose-50 px-5 py-4 text-sm font-semibold text-rose-700 dark:border-rose-500/20 dark:bg-rose-500/10 dark:text-rose-300">
                    Periksa kembali isian di bawah ini.
                </div>
            @endif

            <div>
                <label class="block text-sm font-semibold text-slate-600 dark:text-slate-300" for="title">Judul *</label>
                <input id="title" name="title" value="{{ old('title', $rumus->title) }}" required
                    class="mt-1 block w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-900 outline-none focus:border-indigo-400 focus:ring-2 focus:ring-indigo-200 dark:border-slate-700 dark:bg-slate-800 dark:text-white dark:focus:ring-indigo-500/30">
                @error('title') <p class="mt-1 text-xs font-semibold text-rose-500">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-600 dark:text-slate-300" for="slug">Slug <span class="font-normal text-slate-400">(opsional, otomatis dari judul)</span></label>
                <input id="slug" name="slug" value="{{ old('slug', $rumus->slug) }}" placeholder="contoh: luas-segitiga"
                    class="mt-1 block w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 font-mono text-sm text-slate-900 outline-none focus:border-indigo-400 focus:ring-2 focus:ring-indigo-200 dark:border-slate-700 dark:bg-slate-800 dark:text-white dark:focus:ring-indigo-500/30">
                @error('slug') <p class="mt-1 text-xs font-semibold text-rose-500">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
                <div>
                    <label class="block text-sm font-semibold text-slate-600 dark:text-slate-300" for="jenjang">Jenjang *</label>
                    <select id="jenjang" name="jenjang" class="mt-1 block w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-900 outline-none focus:border-indigo-400 focus:ring-2 focus:ring-indigo-200 dark:border-slate-700 dark:bg-slate-800 dark:text-white dark:focus:ring-indigo-500/30">
                        @foreach (['SD', 'SMP', 'SMA'] as $j)
                            <option value="{{ $j }}" @selected(old('jenjang', $rumus->jenjang) === $j)>{{ $j }}</option>
                        @endforeach
                    </select>
                    @error('jenjang') <p class="mt-1 text-xs font-semibold text-rose-500">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-600 dark:text-slate-300" for="urutan">Urutan</label>
                    <input id="urutan" name="urutan" type="number" min="0" value="{{ old('urutan', $rumus->urutan) }}"
                        class="mt-1 block w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-900 outline-none focus:border-indigo-400 focus:ring-2 focus:ring-indigo-200 dark:border-slate-700 dark:bg-slate-800 dark:text-white dark:focus:ring-indigo-500/30">
                    @error('urutan') <p class="mt-1 text-xs font-semibold text-rose-500">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
                <div>
                    <label class="block text-sm font-semibold text-slate-600 dark:text-slate-300" for="emoji">Emoji</label>
                    <input id="emoji" name="emoji" value="{{ old('emoji', $rumus->emoji) }}" placeholder="🧮"
                        class="mt-1 block w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-900 outline-none focus:border-indigo-400 focus:ring-2 focus:ring-indigo-200 dark:border-slate-700 dark:bg-slate-800 dark:text-white dark:focus:ring-indigo-500/30">
                    @error('emoji') <p class="mt-1 text-xs font-semibold text-rose-500">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-600 dark:text-slate-300" for="gradient">Gradien (warna ikon) *</label>
                    <select id="gradient" name="gradient" class="mt-1 block w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-900 outline-none focus:border-indigo-400 focus:ring-2 focus:ring-indigo-200 dark:border-slate-700 dark:bg-slate-800 dark:text-white dark:focus:ring-indigo-500/30">
                        @foreach ($gradients as $g)
                            <option value="{{ $g }}" @selected(old('gradient', $rumus->gradient) === $g)>{{ $g }}</option>
                        @endforeach
                    </select>
                    @error('gradient') <p class="mt-1 text-xs font-semibold text-rose-500">{{ $message }}</p> @enderror
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-600 dark:text-slate-300" for="rumus">Isi Rumus <span class="font-normal text-slate-400">(HTML diperbolehkan)</span></label>
                <textarea id="rumus" name="rumus" rows="5" placeholder="a + b = c&#10;a + b = c"
                    class="mt-1 block w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 font-mono text-sm text-slate-900 outline-none focus:border-indigo-400 focus:ring-2 focus:ring-indigo-200 dark:border-slate-700 dark:bg-slate-800 dark:text-white dark:focus:ring-indigo-500/30">{{ old('rumus', $rumus->rumus) }}</textarea>
                @error('rumus') <p class="mt-1 text-xs font-semibold text-rose-500">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-600 dark:text-slate-300" for="keterangan">Keterangan</label>
                <textarea id="keterangan" name="keterangan" rows="3" placeholder="Penjelasan singkat rumus ini."
                    class="mt-1 block w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-900 outline-none focus:border-indigo-400 focus:ring-2 focus:ring-indigo-200 dark:border-slate-700 dark:bg-slate-800 dark:text-white dark:focus:ring-indigo-500/30">{{ old('keterangan', $rumus->keterangan) }}</textarea>
                @error('keterangan') <p class="mt-1 text-xs font-semibold text-rose-500">{{ $message }}</p> @enderror
            </div>

            <div class="flex flex-col gap-3 sm:flex-row sm:justify-end">
                <a href="{{ route('admin.rumus.index') }}" class="inline-flex items-center justify-center rounded-xl bg-white px-6 py-3 text-sm font-bold text-slate-700 shadow-sm ring-1 ring-slate-200 transition hover:bg-slate-50 dark:bg-slate-800 dark:text-slate-200 dark:ring-slate-700 dark:hover:bg-slate-700">Batal</a>
                <button type="submit" class="inline-flex items-center justify-center rounded-xl bg-gradient-to-r from-indigo-500 to-violet-600 px-6 py-3 text-sm font-bold text-white shadow-lg shadow-indigo-500/30 transition hover:opacity-90">
                    💾 {{ $rumus->exists ? 'Perbarui' : 'Simpan' }}
                </button>
            </div>
        </form>
    </div>
@endsection