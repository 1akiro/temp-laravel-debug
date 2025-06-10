<x-admin-layout>
    <x-slot name="title">
        Lietotāji
    </x-slot>
    <div class="flex justify-center my-ma4">
        <form action="{{ route('user.index') }}" method="GET" class="flex w-full max-w-xl">
            <input 
                type="text" 
                name="query" 
                placeholder="Meklēt lietotājus..." 
                class="border border-gray-300 px-4 py-2 rounded-l w-full"
                value="{{ request('query') }}"
            >
            <button type="submit" class="bg-green-700 text-white px-6 py-2 rounded-r">Meklēt</button>
            @if(request('query'))
                <a href="{{ route('user.index') }}" class="bg-gray-300 text-gray-700 px-4 py-2 ml-2 rounded">Clear</a>
            @endif
        </form>
    </div>
    @if ($users->count())
    <div class="min-h-screen">
        <div class="w-full text-sm font-semibold text-white border-b border-gray-400 px-4 py-2 bg-green-700">
            <div class="flex justify-between">
                <div class="w-1/12">ID</div>
                <div class="w-4/12">Vārds</div>
                <div class="w-4/12">E-Pasts</div>
                <div class="w-4/12">Loma</div>
                <div class="w-4/12">Rediģet</div>
                <div class="w-4/12 text-right">Reģistrēts</div>
            </div>
        </div>
        <div class="w-full">
            @foreach ($users as $user)
            <x-user-card :user="$user" />
            @endforeach
        </div>

    </div>
    @else
    <div class="bg-red">No job tours available.</div>
    @endif
</x-admin-layout>
