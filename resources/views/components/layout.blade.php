<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        @vite('resources/css/app.css')
        <title>{{ $title }}</title>
    </head>
    <body>
        <div class="top-0 z-[20]">
            <x-navbar/>
            @auth
            @if($user->isAdmin())
            <x-admin-navbar />
            @endif
            @endauth
        </div>
        <main class="min-h-screen max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            {{ $slot }}
        </main>
        <x-footer />
        @stack('scripts')

    </body>
</html>
