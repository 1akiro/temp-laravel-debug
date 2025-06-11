<nav class="lg:flex bg-dark w-full px-ma4 lg:px-li4 py-ma3 hidden">
    <!-- Desktop Navbar -->
    <div class="flex justify-between items-center w-full">
        <div class="flex space-x-ma5 text-ma4 font-semibold text-white">
            <a href="{{ route('dashboard') }}">{{ __('navigation.dashboard') }}</a>
            <a href="{{ route('tour.create') }}">
                {{ __('tour.publish_tour')  }}
            </a>
        </div>
    </div>
</nav>


