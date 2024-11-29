@extends('layouts.app')
@section('content')
    <section>
        <div class="mx-auto pt-5 lg:pt-10">
            <div class="bg-white rounded-xl row-span-1 lg:row-span-1">
                <div class="flex sm:flex-row">
                    <div class="flex flex-col text-left basis-3/4 lg:basis-1/2 p-5 xl:p-8">
                        <div class="my-1 lg:my-2 text-sm md:text-lg lg:text-2xl font-extrabold uppercase">Армянский справочник
                        </div>
                        <div class="my-1 text-xs md:text-md xl:text-lg font-normal">
                            Информационный справочник для армян - {{ $group->region->name }}</div>
                        <div class="text-gray-600 hidden md:block text-sm lg:text-md xl:text-lg font-light">
                            - Новости, сообщества, товары, проекты в одном месте
                        </div>
                        <div class="text-gray-600 hidden md:block text-sm lg:text-md xl:text-lg font-light">
                            - Помощь по поиску работы и размещение ваших вакансий
                        </div>
                        <a class="my-2 lg:my-4 rounded-md bg-blue-500 text-white text-center w-4/5 xl:w-1/2 h-9 py-2 items-center font-normal"
                            href="{{ route('groups.show', ['id' => $group->id]) }}">
                            Подробнее
                        </a>
                    </div>
                    <div class="flex lg:basis-1/2 md:basis-1/3 basis-1/4 justify-end items-center sm:justify-center sm:items-center rounded-xl"
                        style="background-size: 100% 100%;background-image:linear-gradient(to right,rgba(255, 255, 255, 99%), rgba(255, 255, 255, 70%)), url({{ url('/image/flag.png') }})" id="bg-flag">
                        <img class="flex self-end sm:h-20 md:h-32 lg:h-72 h-20 object-cover rounded-xl object-right-bottom"
                            src="{{ url('/image/frame.png') }}" alt="banner">
                    </div>
                </div>
            </div>
        </div>

        <div>
            <div class="flex flex-wrap mx-auto pt-5 lg:pt-10 md:flex-wrap">
                <!-- Блок 1 -->
                <div class="CEB__wrapTable mb-5 w-1/2 sm:w-1/2 md:w-1/3 lg:w-1/5 xl:w-1/5 pr-2 md:pr-4 lg:pr-2">
                    <div class="bg-[#feecdc] rounded-xl p-2 lg:p-4 h-64 h-56 md:h-[280px] lg:h-72">
                        <a href="{{ route('works.index') }}">
                            <div class="flex flex-col h-full w-full relative">
                                <p class="m-1 lg:m-2 text-sm lg:text-lg font-bold">Поиск работы</p>
                                <p class="mx-1 lg:mx-2 text-xs lg:text-md font-light">Найти работу или разместить вакансию</p>
                                <div class="place-content-center p-3">
                                    <img class="flex self-center m-auto rounded-xl sm:w-[70%] md:w-[100%]" src="{{ url('/image/to_find_job.png') }}" alt="banner">
                                </div>
                                <div class="absolute inset-x-0 bottom-0 text-blue-600 text-xs md:text-md lg:text-lg text-center font-medium">
                                    Подробнее &rarr;
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <!-- Блок 2 -->
                <div class="CEB__wrapTable mb-5 w-1/2 sm:w-1/2 md:w-1/3 lg:w-1/5 xl:w-1/5 pl-2 md:pl-0 md:pr-4 lg:pr-2">
                    <div class="bg-[#dbe6fb] rounded-xl p-2 lg:p-4 h-64 h-56 md:h-[280px] lg:h-72">
                        <a href="{{ route('offers.index') }}">
                            <div class="flex flex-col h-full w-full relative">
                                <p class="m-1 lg:m-2 text-sm lg:text-lg font-bold" style="line-height:1.25rem;">Бизнес справочник</p>
                                <p class="mx-1 lg:mx-2 text-xs lg:text-md font-light">Каталог товаров/услуг армянской общины</p>
                                <div class="place-content-center p-3">
                                    <img class="flex self-center m-auto rounded-xl sm:w-[70%] md:w-[100%]" src="{{ url('/image/www.png') }}" alt="banner">
                                </div>
                                <div class="absolute inset-x-0 bottom-0 text-blue-600 text-xs md:text-md lg:text-lg text-center font-medium">
                                    Подробнее &rarr;
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <!-- Блок 3 -->
                <div class="CEB__wrapTable mb-5 w-1/2 sm:w-1/2 md:w-1/3 lg:w-1/5 xl:w-1/5 pr-2 md:pr-0 lg:pr-2">
                    <div class="bg-[#e6c6c9] rounded-xl p-2 lg:p-4 h-64 h-56 md:h-[280px] lg:h-72 ">
                        <a href="{{ route('projects.index') }}">
                            <div class="flex flex-col h-full w-full relative">
                                <p class="m-1 lg:m-2 text-sm lg:text-lg font-bold">Наши проекты</p>
                                <p class="mx-1 lg:mx-2 text-xs lg:text-md font-light">Сделанные проекты, достижения</p>
                                <div class="flex place-content-center">
                                    <img class="flex self-center m-auto rounded-xl sm:w-[43%] md:w-[70%]" src="{{ url('/image/like.png') }}" alt="like">
                                </div>
                                <div class="absolute inset-x-0 bottom-0 text-blue-600 text-xs md:text-md lg:text-lg text-center font-medium">
                                    Подробнее &rarr;
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <!-- Блок 4 -->
                <div class="CEB__wrapTable mb-5 w-1/2 sm:w-1/2 md:w-1/3 lg:w-1/5 xl:w-1/5 pl-2 md:pl-0 md:pr-4 lg:pr-2">
                    <div class="bg-[#d7e6d8] rounded-xl p-2 lg:p-4 h-64 h-56 md:h-[280px] lg:h-72">
                        <a href="{{ route('groups.index') }}">
                            <div class="flex flex-col h-full w-full relative">
                                <p class="m-1 lg:m-2 text-sm lg:text-lg font-bold" style="line-height:1.25rem;">Кружки, сообщества</p>
                                <p class="mx-1 lg:mx-2 text-xs lg:text-md font-light">Сообщества, группы по интересам</p>
                                <div class="flex place-content-center p-3">
                                    <img class="flex self-center m-auto rounded-xl sm:w-[70%] md:w-[100%]" src="{{ url('/image/friends.png') }}" alt="friends">
                                </div>
                                <div class="absolute inset-x-0 bottom-0 text-blue-600 text-xs md:text-md lg:text-lg text-center font-medium">
                                    Подробнее &rarr;
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <!-- Блок 5 -->
                <div class="CEB__wrapTable mb-5 w-1/2 sm:w-1/2 md:w-1/3 lg:w-1/5 xl:w-1/5 pr-2 md:pr-4 lg:pr-0">
                    <div class="bg-[#f0e7ce] rounded-xl p-2 lg:p-4 h-64 md:h-[280px] lg:h-72">
                        <a href="{{ route('events.index') }}">
                            <div class="flex flex-col h-full w-full relative">
                                <p class="m-1 lg:m-2 text-sm lg:text-lg font-bold" style="line-height:1.25rem;">Афиша событий</p>
                                <p class="mx-1 lg:mx-2 text-xs lg:text-md font-light">Новости, календарь мероприятий</p>
                                <div class="flex place-content-center p-3">
                                    <img class="flex self-center m-auto rounded-xl sm:w-[43%] md:w-[70%]" src="{{ url('/image/alerts.png') }}" alt="alerts">
                                </div>
                                <div class="absolute inset-x-0 bottom-0 text-blue-600 text-xs md:text-md lg:text-lg text-center font-medium">
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
                        <a class="my-2 lg:my-4 rounded-md bg-blue-500 text-white text-center w-4/5 xl:w-1/2 h-9 py-2 items-center font-normal"
                            href="">
                            Перейти к форме
                        </a>
                    </div>
                    <div class="basis-full lg:basis-1/2 p-1 flex place-content-end lg:place-content-center">
                        <img class="flex self-end h-20 md:h-32 lg:h-64 object-cover rounded-xl object-right-bottom"
                            src="{{ url('/image/messages.png') }}" alt="messages">
                    </div>
                </div>
            </div>
        </div>

        @livewire('home-page')

    </section>
    <style>
        @media (max-width: 767px) {
            #bg-flag {
                background-image: none !important;
            }
        }
    </style>
@endsection
