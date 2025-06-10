<x-layout>
    <x-slot name="title">
        Rediģēt {{ $user->name}}
    </x-slot>
    
    <form class="space-y-ma3" action="{{ route('user.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        <h2 class="font-bold text-2xl">Rediģēt {{ $user->name }}</h2>
        
        <div>
            <label class="block text-sm/6 font-medium text-gray-900" for="name">Vārds Uzvārds</label>
            <div class="mt-ma1">
                <input
                    class="block w-full rounded-md bg-white
                    px-3 py-1.5 text-base text-gray-900 outline-1
                    -outline-offset-1 outline-gray-300 placeholder:text-gray-400
                    focus:outline-2 focus:-outline-offset-2 focus:outline-orange-500
                    sm:text-sm/6"
                    type="text"
                    name="name"
                    id="name"
                    value="{{ old('name', $user->name) }}"
                />
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>
        
        <div>
            <label class="block text-sm/6 font-medium text-gray-900" for="email">E-pasta adrese</label>
            <div class="mt-ma1">
                <input
                    class="block w-full rounded-md bg-white
                    px-3 py-1.5 text-base text-gray-900 outline-1
                    -outline-offset-1 outline-gray-300 placeholder:text-gray-400
                    focus:outline-2 focus:-outline-offset-2 focus:outline-orange-500
                    sm:text-sm/6"
                    type="email"
                    name="email"
                    id="email"
                    value="{{ old('email', $user->email) }}"
                />
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>
        
        <div>
            <label class="block text-sm/6 font-medium text-gray-900" for="password">Jauna parole (atstājiet tukšu, ja nevēlaties mainīt)</label>
            <div class="mt-ma1">
                <input
                    class="block w-full rounded-md bg-white
                    px-3 py-1.5 text-base text-gray-900 outline-1
                    -outline-offset-1 outline-gray-300 placeholder:text-gray-400
                    focus:outline-2 focus:-outline-offset-2 focus:outline-orange-500
                    sm:text-sm/6"
                    type="password"
                    name="password"
                    id="password"
                />
                @error('password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>
        
        <div>
            <label class="block text-sm/6 font-medium text-gray-900" for="password_confirmation">Apstiprināt paroli</label>
            <div class="mt-ma1">
                <input
                    class="block w-full rounded-md bg-white
                    px-3 py-1.5 text-base text-gray-900 outline-1
                    -outline-offset-1 outline-gray-300 placeholder:text-gray-400
                    focus:outline-2 focus:-outline-offset-2 focus:outline-orange-500
                    sm:text-sm/6"
                    type="password"
                    name="password_confirmation"
                    id="password_confirmation"
                />
            </div>
        </div>
        <div>
            <label class="block text-sm/6 font-medium text-gray-900" for="role_id">Lietotāja loma</label>
            <div class="mt-ma1">
                <select
                    class="block w-full rounded-md bg-white
                    px-3 py-1.5 text-base text-gray-900 outline-1
                    -outline-offset-1 outline-gray-300 placeholder:text-gray-400
                    focus:outline-2 focus:-outline-offset-2 focus:outline-orange-500
                    sm:text-sm/6"
                    name="role_id"
                    id="role_id"
                >
                    @foreach($roles as $role)
                        <option value="{{ $role->id }}" {{ old('role_id', $user->role_id) == $role->id ? 'selected' : '' }}>
                            {{ $role->role }}
                        </option>
                    @endforeach
                </select>
                @error('role_id')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        
        <div class="flex justify-between">
            <div>
                <button type="submit" class="bg-green-700 hover:bg-green-600 text-white
                    font-bold py-2 px-4 border-b-4 border-green-800
                    hover:border-green-700 rounded-xl">Saglabāt izmaiņas</button>
                
                <a href="{{ route('user.show', $user) }}" class="bg-orange-500 hover:bg-orange-400 text-white
                    font-bold py-2 px-4 border-b-4 border-orange-800
                    hover:border-orange-500 rounded-xl ml-2">Atcelt</a>
            </div>
        </div>
    </form>

    <div class="mt-8 pt-6 border-t border-gray-200">
        <h3 class="font-bold text-xl text-red-600">Dzēst lietotāju</h3>
        <p class="text-gray-600 my-2">Šī darbība pilnībā dzēsīs lietotāja kontu un ir neatgriezeniska.</p>
        
        <form action="{{ route('user.destroy', $user) }}" method="POST" onsubmit="return confirm('Vai tiešām vēlaties dzēst šo lietotāju? Šī darbība nav atgriezeniska.');" class="inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-600 hover:bg-red-500 text-white
                font-bold py-2 px-4 border-b-4 border-red-700
                hover:border-red-600 rounded-xl">Dzēst lietotāju</button>
        </form>
    </div>
</x-layout>