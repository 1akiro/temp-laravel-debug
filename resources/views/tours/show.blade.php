<x-layout>
    <x-slot name="title">
        {{ $tour->title }}
    </x-slot>
    <div class="w-full aspect-video rounded-xl shadow-lg overflow-hidden border border-gray-100">
        <iframe
            src="{{ Storage::url($tour->tour_url) }}"
            frameborder="0"
            allowfullscreen
            class="w-full h-full"
        ></iframe>
    </div>
    <div class="mt-ma5">
        <a href="{{ route('tour.index')}}" class="bg-green-700 hover:bg-green-600 text-white font-bold py-2 px-4 mr-ma2  border-green-800 hover:border-green-700 rounded-xl">Atgriezties</a>
        <a href="{{ Storage::url($tour->tour_url) }}" target="_blank"
            class="bg-green-700 hover:bg-green-600 text-white font-bold py-2 px-4 mr-ma2  border-green-800 hover:border-green-700 rounded-xl">
            🌐 Skatīt tūri
        </a>
    </div>


    <div class="my-ma5">
        <h1 class="mb-ma1 text-ma5 font-semibold">{{ $tour->title }}</h1>
        <div class="flex space-x-ma5">
        <h5 class="text-gray-500 font-semibold">{{ $tour->company_name }}</h5>
        <a href="{{ route('user.show', $tour->user) }}">Publicēja: <strong class="text-dark">{{ $tour->user->name ?? 'Unknown'}}<strong/></a>
        </div>
        <p class="">{{ $tour->description }}</p>
    </div>
    <div class="flex flex-wrap items-center gap-4 bg-gray-100 rounded-lg p-4 mb-4 border border-gray-200">
        <a href="{{ route('tour.edit', $tour->id)}}" class="bg-green-700 hover:bg-green-600 text-white font-bold py-2 px-4 mr-ma2  border-green-800 hover:border-green-700 rounded-xl">Rediģēt</a>
        <form action="{{ route('tour.destroy', $tour) }}" method="POST" onsubmit="return
            confirm('Are you sure you want to delete this tour?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-orange-500 hover:bg-orange-400 text-white font-bold py-2 px-4 mr-ma2  border-orange-600 hover:border-orange-700 rounded-xl">Delete</button>
        </form>
        <form method="POST" action="{{ route('tour.visibility', $tour) }}" class="inline align-middle">
            @csrf
            @method('PATCH')
            <label class="flex items-center cursor-pointer">
                <div class="relative">
                    <input type="checkbox" name="is_active" onchange="this.form.submit()" {{ $tour->is_active ? 'checked' : '' }} class="sr-only peer">
                    <div class="w-11 h-6 bg-gray-200 rounded-full peer-focus:outline-none peer-checked:bg-green-700 transition"></div>
                    <div class="absolute left-0.5 top-0.5 bg-white w-5 h-5 rounded-full transition peer-checked:translate-x-full"></div>
                </div>
                <span class="ml-3 text-sm font-medium text-gray-900">
                    {{ $tour->is_active ? 'Visible' : 'Hidden' }}
                </span>
            </label>
        </form>
    </div>
</x-layout>
