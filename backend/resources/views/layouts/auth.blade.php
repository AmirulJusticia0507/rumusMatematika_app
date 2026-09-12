<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title', 'RumusKu') — <?= config('app.name') ?></title>
        <meta name="description" content="Masuk atau daftar untuk mulai belajar rumus matematika.">

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700,800" rel="stylesheet" />

        @if (file_exists(public_path('build/manifest.json')))
            @vite(['resources/css/app.css'])
        @else
            <script src="https://cdn.tailwindcss.com"></script>
            <style>
                body { font-family: 'Instrument Sans', ui-sans-serif, system-ui, sans-serif; }
            </style>
        @endif
    </head>
    <body class="flex min-h-screen items-center justify-center bg-slate-50 px-4 py-10 antialiased">
        <div class="w-full max-w-md">
            <a href="{{ route('rumus.index') }}" class="mb-6 flex justify-center">
                <span class="flex items-center gap-3">
                    <span class="flex h-11 w-11 items-center justify-center rounded-2xl bg-gradient-to-br from-indigo-500 to-violet-600 text-xl font-black text-white shadow-lg shadow-indigo-500/25">Σ</span>
                    <span class="text-left leading-tight">
                        <span class="block text-lg font-extrabold text-slate-900">RumusKu</span>
                        <span class="block text-xs font-medium text-slate-500">Matematika Seru</span>
                    </span>
                </span>
            </a>

            <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-xl shadow-slate-900/5 sm:p-8">
                @if ($errors->any())
                    <div class="mb-5 rounded-xl border border-rose-200 bg-rose-50 p-4">
                        <p class="text-sm font-semibold text-rose-800">Ups, ada yang perlu diperbaiki:</p>
                        <ul class="mt-2 space-y-1 text-sm text-rose-700">
                            @foreach ($errors->all() as $error)
                                <li class="flex gap-2"><span class="mt-0.5">•</span>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('status'))
                    <div class="mb-5 rounded-xl border border-emerald-200 bg-emerald-50 p-4 text-sm font-medium text-emerald-800">
                        {{ session('status') }}
                    </div>
                @endif

                @yield('auth-content')
            </div>

            <p class="mt-6 text-center text-xs text-slate-400">
                © {{ date('Y') }} RumusKu · Belajar matematika jadi menyenangkan ✨
            </p>
        </div>
    </body>
</html>