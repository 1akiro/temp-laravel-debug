<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        @vite('resources/css/app.css')
        <title>{{ $title }}</title>
    </head>
    <body>
        <x-sidebar/>
        <main class="w-full md:w-[calc(100%-256px)] md:ml-64 min-h-screen transition-all main">
            <div class="top-0 z-[20]">
                <nav class="bg-white px-ma4 w-full py-ma5">
                    <div class="hidden lg:flex justify-between items-center w-full">
                        <div class="text-green-700 text-ma5 font-bold">
                            {{ __('general.vr') }}
                        </div>
                        <div class="flex space-x-ma5 text-ma4 font-semibold text-dark">
                            <a href="{{ route('home') }}">
                                {{ __('navigation.home') }}
                            </a>
                            <a href="{{ route('tour.index')}}">
                                {{ __('navigation.catalog') }}
                            </a>
                            <a href="#">
                                {{ __('navigation.contacts') }}
                            </a>
                        </div>
                        <div class="flex space-x-ma3">
                            @auth
                            <a href="{{ route('user.show', $user) }}">
                                <strong>{{ $user->name ?? $user->username ?? $user->email }}</strong></a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="text-green-700">
                                    {{ __('navigation.logout') }}
                                </button>
                            </form>
                            @endauth
                        </div>
                    </div>

                    <div class="lg:hidden">
                        <div class="flex items-center justify-between w-full">
                            <div class="text-green-700 text-ma6 font-bold text-left">
                                {{ __('general.vr') }}
                            </div>
                            <button onclick="toggleMobileNav()" class="text-dark text-2xl ml-auto">
                                ☰
                            </button>
                        </div>

                        <div id="mobileNav" class="hidden flex flex-col gap-ma4 mt-ma4 text-ma4 font-semibold text-dark items-start text-left">
                            <a href="{{ route('home') }}">
                                {{ __('navigation.home') }}
                            </a>
                            <a href="{{ route('tour.index')}}">
                                {{ __('navigation.catalog') }}
                            </a>
                            <a href="#">
                                {{ __('navigation.contacts') }}
                            </a>
                            <a href="{{ route('dashboard') }}">
                                {{ __('navigation.dashboard') }}
                            </a>
                            <a href="{{ route('tour.create') }}">
                                {{ __('tour.publish_tour') }}
                            </a>
                        </div>
                    </div>
                </nav>
                <x-admin-navbar />
            </div>
            {{ $slot }}
            <x-footer />
        </main>
        @stack('scripts')

    </body>
</html>
