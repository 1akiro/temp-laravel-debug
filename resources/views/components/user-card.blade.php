<div class="w-full flex justify-between items-center border-b border-gray-300 px-4 py-2 text-sm text-gray-800 hover:bg-gray-100">
    <div class="w-1/12 font-medium">#{{ $user->id }}</div>
    <div class="w-4/12">{{ $user->name }}</div>
    <div class="w-4/12">{{ $user->email }}</div>
    <div class="w-4/12">{{ $user->role->role }}</div>
    <div class="w-4/12">Edit</div>
    <div class="w-4/12 text-right text-gray-600">
        {{ $user->created_at->format('Y-m-d H:i') }}
    </div>
</div>
