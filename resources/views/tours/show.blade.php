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
    <div class="my-ma5">
        <h1 class="mb-ma4 text-ma5 font-semibold">{{ $tour->title }}</h1>
        <h5 class="">{{ $tour->company_name }}</h5>
        <p class="">{{ $tour->description }}</p>
    </div>
    <div class="mt-ma2 flex">
        <a href="{{ route('tour.index')}}" class="bg-green-700 hover:bg-green-600 text-white font-bold py-2 px-4 mr-ma2  border-green-800 hover:border-green-700 rounded-xl">Atgriezties</a>
        <a href="{{ route('tour.edit', $tour->id)}}" class="bg-green-700 hover:bg-green-600 text-white font-bold py-2 px-4 mr-ma2  border-green-800 hover:border-green-700 rounded-xl">Rediģēt</a>
        <form action="{{ route('tour.destroy', $tour) }}" method="POST" onsubmit="return
        confirm('Are you sure you want to delete this tour?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-orange-500 hover:bg-orange-400 text-white font-bold py-2 px-4 mr-ma2  border-orange-600 hover:border-orange-700 rounded-xl">Delete</button>
        </form>
    </div>
</x-layout>
