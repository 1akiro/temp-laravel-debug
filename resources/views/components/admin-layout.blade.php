<!doctype html>
<html lang="lv">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        @vite('resources/css/app.css')
        <title>{{ $title }}</title>
    </head>
    <body>
        <x-sidebar />
        <main class="w-full md:w-[calc(100%-256px)] md:ml-64 min-h-screen transition-all main">
            <div class="top-0 z-[20]">
                <nav class="bg-white px-ma4 w-full py-ma5">
                    <!-- Desktop Navbar -->
                    <div class="hidden lg:flex justify-between items-center w-full">
                        <div class="text-green-700 text-ma6 font-bold">
                            Virtuālās tūres
                        </div>
                        <div class="flex space-x-ma5 text-ma4 font-semibold text-dark">
                            <a href="{{ route('home') }}">Sākumlapa</a>
                            <a href="{{ route('tour.index')}}">Katalogs</a>
                            <a href="#">Kontakti</a>
                        </div>
                        <div class="flex space-x-ma3">
                            <a class="hover:bg-green-700 hover:text-white text-dark font-bold py-2 px-4 border-2 border-green-700 hover:border-green-700 rounded-xl text-center min-w-[9rem]" href="{{ route('show.login') }}">Pieslēgties</a>
                        </div>
                    </div>

                    <div class="lg:hidden">
                        <div class="flex items-center justify-between w-full">
                            <div class="text-green-700 text-ma6 font-bold text-left">
                                Virtuālās tūres
                            </div>
                            <button onclick="toggleMobileNav()" class="text-dark text-2xl ml-auto">
                                ☰
                            </button>
                        </div>

                        <div id="mobileNav" class="hidden flex flex-col gap-ma4 mt-ma4 text-ma4 font-semibold text-dark items-start text-left">
                            <a href="{{ route('home') }}">Sākumlapa</a>
                            <a href="{{ route('tour.index')}}">Katalogs</a>
                            <a href="#">Kontakti</a>
                            <a href="{{ route('dashboard') }}">Informācijas panelis</a>
                            <a href="{{ route('tour.create') }}">Pievienot tūri</a>
                            <a class="hover:bg-green-700 hover:text-white text-dark font-bold py-2 px-4 border-2 border-green-700 hover:border-green-700 rounded-xl min-w-[10rem] text-left" href="{{ route('show.login') }}">Pieslēgties</a>
                        </div>
                    </div>
                </nav>
                <x-admin-navbar />
            </div>
            {{ $slot }}
            <x-footer />

        </main>
    </body>
</html>
