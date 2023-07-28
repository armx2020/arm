<x-guest-layout>

    <form method="POST" action="{{ route('register.phone') }}">
        @csrf

        <div>
            <div class="w-full sm:max-w-md mt-6 px-1 py-4 bg-white overflow-hidden sm:rounded-lg z-50">
                <div class="flex items-center justify-between my-3">
                    <p class="text-lg font-bold text-gray-900">
                        РЕГИСТРАЦИЯ
                    </p>
                    <p class="text-sm text-gray-400">
                        ШАГ 2/3
                    </p>
                </div>

                <hr class="my-4">


                @if ($messages)
                @foreach($messages as $err)
                <x-input-error :messages="$err" class="mt-2 mb-3" />
                @endforeach
                @endif

                <!-- Phone -->
                <div>
                    <x-text-input id="Phone" class="block my-2 w-full mask-phone" placeholder="Номер телефона" type="tel" name="phone" :value="old('phone')" require autofocus autocomplete="phone" />
                    <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                </div>
                <div class="flex items-center justify-between mt-4">
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('register') }}">
                        {{ __('вернуться назад') }}
                    </a>
                    <x-primary-button type="submit" class="ml-4">
                        {{ __('ПРИСЛАТЬ КОД') }}
                    </x-primary-button>
                </div>
            </div>
        </div>

    </form>
</x-guest-layout>