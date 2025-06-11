<div class="fixed left-0 top-0 w-64 h-full bg-dark p-4 z-50 sidebar-menu transition-transform">
    <ul class="mt-4">
        <span class="text-gray-200 font-bold">Admin</span>
        <li class="mb-ma1">
            <a href="{{ route('dashboard') }}" class="flex font-semibold items-center py-2 px-4 text-gray-100 hover:bg-green-700 hover:text-white rounded-md">
                <i class="ri-home-2-line mr-3 text-lg"></i>
                <span class="text-sm">
                    {{ __('navigation.dashboard') }}
                </span>
            </a>
        </li>
        <li class="mb-ma1">
            <a href="{{ route('user.index') }}" class="flex font-semibold items-center py-2 px-4 text-gray-100 hover:bg-green-700 hover:text-white rounded-md">
                <i class="ri-home-2-line mr-3 text-lg"></i>
                <span class="text-sm">
                    {{ __('navigation.users')}}
                </span>
            </a>
        </li>
        <li class="mb-ma1">
            <a href="{{ route('admin.activities') }}" class="flex font-semibold items-center py-2 px-4 text-gray-100 hover:bg-green-700 hover:text-white rounded-md">
                <i class="ri-home-2-line mr-3 text-lg"></i>
                <span class="text-sm">
                    {{ __('admin.activity_log') }}
                </span>
            </a>
        </li>
    </ul>
    <ul class="mt-4">
        <span class="text-gray-200 font-bold">Pieteikumi</span>
        <li class="mb-ma1">
            <a href="{{ route('dashboard') }}" class="flex font-semibold items-center py-2 px-4 text-gray-100 hover:bg-green-700 hover:text-white rounded-md">
                <i class="ri-home-2-line mr-3 text-lg"></i>
                <span class="text-sm">Biļetes</span>
            </a>
        </li>
        <li class="mb-ma1">
            <a href="{{ route('dashboard') }}" class="flex font-semibold items-center py-2 px-4 text-gray-100 hover:bg-green-700 hover:text-white rounded-md">
                <i class="ri-home-2-line mr-3 text-lg"></i>
                <span class="text-sm">Saziņa</span>
            </a>
        </li>
    </ul>
</div>
