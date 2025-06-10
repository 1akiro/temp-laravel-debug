@props(['activity'])

<div class="w-full flex justify-between items-center border-b border-gray-300 px-4 py-2 text-sm text-gray-800 hover:bg-gray-100">
    <div class="w-1/12 font-medium">#{{ $activity->id }}</div>
    <div class="w-3/12">{{ $activity->user_name }}</div>
    <div class="w-3/12">{{ $activity->tour_title }}</div>
    <div class="w-2/12">{{ $activity->activity_action }}</div>
    <div class="w-3/12 text-right text-gray-600">
        {{ \Carbon\Carbon::parse($activity->created_at)->format('Y-m-d H:i') }}
    </div>
</div>

