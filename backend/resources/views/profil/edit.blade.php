@extends('layouts.rumus')

@section('title', 'Profil Saya — Rumus Matematika')

@section('content')
    <section class="relative overflow-hidden bg-gradient-to-br from-indigo-600 via-violet-600 to-fuchsia-600 text-white">
        <div class="pointer-events-none absolute inset-0 opacity-20" style="background-image: radial-gradient(circle at 1px 1px, white 1px, transparent 0); background-size: 28px 28px;"></div>
        <div class="relative mx-auto max-w-5xl px-4 py-14 sm:px-6 sm:py-16 lg:px-8">
            <div class="flex flex-col items-start gap-6 sm:flex-row sm:items-center">
                <span class="flex h-20 w-20 shrink-0 items-center justify-center overflow-hidden rounded-full bg-white/15 text-4xl font-extrabold ring-4 ring-white/20">
                    @if ($user->photo_url)
                        <img src="{{ $user->photo_url }}" alt="{{ $user->name }}" class="h-full w-full object-cover">
                    @else
                        {{ mb_strtoupper(mb_substr($user->name, 0, 1)) }}
                    @endif
                </span>
                <div>
                    <h1 class="text-3xl font-extrabold tracking-tight sm:text-4xl">{{ $user->name }}</h1>
                    <p class="mt-1 text-indigo-100">{{ $user->email }}</p>
                    <p class="mt-1 text-sm text-indigo-200/80">Bergabung {{ $user->created_at->format('d M Y') }}</p>
                </div>
            </div>
        </div>
        <svg class="block w-full fill-slate-50 dark:fill-slate-950" viewBox="0 0 1440 60" preserveAspectRatio="none" aria-hidden="true">
            <path d="M0,32 C360,64 1080,0 1440,32 L1440,60 L0,60 Z"></path>
        </svg>
    </section>

    <section class="mx-auto max-w-5xl px-4 py-12 sm:px-6 lg:px-8">
        @if (session('status'))
            <div class="mb-6 rounded-2xl border border-emerald-200 bg-emerald-50 px-5 py-4 text-sm font-semibold text-emerald-700 dark:border-emerald-500/20 dark:bg-emerald-500/10 dark:text-emerald-300">{{ session('status') }}</div>
        @endif
        @if (session('password_status'))
            <div class="mb-6 rounded-2xl border border-emerald-200 bg-emerald-50 px-5 py-4 text-sm font-semibold text-emerald-700 dark:border-emerald-500/20 dark:bg-emerald-500/10 dark:text-emerald-300">{{ session('password_status') }}</div>
        @endif

        {{-- Statistik --}}
        <div class="grid grid-cols-2 gap-4 sm:grid-cols-4">
            <div class="rounded-2xl border border-slate-200 bg-white p-5 text-center dark:border-slate-800 dark:bg-slate-900">
                <span class="text-2xl">⭐</span>
                <p class="mt-2 font-mono text-2xl font-extrabold text-slate-900 dark:text-white">{{ $bookmarkCount }}</p>
                <p class="text-xs font-semibold uppercase tracking-wide text-slate-400 dark:text-slate-500">Favorit</p>
            </div>
            <div class="rounded-2xl border border-slate-200 bg-white p-5 text-center dark:border-slate-800 dark:bg-slate-900">
                <span class="text-2xl">🏆</span>
                <p class="mt-2 font-mono text-2xl font-extrabold text-slate-900 dark:text-white">{{ $quizCount }}</p>
                <p class="text-xs font-semibold uppercase tracking-wide text-slate-400 dark:text-slate-500">Kuis Dikerjakan</p>
            </div>
            <div class="rounded-2xl border border-slate-200 bg-white p-5 text-center dark:border-slate-800 dark:bg-slate-900">
                <span class="text-2xl">🎯</span>
                <p class="mt-2 font-mono text-2xl font-extrabold text-indigo-600 dark:text-indigo-400">{{ $bestSkor ?? '—' }}</p>
                <p class="text-xs font-semibold uppercase tracking-wide text-slate-400 dark:text-slate-500">Skor Terbaik</p>
            </div>
            <div class="rounded-2xl border border-slate-200 bg-white p-5 text-center dark:border-slate-800 dark:bg-slate-900">
                <span class="text-2xl">🃏</span>
                <p class="mt-2 font-mono text-2xl font-extrabold text-slate-900 dark:text-white">{{ $flashTahu }}</p>
                <p class="text-xs font-semibold uppercase tracking-wide text-slate-400 dark:text-slate-500">Flashcard Dikuasai</p>
            </div>
        </div>

        <div class="mt-8 grid grid-cols-1 gap-8 lg:grid-cols-2">
            {{-- Edit profil --}}
            <form method="POST" action="{{ route('profil.update') }}" enctype="multipart/form-data" class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">
                @csrf
                @method('PUT')
                <h2 class="text-lg font-extrabold text-slate-900 dark:text-white">✏️ Edit Profil</h2>

                <label class="mt-5 block text-sm font-semibold text-slate-600 dark:text-slate-300" for="name">Nama</label>
                <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}"
                    class="mt-1 block w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-900 outline-none focus:border-indigo-400 focus:ring-2 focus:ring-indigo-200 dark:border-slate-700 dark:bg-slate-800 dark:text-white dark:focus:ring-indigo-500/30">
                @error('name') <p class="mt-1 text-xs font-semibold text-rose-500">{{ $message }}</p> @enderror

                <label class="mt-4 block text-sm font-semibold text-slate-600 dark:text-slate-300" for="email">Email</label>
                <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}"
                    class="mt-1 block w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-900 outline-none focus:border-indigo-400 focus:ring-2 focus:ring-indigo-200 dark:border-slate-700 dark:bg-slate-800 dark:text-white dark:focus:ring-indigo-500/30">
                @error('email') <p class="mt-1 text-xs font-semibold text-rose-500">{{ $message }}</p> @enderror

                <label class="mt-4 block text-sm font-semibold text-slate-600 dark:text-slate-300" for="photo">Foto Profil</label>
                <div class="mt-2 flex items-center gap-4">
                    <img id="photo-preview" src="{{ $user->photo_url }}" alt="Preview"
                         class="h-16 w-16 rounded-full object-cover ring-2 ring-indigo-200 dark:ring-indigo-500/30 {{ $user->photo_url ? '' : 'hidden' }}">
                    <input id="photo" name="photo" type="file" accept="image/png,image/jpeg"
                        class="block w-full text-sm text-slate-500 file:mr-3 file:rounded-xl file:border-0 file:bg-indigo-50 file:px-4 file:py-2.5 file:text-sm file:font-bold file:text-indigo-600 hover:file:bg-indigo-100 dark:text-slate-400 dark:file:bg-indigo-500/10 dark:file:text-indigo-400">
                </div>
                @error('photo') <p class="mt-1 text-xs font-semibold text-rose-500">{{ $message }}</p> @enderror

                <button type="submit" class="mt-6 inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-indigo-500 to-violet-600 px-6 py-3 text-sm font-bold text-white shadow-lg shadow-indigo-500/30 transition hover:opacity-90">
                    💾 Simpan Profil
                </button>
            </form>

            {{-- Ganti password --}}
            <form method="POST" action="{{ route('profil.password') }}" class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">
                @csrf
                @method('PUT')
                <h2 class="text-lg font-extrabold text-slate-900 dark:text-white">🔒 Ganti Password</h2>

                <label class="mt-5 block text-sm font-semibold text-slate-600 dark:text-slate-300" for="current_password">Password Sekarang</label>
                <input id="current_password" name="current_password" type="password"
                    class="mt-1 block w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-900 outline-none focus:border-indigo-400 focus:ring-2 focus:ring-indigo-200 dark:border-slate-700 dark:bg-slate-800 dark:text-white dark:focus:ring-indigo-500/30">
                @error('current_password') <p class="mt-1 text-xs font-semibold text-rose-500">{{ $message }}</p> @enderror

                <label class="mt-4 block text-sm font-semibold text-slate-600 dark:text-slate-300" for="new_password">Password Baru</label>
                <input id="new_password" name="new_password" type="password" placeholder="Minimal 8 karakter"
                    class="mt-1 block w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-900 outline-none focus:border-indigo-400 focus:ring-2 focus:ring-indigo-200 dark:border-slate-700 dark:bg-slate-800 dark:text-white dark:focus:ring-indigo-500/30">
                @error('new_password') <p class="mt-1 text-xs font-semibold text-rose-500">{{ $message }}</p> @enderror

                <label class="mt-4 block text-sm font-semibold text-slate-600 dark:text-slate-300" for="new_password_confirmation">Ulangi Password Baru</label>
                <input id="new_password_confirmation" name="new_password_confirmation" type="password"
                    class="mt-1 block w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-900 outline-none focus:border-indigo-400 focus:ring-2 focus:ring-indigo-200 dark:border-slate-700 dark:bg-slate-800 dark:text-white dark:focus:ring-indigo-500/30">

                <button type="submit" class="mt-6 inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-indigo-500 to-violet-600 px-6 py-3 text-sm font-bold text-white shadow-lg shadow-indigo-500/30 transition hover:opacity-90">
                    🔑 Ganti Password
                </button>
            </form>
        </div>
    </section>

    <script>
        const fileInput = document.getElementById('photo');
        const preview = document.getElementById('photo-preview');

        fileInput?.addEventListener('change', (e) => {
            const file = e.target.files[0];
            if (!file) return;
            const reader = new FileReader();
            reader.onload = (ev) => {
                preview.src = ev.target.result;
                preview.classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        });
    </script>
@endsection