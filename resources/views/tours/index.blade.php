<x-layout>
    <x-slot name="title">
        Katalogs
    </x-slot>
    @if ($tours->count())
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($tours as $tour)
        <x-tour-card :tour="$tour" />
        @endforeach
    </div>
    @else
    <div class="bg-red">No job tours available.</div>
    @endif
</x-layout>
