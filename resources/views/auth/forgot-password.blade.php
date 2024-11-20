<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Забыли свой пароль? Без проблем. Просто сообщите нам свой номер телефона, и мы вышлем вам проверочный код') }}
    </div>

    <hr class="my-4">

    @if (session('error'))
        <x-input-error :messages="session('error')" class="mt-2 mb-3" />
    @endif

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.phone') }}">
        @csrf

        <!-- Phone -->
        <div class="mt-4">
            <x-input-label for="phone" :value="__('Телефон')" />
            <x-text-input id="phone" class="block my-2 w-full mask-phone" type="tel" name="phone"
                :value="old('phone')" required autofocus autocomplete="phone" />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Отправить код') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
