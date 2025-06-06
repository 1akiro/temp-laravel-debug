<x-admin-layout>
    <x-slot name="title">
        Lietotāji
    </x-slot>
    @if ($users->count())
    <div class="min-h-screen">
        <div class="w-full text-sm font-semibold text-white border-b border-gray-400 px-4 py-2 bg-green-700">
            <div class="flex justify-between">
                <div class="w-1/12">ID</div>
                <div class="w-4/12">Name</div>
                <div class="w-4/12">Email</div>
                <div class="w-4/12">Role</div>
                <div class="w-4/12">Action</div>
                <div class="w-4/12 text-right">Registered</div>
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
