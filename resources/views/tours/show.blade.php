<x-layout>
    <x-slot name="title">
        {{ $tour->title }}
    </x-slot>
    <div class="w-full aspect-video rounded-xl shadow-lg overflow-hidden border border-gray-300">
        <iframe
            src="{{ $tour->tour_url }}"
            frameborder="0"
            allowfullscreen
            class="w-full h-full"
        ></iframe>
    </div>
        <h1 class="mb-4">{{ $tour->title }}</h1>
        <h5 class="mb-2 text-muted">{{ $tour->company_name }}</h5>
        <p class="mb-2">{{ $tour->description }}</p>
        <a href="{{ route('tour.index')}}" class="">Atgriezties</a>
</x-layout>
