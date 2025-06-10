<x-admin-layout>
    <x-slot name="title">Aktivitāšu žurnāls</x-slot>

    @if ($activities->isEmpty())
        <p class="text-gray-600">Nav nevienas aktivitātes.</p>
    @else
        <div class="w-full flex justify-between items-center bg-green-900 text-white px-4 py-2 text-sm font-bold">
            <div class="w-1/12">ID</div>
            <div class="w-3/12">Lietotājs</div>
            <div class="w-3/12">Tūre</div>
            <div class="w-2/12">Darbība</div>
            <div class="w-3/12 text-right">Datums</div>
        </div>

        <div class="w-full">
            @foreach ($activities as $activity)
                <x-activity-card :activity="$activity" />
            @endforeach
        </div>
    @endif
</x-admin-layout>

