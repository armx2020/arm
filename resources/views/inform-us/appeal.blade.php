@extends('layouts.app')
@section('title', '- ОСТАВЬТЕ НАМ СВОЮ ЗАЯВКУ')
@section('content')
    <x-pages.breadcrumbs :$secondPositionUrl :$secondPositionName />
    <section>
        <div class="flex flex-col sm:justify-center items-center py-6">

            @if (session('success'))
                <div class="mt-5 w-full sm:max-w-xl rounded-lg bg-green-100 px-6 py-5 text-base text-green-700"
                    role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <div class="w-full sm:max-w-xl my-6 px-6 py-6 bg-white overflow-hidden sm:rounded-lg">

                <h3 class="text-xl font-semibold">Ваше обращение</h3>
                <p class="text-sm">Опишите вашу проблему</p>
                <hr class="mt-4">

                <!-- Session Status -->

                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('inform-us.appeal') }}" enctype="multipart/form-data">
                    @csrf

                    @if (session('error'))
                        <x-input-error :messages="session('error')" class="mt-2 mb-3" />
                    @endif

                    <!-- name -->
                    <div class="mt-4">
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                            :value="old('name')" placeholder="Ваше имя" required />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- phone -->
                    <div class="mt-4">
                        <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone"
                            :value="old('phone')" placeholder="Ваш телефон" required />
                        <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                    </div>


                    <!-- message -->
                    <div class="mt-4">
                        <textarea id="message"
                            class="block mt-1 w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" type="text"
                            name="message" :value="old('message')" placeholder="Сообщение"></textarea>
                        <x-input-error :messages="$errors->get('message')" class="mt-2" />
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