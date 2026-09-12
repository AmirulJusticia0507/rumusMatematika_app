@extends('layouts.auth')

@section('title', 'Lupa Password')

@section('auth-content')
    <div class="mb-6 text-center">
        <span class="mx-auto mb-3 flex h-14 w-14 items-center justify-center rounded-2xl bg-indigo-100 text-indigo-600">
            <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
        </span>
        <h1 class="text-2xl font-extrabold text-slate-900">Lupa Password?</h1>
        <p class="mt-1 text-sm text-slate-500">Tenang, kami kirim link reset ke email kamu 💌</p>
    </div>

    @if (session('dev_reset_url'))
        <div class="mb-5 rounded-xl border border-amber-200 bg-amber-50 p-4">
            <p class="text-xs font-bold uppercase tracking-wide text-amber-700">Dev / lokal — link reset kamu:</p>
            <a href="{{ session('dev_reset_url') }}" class="mt-1 block break-all text-sm font-semibold text-amber-800 underline">{{ session('dev_reset_url') }}</a>
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
        @csrf

        <div>
            <label for="email" class="mb-1 block text-sm font-semibold text-slate-700">Email Terdaftar</label>
            <input
                id="email"
                name="email"
                type="email"
                value="{{ old('email') }}"
                required
                autofocus
                autocomplete="email"
                placeholder="namamu@email.com"
                class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-800 placeholder-slate-400 transition focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 @error('email') border-rose-400 @enderror"
            >
        </div>

        <button
            type="submit"
            class="w-full rounded-xl bg-gradient-to-r from-indigo-500 to-violet-600 px-4 py-3 text-sm font-bold text-white shadow-lg shadow-indigo-500/30 transition hover:opacity-90 active:scale-[0.98]"
        >
            Kirim Link Reset
        </button>
    </form>

    <p class="mt-5 text-center text-sm text-slate-500">
        Ingat passwordnya?
        <a href="{{ route('login') }}" class="font-bold text-indigo-600 transition hover:text-indigo-800">Masuk</a>
    </p>
@endsection