<nav class="bg-white w-full px-ma4 lg:px-li4 py-ma5">
    <!-- Desktop Navbar -->
    <div class="hidden lg:flex justify-between items-center w-full">
        <div class="text-ma5 text-green-700 font-bold">
            Virtuālās tūres
        </div>
        <div class="flex space-x-ma5 text-ma4 font-semibold text-dark">
            <a href="{{ route('home') }}">Sākumlapa</a>
            <a href="{{ route('tour.index')}}">Katalogs</a>
            <a href="#">Kontakti</a>
        </div>
        <div class="flex space-x-ma3">
            @auth
            <a href="{{ route('user.show', $user) }}"><strong>{{ $user->name ?? $user->username ?? $user->email }}</strong></a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-green-700">Atslēgties</button>
            </form>

            @else
            <a class="hover:bg-green-700 hover:text-white
                text-dark font-bold py-2 px-4 border-2
                border-green-700 hover:border-green-700
                rounded-xl min-w-[10rem] text-center" href="{{ route('show.login') }}">Pieslēgties</a>
            @endauth
        </div>
    </div>

    <div class="lg:hidden">
        <div class="flex items-center justify-between w-full">
            <div class="text-green-700 text-ma5 font-bold text-left">
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
            @auth
            <p>Pieslēdzies kā <strong>{{ $user->name ?? $user->username ?? $user->email }}</strong></p>
            @else
            <a class="hover:bg-green-700 hover:text-white text-dark font-bold py-2 px-4 border-2 border-green-700 hover:border-green-700 rounded-xl min-w-[10rem] text-left" href="{{ route('show.login') }}">Pieslēgties</a>

            @endauth
        </div>
    </div>
</nav>

<script>
function toggleMobileNav() {
    const nav = document.getElementById('mobileNav');
    nav.classList.toggle('hidden');
}
</script>

