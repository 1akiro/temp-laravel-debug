
<div class="max-w-sm mx-auto bg-white shadow-lg rounded-2xl overflow-hidden transition-transform transform hover:scale-105">
    <img class="w-full h-48 object-cover" src="{{ $tour->thumbnail }}" alt="{{ $tour->title }}">

    <div class="p-4">
        <h2 class="text-xl font-semibold text-gray-800">{{ $tour->title }}</h2>
        <p class="text-gray-600 mt-2 text-sm">{{ Str::limit($tour->description, 100) }}</p>

        <div class="mt-4">
            <a href="{{ route('tour.show', $tour->id) }}" target="_blank" class="inline-block px-4 py-2 text-sm text-white bg-indigo-600 rounded hover:bg-indigo-700 transition">
                Skatīt tūri
            </a>
        </div>
    </div>
</div>
