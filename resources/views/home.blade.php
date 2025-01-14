@extends('layouts.app')
@section('content')
    <section>
        <div class="mx-auto pt-5 lg:pt-10">
            <div class="bg-white rounded-xl row-span-1 lg:row-span-1">
                <div class="flex sm:flex-row">
                    <div class="flex flex-col text-left basis-4/5 lg:basis-1/2 p-5 xl:p-8">
                        <div class="my-1 lg:my-2 text-sm md:text-lg lg:text-2xl font-extrabold uppercase">Армянский
                            справочник
                        </div>
                        <div class="my-1 text-xs md:text-md xl:text-lg font-normal">
                            Информационный справочник для армян - {{ $group->region->name }}</div>
                        <div class="text-gray-600 hidden md:block text-sm lg:text-md xl:text-lg font-light">
                            - Новости, сообщества, товары, проекты в одном месте
                        </div>
                        <div class="text-gray-600 hidden md:block text-sm lg:text-md xl:text-lg font-light">
                            - Помощь по поиску работы и размещение ваших вакансий
                        </div>
                        <button
                            class="my-1 md:my-2 lg:my-4 text-xs md:text-base rounded-md bg-blue-500 text-white text-center w-4/5 xl:w-1/2 h-6 py-1 md:h-9 md:py-2 items-center font-normal inform-us-button">
                            Добавить
                        </button>
                    </div>
                    <div class="flex lg:basis-1/2 md:basis-1/3 basis-1/5 justify-end items-center sm:justify-center sm:items-center rounded-xl"
                        style="background-size: 100% 100%;background-image:linear-gradient(to right,rgba(255, 255, 255, 99%), rgba(255, 255, 255, 70%)), url({{ url('/image/flag.png') }})"
                        id="bg-flag">
                        <img class="flex self-end sm:h-20 md:h-32 lg:h-72 h-18 p-1 md:p-0 object-cover rounded-xl object-right-bottom"
                            src="{{ url('/image/frame.png') }}" alt="banner">
                    </div>
                </div>
            </div>
        </div>

        <div>
            <div class="flex flex-wrap mx-auto pt-5 lg:pt-10 md:flex-wrap">
                <!-- Блок 1 -->
                <div class="CEB__wrapTable mb-5 w-1/2 sm:w-1/2 md:w-1/4 lg:w-1/5 xl:w-1/5 pr-2 md:pr-4 lg:pr-2">
                    <div class="bg-[#feecdc] rounded-xl p-2 lg:p-4 h-64 h-56 md:h-[280px] lg:h-72">
                        <a href="">
                            <div class="flex flex-col h-full w-full relative">
                                <p class="m-1 lg:m-2 text-sm lg:text-lg font-bold">Поиск работы</p>
                                <p class="mx-1 lg:mx-2 text-xs lg:text-md font-light">Найти работу или разместить вакансию
                                </p>
                                <div class="place-content-center p-3">
                                    <img class="flex self-center m-auto rounded-xl sm:w-[70%] md:w-[100%]"
                                        src="{{ url('/image/to_find_job.png') }}" alt="banner">
                                </div>
                                <div
                                    class="absolute inset-x-0 bottom-0 text-blue-600 text-xs md:text-md lg:text-lg text-center font-medium">
                                    Подробнее &rarr;
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <!-- Блок 2 -->
                <div class="CEB__wrapTable mb-5 w-1/2 sm:w-1/2 md:w-1/4 lg:w-1/5 xl:w-1/5 pl-2 md:pl-0 md:pr-4 lg:pr-2">
                    <div class="bg-[#dbe6fb] rounded-xl p-2 lg:p-4 h-64 h-56 md:h-[280px] lg:h-72">
                        <a href="{{ route('companies.index') }}">
                            <div class="flex flex-col h-full w-full relative">
                                <p class="m-1 lg:m-2 text-sm lg:text-lg font-bold" style="line-height:1.25rem;">Бизнес
                                    справочник</p>
                                <p class="mx-1 lg:mx-2 text-xs lg:text-md font-light">Каталог товаров/услуг армянской общины
                                </p>
                                <div class="place-content-center p-3">
                                    <img class="flex self-center m-auto rounded-xl sm:w-[70%] md:w-[100%]"
                                        src="{{ url('/image/www.png') }}" alt="banner">
                                </div>
                                <div
                                    class="absolute inset-x-0 bottom-0 text-blue-600 text-xs md:text-md lg:text-lg text-center font-medium">
                                    Подробнее &rarr;
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <!-- Блок 3 -->
                <div class="CEB__wrapTable mb-5 hidden lg:block lg:w-1/5 xl:w-1/5 pr-2 md:pr-0 lg:pr-2">
                    <div class="bg-[#e6c6c9] rounded-xl p-2 lg:p-4 h-64 h-56 md:h-[280px] lg:h-72 ">
                        <a href="">
                            <div class="flex flex-col h-full w-full relative">
                                <p class="m-1 lg:m-2 text-sm lg:text-lg font-bold">Наши проекты</p>
                                <p class="mx-1 lg:mx-2 text-xs lg:text-md font-light">Сделанные проекты, достижения</p>
                                <div class="flex place-content-center">
                                    <img class="flex self-center m-auto rounded-xl sm:w-[43%] md:w-[70%]"
                                        src="{{ url('/image/like.png') }}" alt="like">
                                </div>
                                <div
                                    class="absolute inset-x-0 bottom-0 text-blue-600 text-xs md:text-md lg:text-lg text-center font-medium">
                                    Подробнее &rarr;
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <!-- Кружки сообщества -->
                <div class="CEB__wrapTable mb-5 w-1/2 sm:w-1/2 md:w-1/4 lg:w-1/5 xl:w-1/5 pr-2 md:pl-0 md:pr-4 lg:pr-2">
                    <div class="bg-[#d7e6d8] rounded-xl p-2 lg:p-4 h-64 h-56 md:h-[280px] lg:h-72">
                        <a href="{{ route('groups.index') }}">
                            <div class="flex flex-col h-full w-full relative">
                                <p class="m-1 lg:m-2 text-sm lg:text-lg font-bold" style="line-height:1.25rem;">Кружки,
                                    сообщества</p>
                                <p class="mx-1 lg:mx-2 text-xs lg:text-md font-light">Сообщества, группы по интересам</p>
                                <div class="flex place-content-center p-3">
                                    <img class="flex self-center m-auto rounded-xl sm:w-[70%] md:w-[100%]"
                                        src="{{ url('/image/friends.png') }}" alt="friends">
                                </div>
                                <div
                                    class="absolute inset-x-0 bottom-0 text-blue-600 text-xs md:text-md lg:text-lg text-center font-medium">
                                    Подробнее &rarr;
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <!-- Интересные места -->
                <div class="CEB__wrapTable mb-5 w-1/2 sm:w-1/2 md:w-1/4 lg:w-1/5 xl:w-1/5 pl-2 md:pl-0 md:pr-4 lg:pr-0">
                    <div class="bg-[#f0e7ce] rounded-xl p-2 lg:p-4 h-64 md:h-[280px] lg:h-72">
                        <a href="{{ route('places.index') }}">
                            <div class="flex flex-col h-full w-full relative">
                                <p class="m-1 lg:m-2 text-sm lg:text-lg font-bold" style="line-height:1.25rem;">Интересные
                                    места, церкви</p>
                                <p class="mx-1 lg:mx-2 text-xs lg:text-md font-light">Интересные места</p>
                                <div class="flex place-content-center p-3">
                                    <img class="flex self-center m-auto rounded-xl sm:w-[36%] md:w-[70%]"
                                        src="{{ url('/image/church.png') }}" alt="church">
                                </div>
                                <div
                                    class="absolute inset-x-0 bottom-0 text-blue-600 text-xs md:text-md lg:text-lg text-center font-medium">
                                    Подробнее &rarr;
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="mx-auto py-5 lg:pt-10">
            <div class="bg-[#dbe6fb] rounded-xl row-span-1">
                <div class="flex flex-col lg:flex-row">
                    <div class="flex flex-col text-left basis-2/3 lg:basis-1/2 p-3 lg:p-5 xl:p-8">
                        <div class="my-1 lg:my-2 text-md md:text-lg lg:text-2xl font-extrabold uppercase">сообщить нам
                        </div>
                        <div class="my-1 text-sm md:text-md lg:text-lg xl:text-xl font-normal">
                            Сообшить о проблеме, добавить информацию, оставить отзыв</div>
                        <button
                            class="my-2 lg:my-4 rounded-md bg-blue-500 text-white text-center w-4/5 xl:w-1/2 h-9 py-2 items-center font-normal inform-us-button">
                            Перейти к форме
                        </button>
                    </div>
                    <div class="hidden lg:flex basis-1/2 p-1 flex place-content-end lg:place-content-center">
                        <img class="flex self-end h-20 md:h-32 lg:h-64 object-cover rounded-xl object-right-bottom"
                            src="{{ url('/image/messages.png') }}" alt="messages">
                    </div>
                </div>
            </div>
        </div>

        <div id="inform-us" class="hidden fixed inset-0 px-4 min-h-full overlow-hidden sm:px-0 z-50" focusable>

            <div class="my-5 mx-auto opacity-100 translate-y-0 sm:scale-100 bg-white rounded-lg overflow-auto shadow-xl transform transition-all sm:w-11/12 lg:w-1/2 h-5/6"
                style="max-width:50rem">

                <div class="m-7">
                    <x-secondary-button class="inform-us-close absolute right-4 top-4">
                        {{ __('Закрыть') }}
                    </x-secondary-button>
                    <div class="flex flex-col">

                        <div id="select-inform">
                            <h4 class="text-xl font-semibold mt-6">Выберите, один из вариантов</h4>
                            <hr class="mb-4 mt-2">
                            <button type="button" id="select-form-button"
                                class="uppercas w-full rounded border-2 border-primary-100 px-6 pb-[6px] pt-2 text-xs font-medium leading-normal text-primary-700 transition hover:border-primary-accent-200 hover:bg-secondary-50/50">
                                Добавьте информацию для справочника без регистрации
                            </button>

                            <a href="{{ route('register') }}"
                                class="block text-center rounded border-2 border-primary-100 px-6 pb-[6px] pt-2 text-xs font-medium leading-normal text-primary-700 transition hover:border-primary-accent-200 hover:bg-secondary-50/50 my-2">
                                Добавьте свою компанию, сообщество или событие
                            </a>

                            <a href="{{ route('inform-us.appeal') }}"
                                class="block text-center rounded border-2 border-primary-100 px-6 pb-[6px] pt-2 text-xs font-medium leading-normal text-primary-700 transition hover:border-primary-accent-200 hover:bg-secondary-50/50 my-2">
                                Написать нам, сообщить об ошибки, запросить помощь
                            </a>
                        </div>

                        <div id="select-form" class="hidden">
                            <h4 class="text-xl font-semibold mt-6">Выберите, что добавить</h4>
                            <hr class="mb-4 mt-2">

                            <a href="{{ route('inform-us.company') }}"
                                class="uppercase block text-center rounded border-2 border-primary-100 px-6 pb-[6px] pt-2 text-xs font-medium leading-normal text-primary-700 transition hover:border-primary-accent-200 hover:bg-secondary-50/50 my-1">
                                Компанию
                            </a>

                            <a href="{{ route('inform-us.place') }}"
                                class="uppercase block text-center rounded border-2 border-primary-100 px-6 pb-[6px] pt-2 text-xs font-medium leading-normal text-primary-700 transition hover:border-primary-accent-200 hover:bg-secondary-50/50 my-1">
                                Интересное место
                            </a>

                            <a href="{{ route('inform-us.group') }}"
                                class="uppercase block text-center rounded border-2 border-primary-100 px-6 pb-[6px] pt-2 text-xs font-medium leading-normal text-primary-700 transition hover:border-primary-accent-200 hover:bg-secondary-50/50 my-1">
                               Кружок, сообщество
                            </a>

                            <a href="{{ route('inform-us.community') }}"
                                class="uppercase block text-center rounded border-2 border-primary-100 px-6 pb-[6px] pt-2 text-xs font-medium leading-normal text-primary-700 transition hover:border-primary-accent-200 hover:bg-secondary-50/50 my-1">
                               Община
                            </a>

                        </div>

                    </div>
                </div>
            </div>
        </div>

    </section>
    <style>
        @media (max-width: 767px) {
            #bg-flag {
                background-image: none !important;
            }
        }
    </style>

    <script type='text/javascript'>
        $(document).ready(function() {
            $(".inform-us-button").click(function() {
                $("#inform-us").toggle();
                $("#select-inform").show();
                $("#select-form").hide();
                $('body, html').css('overflow', 'hidden')
            });
            $(".inform-us-close").click(function() {
                $("#inform-us").toggle();
                $("#select-inform").show();
                $("#select-form").hide();
                $('body, html').css('overflow', 'visible');
            });
            $("#select-form-button").click(function() {
                $("#select-form").show();
                $("#select-inform").hide();
            });
        });
    </script>
@endsection
