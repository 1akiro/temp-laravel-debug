<x-layout>
    <x-slot name="title">
        {{ __('auth.login_title') }}
    </x-slot>
    <div class="mt-li3 mb-li5 sm:mx-auto sm:w-full sm:max-w-sm">

        <form class="space-y-ma3" action="{{ route('login') }}" method="POST">
            @csrf
            <h2 class="text-center font-bold text-2xl">
                {{ __('auth.login_title')}}
            </h2>
            <div>
                <label class="block text-sm/6 font-medium text-gray-900" for="email">{{ __('user.email')}}</label>
                <div class="mt-ma1">
                    <input
                        class="block w-full rounded-md bg-white
                        px-3 py-1.5 text-base text-gray-900 outline-1
                        -outline-offset-1 outline-gray-300 placeholder:text-gray-400
                        focus:outline-2 focus:-outline-offset-2 focus:outline-orange-500
                        sm:text-sm/6"
                        type="email"
                        name="email"
                        required
                        value="{{ old('email') }}"
                    />
                    @error('email') <small class="text-red">{{ $message }}</small>@enderror
                </div>
            </div>
            <div>
                <label for="password" class="block text-sm/6 font-medium text-gray-900">{{ __('user.password') }}</label>
                <div class="mt-ma1">
                    <input
                        class="block w-full rounded-md bg-white
                        px-3 py-1.5 text-base text-gray-900 outline-1
                        -outline-offset-1 outline-gray-300 placeholder:text-gray-400
                        focus:outline-2 focus:-outline-offset-2 focus:outline-orange-500
                        sm:text-sm/6"
                        type="password"
                        name="password"
                        required
                    />
                    @error('password') <small class="text-red">{{ $message }}</small>@enderror

                </div>
            </div>
            <div>
                <button type="submit" class="bg-orange-500 hover:bg-orange-400 text-white
                    font-bold py-2 px-4 mt-ma2 border-b-4 border-orange-600
                    hover:border-orange-500 rounded-xl w-full">
                    {{ __('auth.login_title') }}
                </button>
            </div>
        </form>
    </div>
</x-layout>
