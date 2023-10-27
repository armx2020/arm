@extends('layouts.app')
@section('content')

<section>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 grid-rows-10 lg:grid-rows-3 gap-4 w-11/12 lg:w-10/12 md:p-0 mx-auto py-5 lg:py-10">
        <div class="bg-white rounded-xl h-32 md:h-42 lg:h-72 col-span-1 lg:col-span-2 row-span-1 lg:row-span-2">
            <div class="flex flex-row">
                <div class="flex flex-col text-left basis-2/3 lg:basis-1/2 p-3 lg:p-5">
                    <div class="my-1 lg:my-3 text-sm md:text-md lg:text-2xl font-bold">{{ $group->name }}</div>
                    <div class="my-3 text-sm lg:text-md font-normal lg:font-light text-slate-500 hidden lg:block">Информационный справочник для армян России и мира</div>
                    <div class="text-blue-600 text-xs md:text-md lg:text-xl"><a href="{{ route('group.show', ['id' => $group->id]) }}">Подробнее &rarr;</a></div>
                    <div class="flex-row text-sm hidden lg:flex">
                        <a href="{{ route('project.index') }}" class="my-2 lg:my-4 rounded-md bg-green-500 text-white text-center w-4/5 xl:w-1/2 h-9 py-2 items-center">
                            Совместные проекты
                        </a>
                        <a href="{{ route('dashboard') }}" class="my-2 lg:my-4 ml-2 rounded-md bg-blue-500 text-white text-center w-4/5 xl:w-1/2 h-9 py-2 items-center">
                            Добавить свой
                        </a>
                    </div>
                </div>
                <div class="basis-1/3 lg:basis-1/2">
                    <img class="h-28 md:h-38 lg:h-64  float-right object-cover rounded-xl" src="{{ url('/image/banner1.png')}}" alt="banner">
                </div>
            </div>

        </div>
        <div class="bg-white rounded-xl h-32 md:h-42 lg:h-full">
            <a href="{{ route('event.index') }}">
                <div class="flex flex-row h-full">
                    <div class="flex flex-col text-left basis-3/4 p-3 lg:p-4">
                        <div class="m-1 lg:m-2 text-sm lg:text-md font-bold">Афиша событий</div>
                        <div class="mx-1 lg:mx-2 text-xs lg:text-sm font-light text-slate-500">Календарь событий и мероприятий</div>
                    </div>
                    <div class="basis-1/2">
                        <img class="h-28 md:h-38 lg:h-full float-right rounded-xl" src="{{ url('/image/banner2.png') }}" alt="banner">
                    </div>
                </div>
            </a>
        </div>
        <div class="bg-white rounded-xl h-32 md:h-42 lg:h-full">
            <a href="{{ route('group.index') }}">
                <div class="flex flex-row h-full">
                    <div class="flex flex-col text-left basis-3/4 p-3 lg:p-4">
                        <div class="m-1 lg:m-2 text-sm lg:text-md font-bold">Группы, кружки, сообщества</div>
                        <div class="mx-1 lg:mx-2 text-xs lg:text-sm font-light text-slate-500">Сообщества по интересам</div>
                    </div>
                    <div class="basis-1/2">
                        <img class="float-right h-28 md:h-38 m-2 rounded-xl" src="{{ url('/image/banner3.png') }}" alt="banner">
                    </div>

                </div>
            </a>
        </div>
        <div class="bg-orange-100 rounded-xl h-32 md:h-42 lg:h-full">
            <a href="{{ route('vacancy.index') }}">
                <div class="flex flex-row h-full">
                    <div class="flex flex-col text-left basis-3/4 p-3 lg:p-4">
                        <div class="m-1 lg:m-2 text-sm lg:text-md font-bold">Поиск работы</div>
                        <div class="mx-1 lg:mx-2 text-xs lg:text-sm font-light text-slate-500">Найти работу или разместить вакансию</div>
                    </div>
                    <div class="basis-1/2">
                        <img class="float-right m-2 h-28 md:h-38 rounded-xl" src="{{ url('/image/banner5.png') }}" alt="banner">
                    </div>
                </div>
            </a>
        </div>
        <div class="bg-blue-100 rounded-xl h-32 md:h-42 lg:h-full">
        <a href="{{ route('project.index') }}">
            <div class="flex flex-row">
                <div class="flex flex-col text-left basis-3/4 p-3 lg:p-4">
                    <div class="m-1 lg:m-2 text-sm lg:text-md lg:text-lg font-bold ">Наши проекты</div>
                    <div class="mx-1 lg:mx-2 text-xs lg:text-sm font-light text-slate-500">Сделанные проекты<br>Достижения, план работ</div>
                </div>
                <div class="basis-1/2">
                    <img class="float-right h-28 md:h-38 m-2 rounded-xl" src="{{ url('/image/banner7.png')}}" alt="banner">
                </div>
            </div>
        </a>
        </div>
        <div class="bg-blue-100 rounded-xl h-32 md:h-42 lg:h-full">
            <a href="{{ route('offer.index') }}">
                <div class="flex flex-row h-full">
                    <div class="flex flex-col text-left basis-2/3 p-3 lg:p-4">
                        <div class="m-2  text-sm font-bold">Бизнес справочник</div>
                        <div class="mx-2 text-xs lg:text-sm font-light text-slate-500">Каталог товаров и услуг армянской общины</div>
                    </div>
                    <div class="basis-1/3">
                        <img class="float-right h-24 md:h-38 m-1 rounded-xl" src="{{ url('/image/banner6.png') }}" alt="banner">
                    </div>
                </div>
            </a>
        </div>
    </div>
</section>

@endsection