@extends('layouts.app')
@section('content')

<div class="flex flex-col lg:flex-row w-11/12 mx-auto my-10">
    
    <x-nav-profile page="main"></x-nav-profile>

    <div class="flex basis-full lg:basis-4/5 lg:m-3 my-3 lg:ml-5">
        <div class="flex flex-col md:flex-row basis-full bg-white rounded-md p-2 lg:p-10">
            <div class="flex flex-col basis-1/4">
                @if( Auth::user()->image )
                <img class="h-40 lg:h-48 rounded-lg mx-auto p-1 flex object-cover" src="{{ asset( 'storage/'.Auth::user()->image) }}" alt="{{ Auth::user()->name }}">
                @else
                <img class="h-40 lg:h-48 rounded-lg mx-auto p-1 lg:p-10 flex object-cover" src="{{ url('/image/user.png')}}" alt="image" />
                @endif
                <div class="m-5">
                    <div class="my-2 flex flex-row">
                        <div class="basis-4/5 text-left text-sm">Заполненость профиля</div>
                        <div class="basis-1/5 text-right text-sm">{{ $fullness }}%</div>
                    </div>
                    <div class="w-full bg-gray-200 rounded-md mb-5">
                        <div class="bg-green-500 h-2 text-gray-50 align-middle p-0.5 text-center text-md font-medium leading-none text-primary-100" style='width: {{ $fullness }}%'></div>
                    </div>
                </div>
            </div>
            <div class="flex flex-col px-3 lg:px-10 basis-3/4">
                <h3 class="text-left text-xl lg:text-2xl mx-4 mt-2">{{ Auth::user()->firstname}} {{ Auth::user()->lastname}}</h1>
                    <p class="text-left text-sm mx-4 my-1 text-gray-600">город: {{ Auth::user()->city->name }}</p>

                    <hr class="mt-3 mb-3">
                    <div class="flow-root mb-3">
                        <h4 class="text-left text-lg lg:text-xl my-2 mx-3">Социальные сети</h4>
                        <div class="grid grid-cols-2 justify-center gap-2 mx-3">
                            <div class="text-sm font-normal text-gray-600">
                                телефон: {{ Auth::user()->phone }}
                            </div>
                            <div class="text-sm font-normal text-gray-600">
                                email: {{ Auth::user()->email }}
                            </div>
                            <div class="text-sm font-normal text-gray-600">
                                vkontakte: {{ Auth::user()->vkontakte ? Auth::user()->vkontakte : 'не указан'}}
                            </div>
                            <div class="text-sm font-normal text-gray-600">
                                watsapp: {{ Auth::user()->whatsapp ? Auth::user()->vwhatsapp : 'не указан'}}
                            </div>
                            <div class="text-sm font-normal text-gray-600">
                                telegram: {{ Auth::user()->telegram ? Auth::user()->telegram  : 'не указан'}}
                            </div>
                            <div class="text-sm font-normal text-gray-600">
                                instagram: {{ Auth::user()->instagram ? Auth::user()->instagram : 'не указан'}}
                            </div>
                            <div class="text-sm font-normal text-gray-600">
                                viber: {{ Auth::user()->viber ? Auth::user()->viber : 'не указан'}}
                            </div>

                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection