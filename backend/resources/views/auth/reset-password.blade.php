@extends('layouts.auth')

@section('title', 'Reset Password')

@section('auth-content')
    <div class="mb-6 text-center">
        <span class="mx-auto mb-3 flex h-14 w-14 items-center justify-center rounded-2xl bg-emerald-100 text-emerald-600">
            <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 9.9-1"/></svg>
        </span>
        <h1 class="text-2xl font-extrabold text-slate-900">Atur Password Baru</h1>
        <p class="mt-1 text-sm text-slate-500">Buat password baru yang kuat dan ingat selalu 🔐</p>
    </div>

    <form method="POST" action="{{ route('password.store') }}" class="space-y-4">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">

        <div>
            <label for="email" class="mb-1 block text-sm font-semibold text-slate-700">Email</label>
            <input
                id="email"
                name="email"
                type="email"
                value="{{ old('email', request('email')) }}"
                required
                autofocus
                autocomplete="username"
                class="w-full rounded-xl border border-slate-300 bg-slate-50 px-4 py-3 text-sm text-slate-800 transition focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 @error('email') border-rose-400 @enderror"
            >
        </div>

        <div>
            <label for="password" class="mb-1 block text-sm font-semibold text-slate-700">Password Baru</label>
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

        <div>
            <label for="password_confirmation" class="mb-1 block text-sm font-semibold text-slate-700">Ulangi Password Baru</label>
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

        <button
            type="submit"
            class="w-full rounded-xl bg-gradient-to-r from-indigo-500 to-violet-600 px-4 py-3 text-sm font-bold text-white shadow-lg shadow-indigo-500/30 transition hover:opacity-90 active:scale-[0.98]"
        >
            Simpan Password Baru
        </button>
    </form>
@endsection