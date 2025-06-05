<x-layout>
    <x-slot name="title">
        Publicēt
    </x-slot>
    <form class="space-y-ma3" action="{{ route('tour.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <h2 class="font-bold text-2xl">Pievienot tūri</h2>
        <div>
            <label class="block text-sm/6 font-medium text-gray-900" for="name">Tūres nosaukums</label>
            <div class="mt-ma1">
                <input
                    class="block w-full rounded-md bg-white
                    px-3 py-1.5 text-base text-gray-900 outline-1
                    -outline-offset-1 outline-gray-300 placeholder:text-gray-400
                    focus:outline-2 focus:-outline-offset-2 focus:outline-orange-500
                    sm:text-sm/6"

                    type="text"
                    name="title"
                    required
                    value="{{ old('title') }}"
                />
            </div>
        </div>
        <div>
            <label class="block text-sm/6 font-medium text-gray-900" for="description">Apraksts</label>
            <div class="mt-ma1">
                <textarea
                    class="block w-full rounded-md bg-white
                    px-3 py-1.5 text-base text-gray-900 outline-1
                    -outline-offset-1 outline-gray-300 placeholder:text-gray-400
                    focus:outline-2 focus:-outline-offset-2 focus:outline-orange-500
                    sm:text-sm/6 resize-y min-h-[100px]"
                    name="description"
                    required
                >{{ old('description') }}</textarea>
            </div>
        </div>
        <div>
            <label class="block text-sm/6 font-medium text-gray-900" for="thumbnail">Augšupielādēt sīktēlu</label>
            <div class="mt-ma1">
                <input
                    class="block w-full text-sm text-gray-900
                    file:mr-4 file:py-2 file:px-4
                    file:rounded-md file:border-0
                    file:text-sm file:font-semibold
                    file:bg-orange-50 file:text-orange-700
                    hover:file:bg-orange-100"
                    type="file"
                    name="thumbnail"
                    accept="image/*"
                    id="file"
                    required
                />
            </div>
        </div>
        <div>
            <label class="block text-sm/6 font-medium text-gray-900" for="zip">Augšupielādēt failu</label>
            <div class="mt-ma1">
                <input
                    class="block w-full text-sm text-gray-900
                    file:mr-4 file:py-2 file:px-4
                    file:rounded-md file:border-0
                    file:text-sm file:font-semibold
                    file:bg-orange-50 file:text-orange-700
                    hover:file:bg-orange-100"
                    type="file"
                    name="zip"
                    accept=".zip"
                    id="file"
                    required
                />
            </div>
        </div>
        <div>
            <button type="submit" class="bg-orange-500 hover:bg-orange-400 text-white
                font-bold py-2 px-4 mt-ma2 border-b-4 border-orange-600
                hover:border-orange-500 rounded-xl">Augšupielādēt</button>

        </div>
    </form>

</x-layout>
