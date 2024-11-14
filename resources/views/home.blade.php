@extends('layouts.app')
@section('content')
    <section>
        <div class="mx-auto pt-5 lg:pt-10">
            <div class="bg-white rounded-xl row-span-1 lg:row-span-1">
                <div class="flex flex-col md:flex-row">
                    <div class="flex flex-col text-left basis-2/3 lg:basis-1/2 p-5 xl:p-8">
                        <div class="my-1 lg:my-2 text-md md:text-lg lg:text-2xl font-extrabold uppercase">{{ $group->name }}
                        </div>
                        <div class="my-1 text-sm md:text-md xl:text-lg font-normal">
                            Информационный справочник для армян России и мира</div>
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
                    <div class="flex basis-full lg:basis-1/2 place-content-center rounded-xl"
                        style="background-size: 100% 100%;background-image:linear-gradient(to right,rgba(255, 255, 255, 99%), rgba(255, 255, 255, 70%)), url({{ url('/image/flag.png') }})">
                        <img class="flex self-end h-32 md:h-40 lg:h-72 object-cover rounded-xl object-right-bottom"
                            src="{{ url('/image/frame.png') }}" alt="banner">
                    </div>
                </div>
            </div>
        </div>

        <div x-data>
            <div x-ref="banners"
                class="flex flex-nowrap lg:flex-none lg:grid lg:grid-cols-5 gap-2 lg:gap-5 overflow-x-scroll scrollhidden mx-auto pt-5 lg:pt-10">
                <div class="bg-orange-100 rounded-xl block lg:col-span-1 p-2 lg:p-4 h-56 md:h-64 lg:h-72">
                    <a href="{{ route('vacancy.index') }}">
                        <div class="flex flex-col h-full w-32 md:w-48 relative">
                            <p class="m-1 lg:m-2 text-sm lg:text-lg font-bold">Поиск работы</p>
                            <p class="mx-1 lg:mx-2 text-xs lg:text-md font-light">Найти работу или
                                разместить вакансию</p>
                            <div class="place-content-center">
                                <img class="flex self-center my-4 rounded-xl" src="{{ url('/image/to_find_job.png') }}"
                                    alt="banner">
                            </div>
                            <div
                                class="absolute inset-x-0 bottom-0 text-blue-600 text-xs md:text-md lg:text-lg text-center font-medium">
                                Подробнее &rarr;
                            </div>
                        </div>
                    </a>
                </div>
                <div class="bg-blue-100 rounded-xl block lg:col-span-1 p-2 lg:p-4 h-56 md:h-64 lg:h-72">
                    <a href="{{ route('vacancy.index') }}">
                        <div class="flex flex-col h-full w-32 md:w-48 relative">
                            <p class="m-1 lg:m-2 text-sm lg:text-lg font-bold" style="line-height:1.25rem;">Бизнес
                                справочник</p>
                            <p class="mx-1 lg:mx-2 text-xs lg:text-md font-light">Каталог товаров/услуг армянской общины</p>
                            <div class="place-content-center">
                                <img class="flex self-center rounded-xl" src="{{ url('/image/www.png') }}" alt="banner">
                            </div>
                            <div
                                class="absolute inset-x-0 bottom-0 text-blue-600 text-xs md:text-md lg:text-lg text-center font-medium">
                                Подробнее &rarr;
                            </div>
                        </div>
                    </a>
                </div>
                <div class="bg-red-200 rounded-xl block lg:col-span-1 p-2 lg:p-4 h-56 md:h-64 lg:h-72">
                    <a href="{{ route('projects.index') }}">
                        <div class="flex flex-col h-full w-32 md:w-48 relative">
                            <p class="m-1 lg:m-2 text-sm lg:text-lg font-bold">Наши проекты</p>
                            <p class="mx-1 lg:mx-2 text-xs lg:text-md font-light">Сделанные проекты, достижения</p>
                            <div class="flex place-content-center">
                                <img class="flex self-center rounded-xl h-20 md:h-28 lg:40 my-2" src="{{ url('/image/like.png') }}" alt="like">
                            </div>
                            <div
                                class="absolute inset-x-0 bottom-0 text-blue-600 text-xs md:text-md lg:text-lg text-center font-medium">
                                Подробнее &rarr;
                            </div>
                        </div>
                    </a>
                </div>
                <div class="bg-emerald-100 rounded-xl block lg:col-span-1 p-2 lg:p-4 h-56 md:h-64 lg:h-72">
                    <a href="{{ route('groups.index') }}">
                        <div class="flex flex-col h-full w-32 md:w-48 relative">
                            <p class="m-1 lg:m-2 text-sm lg:text-lg font-bold" style="line-height:1.25rem;">Кружки,
                                сообщества</p>
                            <p class="mx-1 lg:mx-2 text-xs lg:text-md font-light">Сообщества, группы по интересам</p>
                            <div class="flex place-content-center">
                                <img class="flex self-center rounded-xl" src="{{ url('/image/friends.png') }}"
                                    alt="friends">
                            </div>
                            <div
                                class="absolute inset-x-0 bottom-0 text-blue-600 text-xs md:text-md lg:text-lg text-center font-medium">
                                Подробнее &rarr;
                            </div>
                        </div>
                    </a>
                </div>
                <div class="bg-orange-200 rounded-xl block lg:col-span-1 p-2 lg:p-4 h-56 md:h-64 lg:h-72">
                    <a href="{{ route('events.index') }}">
                        <div class="flex flex-col h-full w-32 md:w-48 relative">
                            <p class="m-1 lg:m-2 text-sm lg:text-lg font-bold" style="line-height:1.25rem;">Афиша событий
                            </p>
                            <p class="mx-1 lg:mx-2 text-xs lg:text-md font-light">Новости, календарь мероприятий</p>
                            <div class="flex place-content-center">
                                <img class="flex self-center rounded-xl h-20 md:h-28 lg:40" src="{{ url('/image/alerts.png') }}"
                                    alt="alerts">
                            </div>
                            <div
                                class="absolute inset-x-0 bottom-0 text-blue-600 text-xs md:text-md lg:text-lg text-center font-medium">
                                Подробнее &rarr;
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="block lg:hidden text-right text-blue-600 mx-auto mt-2">
                <button x-on:click="$refs.banners.scrollLeft -= 140" class="font-extrabold text-2xl">
                    <svg xmlns="http://www.w3.org/2000/svg"width="25" height="23" viewBox="0 0 25 23"
                        fill="none">
                        <path d="M11.5833 2L2 11.5833L11.5833 21.1667M23.0833" stroke="#1C64F2" stroke-width="3"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
                <button x-on:click="$refs.banners.scrollLeft += 140" class="font-extrabold text-2xl">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="23" viewBox="20 0 30 23" fill="none">
                        <path d="M11.5833 21.1667M23.0833 2L32.6667 11.5833L23.0833 21.1667" stroke="#1C64F2" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                </button>
            </div>
        </div>

        <div class="mx-auto py-5 lg:pt-10">
            <div class="bg-orange-300 rounded-xl row-span-1">
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
@endsection
