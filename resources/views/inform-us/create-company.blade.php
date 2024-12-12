@extends('layouts.app')
@section('title', '- СООБЩИТЕ НАМ')
@section('content')
    <x-pages.breadcrumbs :$secondPositionUrl :$secondPositionName />
    <section>
        <div class="flex flex-col sm:justify-center items-center py-6">
            <div>
                <a class="" href="{{ route('home') }}">
                    <img src="{{ url('/image/logo-app.png') }}" class="w-60" alt="logo" />
                </a>
            </div>

            @if (session('success'))
                <div class="mt-5 w-full sm:max-w-xl rounded-lg bg-green-100 px-6 py-5 text-base text-green-700"
                    role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <div class="w-full sm:max-w-xl my-6 px-6 py-6 bg-white overflow-hidden sm:rounded-lg">

                <h3 class="text-xl font-semibold">Добавить компанию</h3>
                <p class="text-sm">Укажите данные компании. После проверки, он окажеться на портале</p>
                <hr class="my-4">

                <!-- Session Status -->

                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('inform-us.store') }}">
                    @csrf

                    @if (session('error'))
                        <x-input-error :messages="session('error')" class="mt-2 mb-3" />
                    @endif

                    <!-- сategory -->
                    <div>
                        <div class="bg-white mt-3 basis-full rounded-md block ">
                            <select name="category"
                                class="w-full border-1 rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                required autocomplete="off">
                                <option value="">Выберите категорию</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <x-input-error :messages="$errors->get('category')" class="mt-2" />
                    </div>

                    <!-- сity -->
                    <div class="mt-4">
                        <div class="bg-white mt-3 basis-full rounded-md block ">
                            <select name="city" required
                                class="w-full border-1 rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                autocomplete="off">
                                <option value="">Выберите город</option>
                                @foreach ($cities as $city)
                                    <option value='{{ $city->id }}'>{{ $city->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- name -->
                    <div class="mt-4">
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                            :value="old('name')" placeholder="Название" required />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- phone -->
                    <div class="mt-4">
                        <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone"
                            :value="old('phone')" placeholder="Телефон" required />
                        <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                    </div>

                    <!-- address -->
                    <div class="mt-4">
                        <x-text-input id="address" class="block mt-1 w-full" type="text" name="address"
                            :value="old('address')" placeholder="Адрес" required />
                        <x-input-error :messages="$errors->get('address')" class="mt-2" />
                    </div>


                    <!-- phone -->
                    <div class="mt-4">
                        <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone"
                            :value="old('phone')" placeholder="Phone" required />
                        <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                    </div>

                    <!-- web -->
                    <div class="mt-4">
                        <x-text-input id="web" class="block mt-1 w-full" type="text" name="web"
                            :value="old('web')" placeholder="Веб-сайт" required />
                        <x-input-error :messages="$errors->get('web')" class="mt-2" />
                    </div>

                    <!-- telegram -->
                    <div class="mt-4">
                        <x-text-input id="telegram" class="block mt-1 w-full" type="text" name="telegram"
                            :value="old('telegram')" placeholder="Telegram" required />
                        <x-input-error :messages="$errors->get('telegram')" class="mt-2" />
                    </div>


                    <!-- whatsapp -->
                    <div class="mt-4">
                        <x-text-input id="whatsapp" class="block mt-1 w-full" type="text" name="whatsapp"
                            :value="old('whatsapp')" placeholder="Whatsapp" required />
                        <x-input-error :messages="$errors->get('whatsapp')" class="mt-2" />
                    </div>

                    <!-- viber -->
                    <div class="mt-4">
                        <x-text-input id="viber" class="block mt-1 w-full" type="text" name="viber"
                            :value="old('viber')" placeholder="Viber" required />
                        <x-input-error :messages="$errors->get('viber')" class="mt-2" />
                    </div>

                    <!-- vkontakte -->
                    <div class="mt-4">
                        <x-text-input id="vkontakte" class="block mt-1 w-full" type="text" name="vkontakte"
                            :value="old('vkontakte')" placeholder="Vkontakte" required />
                        <x-input-error :messages="$errors->get('vkontakte')" class="mt-2" />
                    </div>

                    <!-- instagram -->
                    <div class="mt-4">
                        <x-text-input id="instagram" class="block mt-1 w-full" type="text" name="instagram"
                            :value="old('instagram')" placeholder="Instagram" required />
                        <x-input-error :messages="$errors->get('instagram')" class="mt-2" />
                    </div>

                    <!-- Description -->
                    <div class="mt-4">
                        <textarea id="description"
                            class="block mt-1 w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" type="text"
                            name="description" :value="old('description')" placeholder="Описание" required></textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
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
        </div>
    </section>
@endsection
