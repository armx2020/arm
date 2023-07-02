@extends('layouts.app')

@section('content')

<section>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 grid-rows-10 lg:grid-rows-4 gap-4 w-11/12 mx-auto py-5 lg:py-10 max-h-full">
        <div class="bg-white rounded-xl p-2 lg:p-8 col-span-1 lg:col-span-2 row-span-1 lg:row-span-2">
            <div class="flex flex-row">
                <div class="flex flex-col text-left basis-1/2 p-1 lg:p-4">
                    @if ($city && $city !== 'не выбрано')
                    <div class="my-3 text-sm lg:text-2xl font-bold">Армянская обшина города - {{ preg_replace("/\([^)]+\)/","", $city) }}</div>
                    @else
                    <div class="my-3 text-md lg:text-2xl font-bold">Армянская обшина России</div>
                    @endif
                    <div class="my-5 text-sm lg:text-md font-normal lg:font-light text-slate-500 hidden lg:block">Информационный справочник для армян России и мира</div>
                    <div class="text-blue-600 text:md lg:text-xl"><a href="">Подробнее &rarr;</a></div>
                </div>
                <div class="basis-1/2 w-15 h-15">
                    <img src="{{ url('/image/banner1.png')}}" alt="banner">
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl p-2 h-36 md:h-auto">
            <a href="">
                <div class="flex flex-row h-full">
                    <div class="flex flex-col text-left basis-3/4 p-1 lg:p-4">
                        <div class="m-1 lg:m-2 font-bold">Афиша событий</div>
                        <div class="m-1 lg:m-2 text-sm font-light text-slate-500">Календарь событий и мероприятий</div>
                    </div>
                    <div class="basis-1/2 relative">
                        <img src="{{ url('/image/banner2.png') }}" class="absolute bottom-0" alt="banner">
                    </div>
                </div>
            </a>
        </div>
        <div class="bg-white rounded-xl p-2 h-36 lg:h-auto">
            <a href="{{ route('group.index') }}">
                <div class="flex flex-row h-full">
                    <div class="flex flex-col text-left basis-3/4 p-1 lg:p-4">
                        <div class="m-1 lg:m-2 font-bold">Группы, кружки, сообщества</div>
                        <div class="m-1 lg:m-2 text-sm font-light text-slate-500">Новости, календарь событий</div>
                    </div>
                    <div class="basis-1/2 relative">
                        <img src="{{ url('/image/banner3.png') }}" class="bottom-3 absolute" alt="banner">
                    </div>

                </div>
            </a>
        </div>
        <div class="bg-white rounded-xl p-2 h-36 lg:h-auto">
            <a href="">
                <div class="flex flex-row h-full">
                    <div class="flex flex-col text-left basis-3/4 p-1 lg:p-4">
                        <div class="m-1 lg:m-2 font-bold">Новости</div>
                        <div class="m-1 lg:m-2 text-sm font-light text-slate-500">Актуальные новости из жизни</div>
                    </div>
                    <div class="basis-1/2 relative">
                        <img src="{{ url('/image/banner4.png') }}" class="hidden lg:absolute bottom-0" alt="banner">
                    </div>
                </div>
            </a>
        </div>
        <div class="bg-orange-100 rounded-xl p-2 h-36 lg:h-auto">
            <a href="{{ route('vacancy.index') }}">
                <div class="flex flex-row h-full">
                    <div class="flex flex-col text-left basis-3/4 p-1 lg:p-4">
                        <div class="m-1 lg:m-2 font-bold">Поиск работы</div>
                        <div class="m-1 lg:m-2 text-sm font-light text-slate-500">Найти работу или разместить вакансию</div>
                    </div>
                    <div class="basis-1/2 relative">
                        <img src="{{ url('/image/banner5.png') }}" class="absolute bottom-0 lg:bottom-1" alt="banner">
                    </div>
                </div>
            </a>
        </div>
        <div class="bg-white rounded-xl p-2 h-36 lg:h-auto">
            <a href="">
                <div class="flex flex-row h-full">
                    <div class="flex flex-col text-left text-md lg:text-xl basis-full p-1 lg:p-4">
                        <div class="m-1 lg:m-3 font-bold">Интересные места для посещений</div>
                    </div>
                </div>
            </a>
        </div>
        <div class="bg-white rounded-xl p-2 h-36 lg:h-auto">
            <a href="">
                <div class="flex flex-row h-full">
                    <div class="flex flex-col text-left text-md lg:text-xl basis-full p-1 lg:p-4">
                        <div class="m-1 lg:m-3 font-bold">Сервис <br class="hidden lg:block"> моя община</div>
                        <div class="mx-1 lg:mx-2 text-sm font-light text-slate-500">Связь с общиной</div>
                    </div>
                </div>
            </a>
        </div>
        <div class="bg-blue-100 rounded-xl p-2 col-span-1 lg:col-span-2 row-span-1 lg:row-span-2 h-36 lg:h-auto">
            <div class="flex flex-row">
                <div class="flex flex-col text-left basis-3/4 lg:basis-1/2 p-1 lg:p-4">
                    <div class="m-1 lg:m-3 text-lg lg:text-2xl font-bold ">Наши проекты</div>
                    <div class="mx-1 lg:mx-2 lg:my-3 font-light text-slate-500 hidden lg:flex">Сделанные проекты<br>Достижения, план работ</div>
                    <a href="{{ route('project.index') }}" class="hidden lg:inline-block text-center rounded-md bg-green-500 text-white w-4/5 xl:w-1/2 h-9 px-2 lg:px-6 py-2 items-center">
                        Все проекты
                    </a>
                    <a href="{{ route('project.index') }}" class="my-3 inline-block rounded-md bg-green-500 py-2 text-white lg:hidden text-center w-3/5 items-center">
                        Все проекты
                    </a>
                    <a href="" class="my-2 lg:my-4 rounded-md bg-blue-500 text-white w-4/5 xl:w-1/2 h-9 px-6 py-2 items-center hidden lg:inline-block">
                        Добавить
                    </a>
                </div>
                <div class="basis-1/4 lg:basis-1/2 relative">
                    <img src="{{ url('/image/banner7.png')}}" class="absolute bottom-1" alt="banner">
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl p-2 h-36 lg:h-auto">
            <a href="">
                <div class="flex flex-row h-full">
                    <div class="flex flex-col text-left text-md lg:text-xl basis-full p-1 lg:p-4">
                        <div class="m-1 lg:m-3 font-bold">Религия и церковь</div>
                    </div>
                </div>
            </a>
        </div>
        <div class="bg-blue-100 rounded-xl p-2 h-36 lg:h-auto">
            <a href="">
                <div class="flex flex-row h-full">
                    <div class="flex flex-col text-left basis-3/4 p-1 lg:p-4">
                        <div class="m-2 font-bold">Бизнес справочник</div>
                        <div class="mx-2 text-sm font-light text-slate-500">Каталог товаров и услуг армянской общины</div>
                    </div>
                    <div class="basis-1/2 relative">
                        <img src="{{ url('/image/banner6.png') }}" class="absolute bottom-2" alt="banner">
                    </div>
                </div>
            </a>
        </div>
    </div>
</section>

@endsection