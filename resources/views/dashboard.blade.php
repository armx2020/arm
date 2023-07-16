@extends('layouts.app')
@section('content')

<div class="flex flex-col lg:flex-row w-11/12 mx-auto my-10">
    <div class="flex flex-col basis-full lg:basis-1/5 ">
        <div class="bg-white rounded-md pb-3 lg:m-3 my-3 hidden lg:block" id="selectCategory">
            <ul class="m-6 text-md">
                <li class="p-2 bg-gray-100 hover:text-gray-500 rounded-md"><a href="{{ route('dashboard') }}">Главная</a></li>
                <li class="p-2 hover:text-gray-500 rounded-md"><a href="{{ route('dashboard') }}">Мои компания</a></li>
                <li class="p-2 hover:text-gray-500 rounded-md"><a href="{{ route('dashboard') }}">Мои группы</a></li>
                <li class="p-2 hover:text-gray-500 rounded-md"><a href="{{ route('dashboard') }}">Маркет</a></li>
                <li class="p-2 hover:text-gray-500 rounded-md"><a href="{{ route('dashboard') }}">Новости</a></li>
                <li class="p-2 hover:text-gray-500 rounded-md"><a href="{{ route('dashboard') }}">Мероприятия</a></li>
                <li class="p-2 hover:text-gray-500 rounded-md"><a href="{{ route('dashboard') }}">Моё резюме</a></li>
                <li class="p-2 hover:text-gray-500 rounded-md"><a href="{{ route('dashboard') }}">Мои проекты</a></li>
                <hr class="mt-3">
                <li class="p-2 hover:text-gray-500 rounded-md"><a href="{{ route('dashboard') }}">Настройки</a></li>
                <li class="p-2 hover:text-gray-500 rounded-md"><a href="{{ route('dashboard') }}">Справочник</a></li>
                <li class="p-2 hover:text-gray-500 rounded-md"><a href="{{ route('dashboard') }}">Выход</a></li>
            </ul>
        </div>
    </div>
    <div class="flex basis-full lg:basis-4/5 lg:m-3 my-3 lg:ml-5">
        <div class="flex flex-col md:flex-row basis-full bg-white rounded-md p-1 lg:p-10">
            <div class="flex flex-col basis-1/4">
                @if( Auth::user()->image )
                <img class="h-40 lg:h-48 rounded-lg mx-auto p-1 lg:p-4 flex object-cover" src="{{ asset( 'storage/'.Auth::user()->image) }}" alt="{{ Auth::user()->name }}">
                @else
                <img class="h-40 lg:h-48 rounded-lg mx-auto p-1 lg:p-10 flex object-cover" src="{{ url('/image/no-image.png')}}" alt="image" />
                @endif
                <!-- <p class="text-left font-bold text-md mx-5 my-5">Рейтинг 8,2</p> -->
                <div class="mx-5">
                    <div class="my-2 flex flex-row">
                        <div class="basis-4/5 text-left text-sm">Заполненость профиля</div>
                        <div class="basis-1/5 text-right text-sm">99%</div>
                    </div>
                    <div class="w-full bg-gray-200 rounded-md mb-5">
                        <div class="bg-green-500 h-2 text-gray-50 align-middle p-0.5 text-center text-md font-medium leading-none text-primary-100" style='width: 99%'></div>
                    </div>
                </div>
            </div>
            <div class="flex flex-col px-3 lg:px-10 basis-3/4">
                <h3 class="text-left text-xl lg:text-2xl mx-4">{{ Auth::user()->firstname}} {{ Auth::user()->lastname}}</h1>
                    <p class="text-left text-sm lg:text-lg mx-4 mb-4 text-gray-600">город: {{ Auth::user()->city->name }}</p>
                    <p class="text-left text-sm lg:text-lg mx-4 text-gray-500">{{ Auth::user()->phone }}</p>
                    <p class="text-left text-sm lg:text-lg mx-4 text-gray-500">{{ Auth::user()->email }}</p>
                    
                    <hr class="mt-3 mb-3">
                    <div class="flow-root mb-3">
                        <div class="grid grid-cols-3 md:grid-cols-3 justify-center gap-6">
                           @if(Auth::user()->viber)
                            <div class="text-sm text-center font-normal text-gray-500">
                                <div class="text-base text-gray-900">viber</div>
                                <div class="text-sm font-normal text-gray-500">{{ Auth::user()->viber}}</div>
                            </div>
                            @endif
                            @if(Auth::user()->whatsapp)
                            <div class="text-sm text-center font-normal text-gray-500">
                                <div class="text-base text-gray-900">watsapp</div>
                                <div class="text-sm font-normal text-gray-500">{{ Auth::user()->whatsapp}}</div>
                            </div>
                            @endif
                            @if(Auth::user()->telegram)
                            <div class="text-sm text-center font-normal text-gray-500">
                                <div class="text-base text-gray-900">telegram</div>
                                <div class="text-sm font-normal text-gray-500">{{ Auth::user()->telegram}}</div>
                            </div>
                            @endif
                            @if(Auth::user()->instagram)
                            <div class="text-sm text-center font-normal text-gray-500">
                                <div class="text-base text-gray-900">instagram</div>
                                <div class="text-sm font-normal text-gray-500">{{ Auth::user()->instagram}}</div>
                            </div>
                            @endif
                            @if(Auth::user()->vkontakte)
                            <div class="text-sm text-center font-normal text-gray-500">
                                <div class="text-base text-gray-900">vkontakte</div>
                                <div class="text-sm font-normal text-gray-500">{{ Auth::user()->vkontakte}}</div>
                            </div>
                            @endif
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>
</div>

@endsection