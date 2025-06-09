<x-layout>
    <x-slot name="title">
        {{ $user->name }}
    </x-slot>

    <div class="bg-white shadow-md rounded px-li1 pt-ma5 pb-ma3 mb-ma5">
        <div class="flex items-center mb-ma6">
            <div class="w-1/3">
                <h2 class="text-2xl font-bold">{{ $user->name }} Profile</h2>
            </div>
            <div class="w-2/3">
                <div class="flex justify-end">
                    <a href="{{ url()->previous() }}" class="bg-green-700 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-xl shadow-md">
                        Atpakaļ
                    </a>
                </div>
            </div>
        </div>

        <div class="mb-6">
            <div class="grid grid-cols-2 gap-ma4">
                <div>
                    <p class="text-green-700 font-bold">Vārds</p>
                    <p>{{ $user->name }}</p>
                </div>
                <div>
                    <p class="text-green-700 font-bold">Epasts</p>
                    <p>{{ $user->email }}</p>
                </div>
                <div>
                    <p class="text-green-700 font-bold">Pieveinojās:</p>
                    <p>{{ $user->created_at->format('Y-m-d') }}</p>
                </div>
                <div>
                    <p class="text-green-700 font-bold">Tūres:</p>
                    <p>{{ $tours->count() ?? 0 }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white shadow-md rounded px-li1 pt-ma5 pb-ma3 mb-ma5">
        <div class="flex items-center mb-6">
            <div class="w-1/2">
                <h2 class="text-xl font-bold">{{ $user->name }} tūres</h2>
            </div>
            <div class="w-1/2">
                <form action="{{ route('user.show', $user) }}" method="GET" class="flex justify-end">
                    <input
                        type="text"
                        name="query"
                        placeholder="Meklēt tūres..."
                        class="border border-gray-300 p-2 rounded-l"
                        value="{{ request('query') }}"
                    >
                    <button type="submit" class="bg-green-700 text-white px-4 py-2 rounded-r">Meklēt</button>
                    @if(request('query'))
                        <a href="{{ route('user.show', $user) }}" class="bg-gray-300 text-gray-700 px-4 py-2 ml-2 rounded">Clear</a>
                    @endif
                </form>
            </div>
        </div>

        @if(($tours && count($tours)) || (is_array($tours) && count($tours)))
            <ul class="divide-y divide-gray-200">
            @foreach($tours as $tour)
                <li class="py-4 flex justify-between items-center">
                    <div>
                        <a href="{{ route('tour.show', $tour) }}" class="text-green-700 font-semibold hover:underline text-lg">
                            {{ $tour->title }}
                        </a>
                        <div class="text-sm text-gray-600">
                            @if($tour->company_name)
                                <span class="mr-2">Company: {{ $tour->company_name }}</span>
                            @endif
                            <span class="mr-2">Created: {{ $tour->created_at->format('Y-m-d') }}</span>
                            <span class="mr-2">Status: {{ $tour->is_active ? 'Active' : 'Inactive' }}</span>
                        </div>
                    </div>
                    <div>
                        <a href="{{ route('tour.show', $tour) }}" class="bg-green-700 hover:bg-green-600 text-white font-bold py-1 px-3 rounded-xl text-sm">
                            Skatīt
                        </a>
                    </div>
                </li>
            @endforeach
            </ul>
        @else
        <p class="py-4 text-gray-600">Lietotājam {{ $user->name }} nav neviena tūre</p>
        @endif
    </div>
</x-layout>
