<x-admin-layout>
    <x-slot name="title">
        Informācijas panelis
    </x-slot>
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6a mb-6">
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-xl font-bold text-gray-800 mb-2">Kopējie skatījumi</h3>
            <p class="text-3xl font-bold text-green-700">{{ number_format($totalViews) }}</p>
        </div>
        
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-xl font-bold text-gray-800 mb-2">Nedēļas skatījumi</h3>
            <p class="text-3xl font-bold text-green-700">{{ number_format($viewsLast7Days) }}</p>
        </div>
        
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-xl font-bold text-gray-800 mb-2">Šodienas skatījumi</h3>
            <p class="text-3xl font-bold text-green-700">{{ number_format($viewsToday) }}</p>
        </div>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-xl font-bold text-gray-800 mb-4">Skatītākās tūres</h3>
            
            @if($topTours->count())
                <ul class="divide-y divide-gray-200">
                    @foreach($topTours as $tour)
                        <li class="py-3 flex justify-between">
                            <a href="{{ route('tour.show', $tour) }}" class="text-blue-600 hover:underline">
                                {{ $tour->title }}
                            </a>
                            <span class="font-medium">{{ number_format($tour->view_count) }} skatījumi</span>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-gray-500">No tour views recorded yet.</p>
            @endif
        </div>
        
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-xl font-bold text-gray-800 mb-4">Aktivākie lietotāji</h3>
            
            @if($activeUsers->count())
                <ul class="divide-y divide-gray-200">
                    @foreach($activeUsers as $user)
                        <li class="py-3 flex justify-between">
                            <a href="{{ route('user.show', $user) }}" class="text-blue-600 hover:underline">
                                {{ $user->name }}
                            </a>
                            <span class="font-medium">{{ number_format($user->view_count) }} skatījumi</span>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-gray-500">No user views recorded yet.</p>
            @endif
        </div>
    </div>
    
    <div class="mt-6 bg-white rounded-lg shadow p-6">
        <h3 class="text-xl font-bold text-gray-800 mb-4">Trendi (pēdējās 30 dienas)</h3>
        <div style="height: 300px;">
            <canvas id="viewsChart"></canvas>
        </div>
    </div>
    
    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('viewsChart').getContext('2d');
            
            const viewsChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: @json($viewDates),
                    datasets: [{
                        label: 'Dienas skatījumi',
                        data: @json($viewCounts),
                        backgroundColor: 'rgba(34, 197, 94, 0.2)',
                        borderColor: 'rgba(34, 197, 94, 1)',
                        borderWidth: 2,
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                precision: 0
                            }
                        }
                    }
                }
            });
        });
    </script>
    @endpush
</x-admin-layout>