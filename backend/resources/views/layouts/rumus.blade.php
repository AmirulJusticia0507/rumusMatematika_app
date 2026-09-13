<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title', 'Rumus Matematika')</title>
        <meta name="description" content="Kumpulan rumus matematika SD, SMP, dan SMA lengkap untuk belajar.">

        @include('partials.theme')

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700,800" rel="stylesheet" />

        @if (file_exists(public_path('build/manifest.json')))
            @vite(['resources/css/app.css'])
        @else
            <script>
                window.tailwind = { config: { darkMode: 'class' } };
            </script>
            <script src="https://cdn.tailwindcss.com"></script>
            <style>
                body { font-family: 'Instrument Sans', ui-sans-serif, system-ui, sans-serif; }
            </style>
        @endif
    </head>
    <body class="bg-slate-50 text-slate-800 antialiased dark:bg-slate-950 dark:text-slate-100">
        @include('rumus.partials.navbar')

        <main>
            @yield('content')
        </main>

        @include('rumus.partials.footer')
    </body>
</html>