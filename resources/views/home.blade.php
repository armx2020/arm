@extends('layouts.app')

@section('title')
    <title>Все армяне
        @if (isset($regionName) && $regionName !== 'Россия')
            {{ ' - ' . $regionName }}
        @endif
    </title>
@endsection

@section('meta')
    <meta name="robots" content="index, follow" />
    <meta name="description" content="Сообщество армян в России: актуальные новости, культурные события и полезная информация для вас!">
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

                <!-- Интересные места -->
                <div class="CEB__wrapTable mb-5 w-1/2 sm:w-1/2 md:w-1/4 lg:w-1/5 xl:w-1/5 pr-2 md:pr-4 lg:pr-2">
                    <div class="bg-[#f0e7ce] rounded-xl p-2 lg:p-4 h-56 es:h-[215px] md:h-[250px] lg:h-72">
                        <a @if (isset($regionName) && $regionName !== 'Россия') href="{{ route('region.places', ['regionTranslit' => $region]) }}" @else  href="{{ route('places.index') }}" @endif>
                            <div class="flex flex-col h-full w-full relative">
                                <p class="m-1 lg:m-2 text-sm lg:text-lg font-bold" style="line-height:1.25rem;">Интересные
                                    места, церкви</p>
                                <p class="mx-1 lg:mx-2 text-xs lg:text-base font-light">Интересные места</p>
                                <div class="absolute bottom-0 w-full">
                                    <img class="mb-2 flex self-center m-auto rounded-xl xl:w-[90%] lg:w-[100%] md:w-[95%] sm:w-[62%] ls:w-[75%] ms:w-[87%] es:w-[100%]"
                                        src="{{ url('/image/church.png') }}" alt="banner">
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <!-- Кружки сообщества -->
                <div class="CEB__wrapTable mb-5 w-1/2 sm:w-1/2 md:w-1/4 lg:w-1/5 xl:w-1/5 pl-2 md:pl-0 md:pr-4 lg:pr-2">
                    <div class="bg-[#d7e6d8] rounded-xl p-2 lg:p-4 h-56 es:h-[215px] md:h-[250px] lg:h-72">
                        <a @if (isset($regionName) && $regionName !== 'Россия') href="{{ route('region.groups', ['regionTranslit' => $region]) }}" @else  href="{{ route('groups.index') }}" @endif>
                            <div class="flex flex-col h-full w-full relative">
                                <p class="m-1 lg:m-2 text-sm lg:text-lg font-bold" style="line-height:1.25rem;">Кружки,
                                    сообщества</p>
                                <p class="mx-1 lg:mx-2 text-xs lg:text-base font-light">Сообщества, группы по интересам</p>
                                <div class="absolute bottom-0 w-full">
                                    <img class="mb-2 flex self-center m-auto rounded-xl xl:w-[90%] lg:w-[100%] md:w-[95%] sm:w-[62%] ls:w-[75%] ms:w-[87%] es:w-[100%]"
                                        src="{{ url('/image/group-of-young-people-waving-hand.png') }}" alt="friends">
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <!-- Бизнес справочник -->
                <div class="CEB__wrapTable mb-5 w-1/2 sm:w-1/2 md:w-1/4 lg:w-1/5 xl:w-1/5 pr-2 md:pr-4 lg:pr-2">
                    <div class="bg-[#dbe6fb] rounded-xl p-2 lg:p-4 h-56 es:h-[215px] md:h-[250px] lg:h-72">
                        <a @if (isset($regionName) && $regionName !== 'Россия') href="{{ route('region.companies', ['regionTranslit' => $region]) }}" @else  href="{{ route('companies.index') }}" @endif>
                            <div class="flex flex-col h-full w-full relative">
                                <p class="m-1 lg:m-2 text-sm lg:text-lg font-bold" style="line-height:1.25rem;">Бизнес
                                    справочник</p>
                                <p class="mx-1 lg:mx-2 text-xs lg:text-base font-light">Каталог товаров/услуг</p>
                                <div class="absolute bottom-0 w-full">
                                    <img class="mb-2 flex self-center m-auto rounded-xl xl:w-[90%] lg:w-[100%] md:w-[95%] sm:w-[62%] ls:w-[75%] ms:w-[87%] es:w-[100%]"
                                        src="{{ url('/image/building.png') }}" alt="banner">
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <!-- Общины консульства -->
                <div class="CEB__wrapTable mb-5 w-1/2 sm:w-1/2 md:w-1/4 lg:w-1/5 xl:w-1/5 pl-2 md:pl-0 md:pr-4 lg:pr-2">
                    <div class="bg-[#e6c6c9] rounded-xl p-2 lg:p-4 h-56 es:h-[215px] md:h-[250px] lg:h-72 ">
                        <a @if (isset($regionName) && $regionName !== 'Россия') href="{{ route('region.communities', ['regionTranslit' => $region]) }}" @else  href="{{ route('communities.index') }}" @endif>
                            <div class="flex flex-col h-full w-full relative">
                                <p class="m-1 lg:m-2 text-sm lg:text-base font-bold">Общины консульства</p>
                                <p class="mx-1 lg:mx-2 text-xs lg:text-base font-light">Каталог товаров/услуг </p>
                                <div class="absolute bottom-0 w-full">
                                    <img class="mb-2 flex self-center m-auto rounded-xl xl:w-[90%] lg:w-[100%] md:w-[95%] sm:w-[62%] ls:w-[75%] ms:w-[87%] es:w-[100%]"
                                        src="{{ url('/image/university.png') }}" alt="like">
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <!-- Поиск работы -->
                <div
                    class="CEB__wrapTable mb-5 w-1/2 sm:w-1/2 md:w-1/4 lg:w-1/5 xl:w-1/5 pl-2 md:pl-0 md:pr-4 lg:pr-0 hidden lg:block">
                    <div class="bg-[#feecdc] rounded-xl p-2 lg:p-4 h-56 es:h-[215px] md:h-[250px] lg:h-72">
                        <a @if (isset($regionName) && $regionName !== 'Россия') href="{{ route('region.companies', ['regionTranslit' => $region]) }}" @else  href="{{ route('companies.index') }}" @endif>
                            <div class="flex flex-col h-full w-full relative">
                                <p class="m-1 lg:m-2 text-sm lg:text-lg font-bold">Поиск работы</p>
                                <p class="mx-1 lg:mx-2 text-xs lg:text-base font-light">Найти работу или разместить вакансию
                                </p>
                                <div class="absolute bottom-0 w-full">
                                    <img class="mb-2 flex self-center m-auto rounded-xl xl:w-[90%] lg:w-[100%] md:w-[95%] sm:w-[62%] ls:w-[75%] ms:w-[87%] es:w-[100%]"
                                        src="{{ url('/image/to_find_job.png') }}" alt="banner">
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
