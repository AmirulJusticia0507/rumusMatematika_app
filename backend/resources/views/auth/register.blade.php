@extends('layouts.auth')

@section('title', 'Daftar')

@section('auth-content')
    <div class="mb-6 text-center">
        <h1 class="text-2xl font-extrabold text-slate-900">Buat Akun Baru 🚀</h1>
        <p class="mt-1 text-sm text-slate-500">Daftar dan mulai belajar rumus matematika</p>
    </div>

    <form method="POST" action="{{ route('register.store') }}" enctype="multipart/form-data" class="space-y-4">
        @csrf

        {{-- Photo Upload --}}
        <div class="flex flex-col items-center gap-3">
            <div class="relative">
                <button
                    type="button"
                    onclick="document.getElementById('photo-input').click()"
                    class="group relative flex h-24 w-24 items-center justify-center overflow-hidden rounded-2xl border-2 border-dashed border-slate-300 bg-slate-50 transition hover:border-indigo-400 hover:bg-indigo-50"
                    id="photo-preview-trigger"
                >
                    <img id="photo-preview-img" src="" alt="Preview" class="hidden h-full w-full object-cover">
                    <span id="photo-preview-icon" class="flex flex-col items-center gap-1 text-slate-400 transition group-hover:text-indigo-500">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/></svg>
                        <span class="text-[10px] font-semibold uppercase tracking-wide">Foto</span>
                    </span>
                </button>
            </div>

            <input
                id="photo-input"
                name="photo"
                type="file"
                accept="image/*"
                class="hidden"
                onchange="previewPhoto(this)"
            >

            <p class="text-xs text-slate-400">Klik untuk upload foto profil (opsional, maks 2 MB)</p>
        </div>

        {{-- Name --}}
        <div>
            <label for="name" class="mb-1 block text-sm font-semibold text-slate-700">Nama Lengkap</label>
            <input
                id="name"
                name="name"
                type="text"
                value="{{ old('name') }}"
                required
                autofocus
                autocomplete="name"
                placeholder="Masukkan nama lengkap"
                class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-800 placeholder-slate-400 transition focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 @error('name') border-rose-400 @enderror"
            >
        </div>

        {{-- Email --}}
        <div>
            <label for="email" class="mb-1 block text-sm font-semibold text-slate-700">Email</label>
            <input
                id="email"
                name="email"
                type="email"
                value="{{ old('email') }}"
                required
                autocomplete="username"
                placeholder="namamu@email.com"
                class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-800 placeholder-slate-400 transition focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 @error('email') border-rose-400 @enderror"
            >
        </div>

        {{-- Password --}}
        <div>
            <label for="password" class="mb-1 block text-sm font-semibold text-slate-700">Password</label>
            <input
                id="password"
                name="password"
                type="password"
                required
                autocomplete="new-password"
                placeholder="Minimal 8 karakter"
                class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-800 placeholder-slate-400 transition focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 @error('password') border-rose-400 @enderror"
            >
            <p class="mt-1 text-[11px] text-slate-400">Minimal 8 karakter dengan huruf, angka, dan simbol</p>
        </div>

        {{-- Confirm Password --}}
        <div>
            <label for="password_confirmation" class="mb-1 block text-sm font-semibold text-slate-700">Ulangi Password</label>
            <input
                id="password_confirmation"
                name="password_confirmation"
                type="password"
                required
                autocomplete="new-password"
                placeholder="Ketik ulang password"
                class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-800 placeholder-slate-400 transition focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500/20"
            >
        </div>

        {{-- Submit --}}
        <button
            type="submit"
            class="w-full rounded-xl bg-gradient-to-r from-indigo-500 to-violet-600 px-4 py-3 text-sm font-bold text-white shadow-lg shadow-indigo-500/30 transition hover:opacity-90 active:scale-[0.98]"
        >
            Buat Akun
        </button>
    </form>

    <p class="mt-5 text-center text-sm text-slate-500">
        Sudah punya akun?
        <a href="{{ route('login') }}" class="font-bold text-indigo-600 transition hover:text-indigo-800">Masuk</a>
    </p>

    <script>
        function previewPhoto(input) {
            const file = input.files[0];
            if (!file) return;

            if (file.size > 2 * 1024 * 1024) {
                alert('Ukuran foto maksimal 2 MB.');
                input.value = '';
                return;
            }

            const reader = new FileReader();
            reader.onload = function (e) {
                document.getElementById('photo-preview-img').src = e.target.result;
                document.getElementById('photo-preview-img').classList.remove('hidden');
                document.getElementById('photo-preview-icon').classList.add('hidden');
            };
            reader.readAsDataURL(file);
        }
    </script>
@endsection