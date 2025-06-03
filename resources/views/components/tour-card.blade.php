
<div class="max-w-sm mx-auto bg-white shadow-lg rounded-xl overflow-hidden transition-transform transform hover:bg-gray-100">
    <img class="w-full h-48 object-cover" src="{{ $tour->thumbnail }}" alt="{{ $tour->title }}">

    <div class="p-4">
        <h2 class="text-xl font-semibold text-gray-800">{{ $tour->title }}</h2>
        <p class="text-gray-600 mt-2 text-sm">{{ Str::limit($tour->description, 100) }}</p>

        <div class="mt-4">
            <a href="{{ route('tour.show', $tour) }}" target="_blank" class="bg-green-700 hover:bg-green-600 text-white font-bold py-2 px-4 mr-ma2  border-green-800 hover:border-green-700 rounded-xl">
                Skatīt tūri
            </a>
        </div>
    </div>
</div>
