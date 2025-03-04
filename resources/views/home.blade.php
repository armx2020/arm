@extends('layouts.app')

@php
    $sitemap = App\Models\SiteMap::select('url', 'title', 'description')->where('url', url()->current())->First();

    $title = 'Все армяне';
    $description = 'Сообщество армян в России';

    if ($sitemap) {
        $title = $sitemap->title;
        $description = $sitemap->description;
    }

@endphp

@section('title')
    <title>{{ $title }}
    </title>
@endsection

@section('meta')
    <meta name="robots" content="index, follow" />
    <meta name="description" content="{{ $description }}">
@endsection

@section('content')
    <section>
        <div class="mx-auto pt-4 lg:pt-10">
            <div class="bg-white rounded-xl row-span-1 lg:row-span-1">
                <div class="flex sm:flex-row">
                    <div class="flex flex-col text-left basis-full lg:basis-1/2 p-3 xl:p-8">
                        <div class="my-1 lg:my-2 text-sm md:text-lg lg:text-2xl font-extrabold uppercase">
                            <h1>Армянский
                                справочник</h1>
                        </div>
                        <div class="flex flex-row">
                            <div class="flex flex-col">
                                <div class="my-1 text-xs md:text-md xl:text-lg font-normal">
                                    <h2>Информационный справочник для армян мира</h2>
                                </div>

                                <div class="text-gray-600 hidden md:block text-sm lg:text-md xl:text-lg font-light">
                                    <h2>- Новости, сообщества, товары, проекты в одном месте</h2>
                                </div>
                                <div class="text-gray-600 hidden md:block text-sm lg:text-md xl:text-lg font-light">
                                    <h2>- Помощь по поиску работы и размещение ваших вакансий</h2>
                                </div>

                                <button
                                    class="my-1 md:my-2 lg:my-4 text-xs md:text-base rounded-md bg-blue-500 text-white text-center w-4/5 xl:w-1/2 h-6 py-1 md:h-9 md:py-2 items-center font-normal inform-us-button">
                                    Добавить
                                </button>
                            </div>
                            <img class="float-end flex lg:hidden self-end w-24 lg:h-72 h-18 p-1 md:p-0 object-cover rounded-xl object-right-bottom"
                                src="{{ url('/image/banner.png') }}" alt="banner">
                        </div>
                    </div>

                    <div class="hidden lg:flex basis-2/5 md:basis-1/3 lg:basis-1/2 justify-end items-center sm:justify-center sm:items-center rounded-xl"
                        style="background-size: 100% 100%;background-image:linear-gradient(to right,rgba(255, 255, 255, 99%), rgba(255, 255, 255, 70%)), url({{ url('/image/flag.png') }})"
                        id="bg-flag">
                        <img class="hidden lg:flex self-end sm:h-20 md:h-32 lg:h-72 h-18 p-1 md:p-0 object-cover rounded-xl object-right-bottom"
                            src="{{ url('/image/frame.png') }}" alt="banner">
                    </div>
                </div>
            </div>
        </div>

        <div>
            <div class="flex flex-wrap mx-auto pt-4 lg:pt-10 md:flex-wrap">

                <!-- Бизнес справочник -->
                <div class="CEB__wrapTable mb-5 w-1/2 sm:w-1/3 md:w-1/3 lg:w-1/3 xl:w-1/6 pr-2 md:pr-3 xl:pr-2">
                    <div class="bg-[#DBE6FB] rounded-xl p-2 lg:p-4 h-56 es:h-[215px] md:h-[250px] lg:h-72">
                        <a
                            @if (isset($regionName) && $regionName !== 'Россия') href="{{ route('companies.region', ['regionTranslit' => $region]) }}" @else  href="{{ route('companies.index') }}" @endif>
                            <div class="flex flex-col h-full w-full relative">
                                <p class="m-1 lg:m-2 text-sm md:text-lg font-bold" style="line-height:1.25rem;">Справочник услуг</p>
                                <p class="mx-1 lg:mx-2 text-xs md:text-base font-light">Каталог товаров/услуг</p>
                                <div class="absolute bottom-0 w-full">
                                    <img class="mb-2 flex self-center m-auto rounded-xl xl:w-[90%] lg:w-[70%] md:w-[84%] sm:w-[95%] ls:w-[75%] ms:w-[95%] es:w-[100%]"
                                         src="{{ url('/image/building.png') }}" alt="banner">
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <!-- Общины консульства -->
                <div class="CEB__wrapTable mb-5 w-1/2 sm:w-1/3 md:w-1/3 lg:w-1/3 xl:w-1/6 pl-2 sm:pl-1 sm:pr-1 md:pl-1.5 md:pr-1.5 xl:pr-2 xl:pl-0">
                    <div class="bg-[#E7E6E4] rounded-xl p-2 lg:p-4 h-56 es:h-[215px] md:h-[250px] lg:h-72 ">
                        <a
                            @if (isset($regionName) && $regionName !== 'Россия') href="{{ route('communities.region', ['regionTranslit' => $region]) }}" @else  href="{{ route('communities.index') }}" @endif>
                            <div class="flex flex-col h-full w-full relative">
                                <p class="m-1 lg:m-2 text-sm md:text-base font-bold">Армянские общины</p>
                                <p class="mx-1 lg:mx-2 text-xs md:text-base font-light">Каталог товаров/услуг </p>
                                <div class="absolute bottom-0 w-full">
                                    <img class="mb-2 flex self-center m-auto rounded-xl xl:w-[90%] lg:w-[70%] md:w-[75%] sm:w-[84%] ls:w-[75%] ms:w-[90%] es:w-[100%]"
                                         src="{{ url('/image/university.png') }}" alt="like">
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <!-- Поиск работы -->
                <div class="CEB__wrapTable mb-5 w-1/2 sm:w-1/3 md:w-1/3 lg:w-1/3 xl:w-1/6 pr-2 sm:pr-0 sm:pl-2 md:pl-3 xl:pr-2 xl:pl-0">
                    <div class="bg-[#E7EEF1] rounded-xl p-2 lg:p-4 h-56 es:h-[215px] md:h-[250px] lg:h-72">
                        <a
                            @if (isset($regionName) && $regionName !== 'Россия') href="{{ route('jobs.region', ['regionTranslit' => $region]) }}" @else  href="{{ route('jobs.index') }}" @endif>
                            <div class="flex flex-col h-full w-full relative">
                                <p class="m-1 lg:m-2 text-sm md:text-lg font-bold">Поиск работы</p>
                                <p class="mx-1 lg:mx-2 text-xs md:text-base font-light">Найти работу или разместить вакансию</p>
                                <div class="absolute bottom-0 w-full">
                                    <img class="mb-2 flex self-center m-auto rounded-xl xl:w-[90%] lg:w-[70%] md:w-[84%] sm:w-[100%] ls:w-[93%] ms:w-[95%] es:w-[100%]"
                                         src="{{ url('/image/to_find_job.png') }}" alt="banner">
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <!-- Проекты помощи -->
                <div class="CEB__wrapTable mb-5 w-1/2 sm:w-1/3 md:w-1/3 lg:w-1/3 xl:w-1/6 pl-2 sm:pl-0 sm:pr-2 md:pl-0 md:pr-3 xl:pr-2 xl:pl-0">
                    <div class="bg-[#D6EBEE] rounded-xl p-2 lg:p-4 h-56 es:h-[215px] md:h-[250px] lg:h-72">
                        <a
                            @if (isset($regionName) && $regionName !== 'Россия') href="{{ route('groups.region', ['regionTranslit' => $region]) }}" @else  href="{{ route('groups.index') }}" @endif>
                            <div class="flex flex-col h-full w-full relative">
                                <p class="m-1 lg:m-2 text-sm md:text-lg font-bold">Проекты помощи</p>
                                <p class="mx-1 lg:mx-2 text-xs md:text-base font-light">Помощь нуждающимся</p>
                                <div class="absolute bottom-0 w-full">
                                    <img class="mb-2 flex self-center m-auto rounded-xl xl:w-[90%] lg:w-[70%] md:w-[80%] sm:w-[87%] ls:w-[75%] ms:w-[95%] es:w-[100%]"
                                         src="{{ url('/image/help.png') }}" alt="banner">
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <!-- Интересные места -->
                <div class="CEB__wrapTable mb-5 w-1/2 sm:w-1/3 md:w-1/3 lg:w-1/3 xl:w-1/6 pr-2 sm:pr-1 sm:pl-1 md:pl-1.5 md:pr-1.5 xl:pr-2 xl:pl-0">
                    <div class="bg-[#F0E7CE] rounded-xl p-2 lg:p-4 h-56 es:h-[215px] md:h-[250px] lg:h-72">
                        <a
                            @if (isset($regionName) && $regionName !== 'Россия') href="{{ route('places.region', ['regionTranslit' => $region]) }}" @else  href="{{ route('places.index') }}" @endif>
                            <div class="flex flex-col h-full w-full relative">
                                <p class="m-1 lg:m-2 text-sm md:text-lg font-bold" style="line-height:1.25rem;">Интересные места, Церкви</p>
                                <p class="mx-1 lg:mx-2 text-xs md:text-base font-light">Интересные места</p>
                                <div class="absolute bottom-0 w-full">
                                    <img class="mb-2 flex self-center m-auto rounded-xl xl:w-[90%] lg:w-[70%] md:w-[72%] sm:w-[77%] ls:w-[75%] ms:w-[87%] es:w-[100%]"
                                        src="{{ url('/image/church.png') }}" alt="banner">
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <!-- Кружки сообщества -->
                <div class="CEB__wrapTable mb-5 w-1/2 sm:w-1/3 md:w-1/3 lg:w-1/3 xl:w-1/6 pl-2 md:pl-0 md:pl-3 xl:pl-0">
                    <div class="bg-[#D7E6D8] rounded-xl p-2 lg:p-4 h-56 es:h-[215px] md:h-[250px] lg:h-72">
                        <a
                            @if (isset($regionName) && $regionName !== 'Россия') href="{{ route('groups.region', ['regionTranslit' => $region]) }}" @else  href="{{ route('groups.index') }}" @endif>
                            <div class="flex flex-col h-full w-full relative">
                                <p class="m-1 lg:m-2 text-sm md:text-lg font-bold" style="line-height:1.25rem;">Кружки, сообщества</p>
                                <p class="mx-1 lg:mx-2 text-xs md:text-base font-light">Сообщества, группы по интересам</p>
                                <div class="absolute bottom-0 w-full">
                                    <img class="mb-2 flex self-center m-auto rounded-xl xl:w-[90%] lg:w-[70%] md:w-[95%] sm:w-[100%] ls:w-[95%] ms:w-[100%] es:w-[100%]"
                                        src="{{ url('/image/group-of-young-people-waving-hand.png') }}" alt="friends">
                                </div>
                            </div>
                        </a>
                    </div>
                </div>


            </div>
        </div>

        <x-inform-us.index />

    </section>
    <style>
        @media (max-width: 767px) {
            #bg-flag {
                background-image: none !important;
            }
        }
    </style>
@endsection
