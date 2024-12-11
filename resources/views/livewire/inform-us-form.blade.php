<div class="flex flex-col sm:justify-center items-center py-6">
    <div>
        <a class="" href="{{ route('home') }}">
            <img src="{{ url('/image/logo-app.png') }}" class="w-60" alt="logo" />
        </a>
    </div>
    <div class="w-full sm:max-w-xl my-6 px-6 py-6 bg-white overflow-hidden sm:rounded-lg">

        <h3 class="text-xl font-semibold">Добавить проект</h3>
        <p class="text-sm">Укажите данные вашего проекта. После проверки, он окажеться на портале</p>
        <hr class="my-4">

        <!-- Session Status -->

        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('inform-us') }}">
            @csrf

            @if (session('error'))
                <x-input-error :messages="session('error')" class="mt-2 mb-3" />
            @endif

            <!-- Category -->
            <div>
                <div class="bg-white mt-3 basis-full rounded-md block ">
                    <select name="category"
                        class="w-full border-1 rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                        required autocomplete="off">
                        <option value="">Выберите категорию</option>
                        <option value='companies'>Компания</option>
                        <option value='groups'>Сообщества</option>
                        <option value='places'>Интересные места</option>
                    </select>
                </div>
                <x-input-error :messages="$errors->get('category')" class="mt-2" />
            </div>

            <!-- Region -->
            <div class="mt-4">
                <div class="bg-white mt-3 basis-full rounded-md block ">
                    <select name="region" required
                        class="w-full border-1 rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                        autocomplete="off">
                        <option value="">Выберите область</option>
                        @foreach ($regions as $region)
                            <option value='{{ $region->id }}'>{{ $region->name }}</option>
                        @endforeach
                    </select>
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Name -->
            <div class="mt-4">
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
                    placeholder="Название" required />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Description -->
            <div class="mt-4">
                <textarea id="description"
                    class="block mt-1 w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" type="text"
                    name="description" :value="old('description')" placeholder="Описание" required></textarea>
                <x-input-error :messages="$errors->get('description')" class="mt-2" />
            </div>




            <h4 class="text-xl font-semibold mt-4">Ваши контакты</h4>
            <hr class="mb-4 mt-2">

            <!-- First Name -->
            <div>
                <x-text-input id="firstname" class="block mt-1 w-full" type="text" name="firstname" :value="old('firstname')"
                    placeholder="Ваше имя" required autofocus autocomplete="firstname" />
                <x-input-error :messages="$errors->get('firstname')" class="mt-2" />
            </div>

            <!-- Phone -->
            <div class="mt-4">
                <x-text-input id="phone" class="block my-2 w-full mask-phone" type="tel" name="phone"
                    placeholder="Ваше телефон" :value="old('phone')" required autofocus autocomplete="phone" />
                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
            </div>



            <div class="flex items-center justify-center mt-4">

                <div class="flex items-center justify-end">
                    <x-primary-button class="px-3">
                        {{ __('отправить') }}
                    </x-primary-button>
                </div>

            </div>
        </form>
    </div>

    @vite(['resources/js/mask_phone.js'])

</div>
