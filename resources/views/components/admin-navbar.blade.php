<nav class="bg-dark sticky top-0 z-[20] w-full px-ma4 lg:px-li4 py-ma3">
    <!-- Desktop Navbar -->
    <div class="hidden lg:flex justify-between items-center w-full">
        <div class="flex space-x-ma5 text-ma4 font-semibold text-white">
            <a href="{{ route('home') }}">Informācijas panelis</a>
            <a href="{{ route('tour.create') }}">Pievienot tūri</a>
        </div>
    </div>

    <div class="lg:hidden">
        <div class="flex items-center justify-between w-full">
            <button onclick="toggleMobileNav()" class="text-dark text-2xl ml-auto">
                ☰
            </button>
        </div>

        <div id="mobileNav" class="hidden flex flex-col gap-ma4 mt-ma4 text-ma4 font-semibold text-dark items-start text-left">
            <a href="{{ route('home') }}">Sākumlapa</a>
            <a href="{{ route('tour.index')}}">Katalogs</a>
            <a href="#">Kontakti</a>
        </div>
    </div>
</nav>

<script>
function toggleMobileNav() {
    const nav = document.getElementById('mobileNav');
    nav.classList.toggle('hidden');
}
</script>

