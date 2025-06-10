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
    <div class="mt-ma5">
        <a href="{{ route('tour.index')}}" class="bg-green-700 hover:bg-green-600 text-white font-bold py-2 px-4 mr-ma2  border-green-800 hover:border-green-700 rounded-xl">Atgriezties</a>
        <a href="{{ Storage::url($tour->tour_url) }}" target="_blank"
            class="bg-green-700 hover:bg-green-600 text-white font-bold py-2 px-4 mr-ma2  border-green-800 hover:border-green-700 rounded-xl">
            Skatīt tūri
        </a>
    </div>
    <div class="text-gray-600 flex items-center mt-ma3">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
            </svg>
        <span>{{ $tour->views->count() }} skatījumi</span>
    </div>


    <div class="my-ma5">
        <h1 class="mb-ma1 text-ma5 font-semibold">{{ $tour->title }}</h1>
        <div class="flex space-x-ma5">
            <h5 class="text-gray-500 font-semibold">{{ $tour->company_name }}</h5>
            <a href="{{ route('user.show', $tour->user) }}">
                Publicēja: <strong class="text-dark">{{ $tour->user->name ?? 'Unknown' }}</strong>
            </a>
        </div>
        <p class="font-normal mt-ma3">{{ $tour->description }}</p>
    </div>
    @can('update', $tour)
    <div class="flex flex-wrap items-center gap-ma3 bg-gray-100 rounded-lg p-4 mb-4 border border-gray-200">
        <a href="{{ route('tour.edit', $tour->id)}}" class="bg-green-700 hover:bg-green-600 text-white font-bold py-2 px-4 mr-ma2  border-green-800 hover:border-green-700 rounded-xl">Rediģēt</a>
        @can('delete', $tour)
        <form action="{{ route('tour.destroy', $tour) }}" method="POST" onsubmit="return
        confirm('Are you sure you want to delete this tour?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-orange-500 hover:bg-orange-400 text-white font-bold py-2 px-4 mr-ma2  border-orange-600 hover:border-orange-700 rounded-xl">Delete</button>
        </form>
        @endcan
        <button
            type="button"
            id="get-embed-code"
            class="bg-green-700 hover:bg-green-600 text-white font-bold py-2 px-4 mr-ma2  border-green-800 hover:border-green-700 rounded-xl"
        >
            Iegūt pirmkodu
        </button>
        <div id="embed-code-modal" class="fixed inset-0 bg-opacity-40 flex items-center justify-center z-50 hidden">
            <div class="bg-white rounded-lg shadow-lg p-ma5 w-full max-w-lg relative">
            <button id="close-embed-modal" class="absolute top-ma3 right-ma5 text-green-700 hover:text-green-500 text-2xl">&times;</button>
            <h2 class="text-lg font-semibold mb-4">Ievieto šo tūri savā mājaslapā</h2>
            <label class="block mb-2 text-sm text-green-600">Kopē pirmkodu:</label>
            <textarea
                readonly
                class="w-full mb-ma3 p-ma3 border rounded bg-gray-100 font-mono text-xs"
                rows="4"
                id="embed-code-text"
            ><iframe src="http://localhost:8000{{ Storage::url($tour->tour_url) }}" frameborder="0" allowfullscreen style="width:100%;height:500px;border-radius:12px;border:1px solid #eee;"></iframe></textarea>
            <button
                id="copy-embed-code"
                class="bg-green-700 hover:bg-green-600 text-white font-bold py-2 px-4 mr-ma2  border-green-800 hover:border-green-700 rounded-xl"
            >Kopēt</button>
            <span id="embed-copy-status" class="ml-3 text-sm"></span>
            </div>
        </div>
        <form method="POST" action="{{ route('tour.visibility', $tour) }}" class="inline align-middle">
            @csrf
            @method('PATCH')
            <label class="flex items-center cursor-pointer">
            <div class="relative">
                <input type="checkbox" name="is_active" onchange="this.form.submit()" {{ $tour->is_active ? 'checked' : '' }} class="sr-only peer">
                <div class="w-11 h-6 bg-gray-200 rounded-full peer-focus:outline-none peer-checked:bg-green-700 transition"></div>
                <div class="absolute left-0.5 top-0.5 bg-white w-5 h-5 rounded-full transition peer-checked:translate-x-full"></div>
            </div>
            <span class="ml-3 text-sm font-medium text-gray-900">
                {{ $tour->is_active ? 'Redzams' : 'Paslēpts' }}
            </span>
            </label>
        </form>
        @can('before', $tour)
        <div class="mb-4">
            <label for="assign_email" class="block text-sm/6 font-medium text-gray-900">Mainīt tūres autoru (meklēt pēc epasta):</label>
            <div class="flex space-x-ma3">
                <input
                    type="email"
                    name="assign_owner"
                    id="assign_owner"
                    class="block w-full rounded-md bg-white
                    px-ma3 py-ma1 text-base text-gray-900 outline-1
                    -outline-offset-1 outline-gray-300 placeholder:text-gray-400
                    focus:outline-2 focus:-outline-offset-2 focus:outline-orange-500
                    sm:text-sm/6"
                    value="{{ old('assign_owner') }}"
                >
                <div id="email-suggestions" class="absolute z-10 mt-li1 bg-white border border-gray-200 rounded-md shadow-lg hidden max-h-48 overflow-y-auto">
                </div>
                <button id="assign_owner_button" type="button"
                    class="w-full bg-orange-500 hover:bg-orange-400 text-white font-bold
                    py-ma2 px-ma4 mr-ma2  border-orange-600 hover:border-orange-700 rounded-xl">
                    Mainīt īpašnieku
                </button>
            </div>
            <span id="owner-change-status" class="text-sm"></span>
            @error('assign_owner')
            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
            @enderror
        </div>
        @endcan
    </div>
    @endcan
</x-layout>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const embedBtn = document.getElementById('get-embed-code');
    const embedModal = document.getElementById('embed-code-modal');
    const closeModal = document.getElementById('close-embed-modal');
    const copyBtn = document.getElementById('copy-embed-code');
    const embedTextarea = document.getElementById('embed-code-text');
    const copyStatus = document.getElementById('embed-copy-status');

    const emailInput = document.getElementById('assign_owner');
    const suggestionsContainer = document.getElementById('email-suggestions');
    let debounceTimer;


            embedBtn.addEventListener('click', function() {
            embedModal.classList.remove('hidden');
            embedTextarea.select();
            });

            closeModal.addEventListener('click', function() {
            embedModal.classList.add('hidden');
            copyStatus.textContent = '';
            });

            copyBtn.addEventListener('click', function() {
            embedTextarea.select();
            try {
                document.execCommand('copy');
                copyStatus.textContent = 'Copied!';
                copyStatus.className = 'ml-3 text-green-700 text-sm';
            } catch (e) {
                copyStatus.textContent = 'Failed to copy';
                copyStatus.className = 'ml-3 text-red-600 text-sm';
            }
            });

            // Close modal when clicking outside the modal content
            embedModal.addEventListener('click', function(e) {
            if (e.target === embedModal) {
                embedModal.classList.add('hidden');
                copyStatus.textContent = '';
            }
            });

    emailInput.addEventListener('input', function() {
        clearTimeout(debounceTimer);
        const query = this.value.trim();

        if (query.length < 2) {
            suggestionsContainer.classList.add('hidden');
            suggestionsContainer.innerHTML = '';
            return;
        }

        debounceTimer = setTimeout(() => {
            fetch(`/api/users/search?query=${encodeURIComponent(query)}`, {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
                .then(response => response.json())
                .then(data => {
                    suggestionsContainer.innerHTML = '';

                    if (data.length === 0) {
                        suggestionsContainer.classList.add('hidden');
                        return;
                    }

                    data.forEach(user => {
                        const suggestion = document.createElement('div');
                        suggestion.className = 'px-4 py-2 cursor-pointer hover:bg-gray-100';
                        suggestion.textContent = `${user.name} (${user.email})`;
                        suggestion.addEventListener('click', () => {
                            emailInput.value = user.email;
                            suggestionsContainer.classList.add('hidden');
                        });
                        suggestionsContainer.appendChild(suggestion);
                    });

                    suggestionsContainer.classList.remove('hidden');
                })
                .catch(error => {
                    console.error('Error fetching email suggestions:', error);
                });
        }, 300);
    });

    document.addEventListener('click', function(event) {
        if (!emailInput.contains(event.target) && !suggestionsContainer.contains(event.target)) {
            suggestionsContainer.classList.add('hidden');
        }
    });

    document.getElementById('assign_owner_button').addEventListener('click', function(event) {
        event.preventDefault();
        let email = document.getElementById('assign_owner').value;
        let status = document.getElementById('owner-change-status');
        status.textContent = '';

        fetch("{{ route('tour.changeOwner', $tour) }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({email: email})
        })
            .then(async r => {
                let data;
                try {
                    data = await r.json();
                } catch(e) {
                    throw new Error("Invalid server response");
                }
                if (!r.ok) {
                    throw new Error(data.error || "Server error");
                }
                return data;
            })
            .then(data => {
                status.textContent = `Īpašnieks nomainīts uz ${data.new_owner.name} (${data.new_owner.email})`;
                status.className = "text-green-700 text-sm";
            })
            .catch(err => {
                status.textContent = err.message;
                status.className = "text-red-600 text-sm";
            });
    });

});
</script>


