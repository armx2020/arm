<x-guest-layout>

    <form method="POST" action="{{ route('register.code') }}">
        @csrf

        <div class="w-full sm:max-w-md px-1 py-4 bg-white overflow-hidden sm:rounded-lg z-50">
            <div class="flex items-center justify-between my-3">
                <p class="text-lg font-bold text-gray-900">
                    РЕГИСТРАЦИЯ
                </p>
                <p class="text-sm text-gray-400">
                    ШАГ 3/3
                </p>
            </div>

            <hr class="my-4">

            @if ($count)
                @if ($count <= 3 && $count >= 0)
                <div class="flex items-center  mt-2 mb-3">
                    <p class="text-sm text-gray-400">
                        У вас {{ $count }} попыток
                    </p>
                </div>
                @endif
            @endif

                @if (session('error'))
                <x-input-error :messages="session('error')" class="mt-2 mb-3" />
                @endif

                <!-- confirm_phone -->
                <div>
                    <x-input-label for="code" :value="__('введите 6-значный код подтверждения')" />
                    <x-text-input id="code" class="block my-2 w-full" placeholder="введите код" type="text" name="code" :value="old('code')" require autofocus />
                    <x-input-error :messages="$errors->get('code')" class="mt-2" />
                </div>
                <div class="flex items-center justify-between mt-4">
                    <a href="{{ route('register') }}" class="popup-close underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        ВЕРНУТЬСЯ НАЗАД
                    </a>
                    <x-primary-button class="ml-4">
                        {{ __('Зарегистрироваться') }}
                    </x-primary-button>
                </div>
        </div>

    </form>
</x-guest-layout>