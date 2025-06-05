<!doctype html>
<html lang="lv">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        @vite('resources/css/app.css')
        <title>{{ $title }}</title>
    </head>
    <body>
        <x-navbar />
        <x-admin-navbar />
        <main class="min-h-screen max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            {{ $slot }}
        </main>
        <x-footer />
    </body>
</html>
