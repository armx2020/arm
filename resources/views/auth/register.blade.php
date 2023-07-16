<x-guest-layout>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="flex items-center justify-between mb-2">
            <p class="text-lg font-bold text-gray-900">
                РЕГИСТРАЦИЯ
            </p>
            <p class="text-sm text-gray-400">
                ШАГ 1/3
            </p>
        </div>

        <hr class="my-4">

        @if (session('error'))
        <x-input-error :messages="session('error')" class="mt-2 mb-3" />
        @endif

        <!-- First Name -->
        <div>
            <x-input-label for="firstname" :value="__('Имя')" />
            <x-text-input id="firstname" class="block mt-1 w-full" type="text" name="firstname" :value="old('firstname')" required autofocus autocomplete="firstname" />
            <x-input-error :messages="$errors->get('firstname')" class="mt-2" />
        </div>

        <!-- Last Name -->
        <div class="mt-4">
            <x-input-label for="lastname" :value="__('Фамилия')" />
            <x-text-input id="lastname" class="block mt-1 w-full" type="text" name="lastname" :value="old('lastname')" required autofocus autocomplete="lastname" />
            <x-input-error :messages="$errors->get('lastname')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Пароль')" />

            <x-text-input id="password" placeholder="минимум 8 символов" class="block mt-1 w-full" :value="old('password')" type="password" name="password" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Подтвердите пароль')" />

            <x-text-input id="password_confirmation" placeholder="минимум 8 символов" class="block mt-1 w-full" :value="old('password_confirmation')" type="password" name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Уже зарегистрированы?') }}
            </a>

            <x-primary-button class="ml-4">
                {{ __('Далее') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>