@extends('layouts.auth')

@section('title', 'Masuk')

@section('auth-content')
    <div class="mb-6 text-center">
        <h1 class="text-2xl font-extrabold text-slate-900">Selamat Datang Kembali 👋</h1>
        <p class="mt-1 text-sm text-slate-500">Masuk untuk melanjutkan belajar matematika</p>
    </div>

    <form method="POST" action="{{ route('login.store') }}" class="space-y-4">
        @csrf

        <div>
            <label for="email" class="mb-1 block text-sm font-semibold text-slate-700">Email</label>
            <input
                id="email"
                name="email"
                type="email"
                value="{{ old('email') }}"
                required
                autofocus
                autocomplete="username"
                placeholder="namamu@email.com"
                class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-800 placeholder-slate-400 transition focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 @error('email') border-rose-400 @enderror"
            >
        </div>

        <div>
            <div class="mb-1 flex items-center justify-between">
                <label for="password" class="text-sm font-semibold text-slate-700">Password</label>
                <a href="{{ route('password.request') }}" class="text-xs font-semibold text-indigo-600 transition hover:text-indigo-800">Lupa password?</a>
            </div>
            <input
                id="password"
                name="password"
                type="password"
                required
                autocomplete="current-password"
                placeholder="••••••••"
                class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-800 placeholder-slate-400 transition focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 @error('password') border-rose-400 @enderror"
            >
        </div>

        <div class="flex items-center gap-2">
            <input
                id="remember"
                name="remember"
                type="checkbox"
                class="h-4 w-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500"
            >
            <label for="remember" class="text-sm text-slate-600">Ingat saya</label>
        </div>

        <button
            type="submit"
            class="w-full rounded-xl bg-gradient-to-r from-indigo-500 to-violet-600 px-4 py-3 text-sm font-bold text-white shadow-lg shadow-indigo-500/30 transition hover:opacity-90 active:scale-[0.98]"
        >
            Masuk
        </button>
    </form>

    <p class="mt-5 text-center text-sm text-slate-500">
        Belum punya akun?
        <a href="{{ route('register') }}" class="font-bold text-indigo-600 transition hover:text-indigo-800">Daftar sekarang</a>
    </p>
@endsection