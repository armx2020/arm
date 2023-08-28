@extends('layouts.app')
@section('content')
<nav class="w-11/12 mb-2 mt-5 rounded-md mx-auto px-3 lg:px-2 text-sm md:text-md">
    <ol class="list-reset flex">
        <li>
            <a href="{{ route('home') }}" class="text-primary transition duration-150 ease-in-out hover:text-primary-600 focus:text-primary-600 active:text-primary-700 dark:text-primary-400 dark:hover:text-primary-500 dark:focus:text-primary-500 dark:active:text-primary-600">Главная</a>
        </li>
        <li>
            <span class="mx-2 text-neutral-500 dark:text-neutral-400">/</span>
        </li>
        <li>
            <a href="{{ route('vacancy.index') }}" class="text-primary transition duration-150 ease-in-out hover:text-primary-600 focus:text-primary-600 active:text-primary-700 dark:text-primary-400 dark:hover:text-primary-500 dark:focus:text-primary-500 dark:active:text-primary-600">Работа</a>
        </li>
        <li>
            <span class="mx-2 text-neutral-500 dark:text-neutral-400">/</span>
        </li>
        <li class="text-neutral-500 dark:text-neutral-400">
            <a href="{{ route('vacancy.show', ['id' => $vacancy->id]) }}">
                {{ $vacancy->name }}</a>
        </li>
    </ol>
</nav>
<section>
    <div class="flex flex-col w-11/12 mx-auto my-6 lg:my-8">
        <div class="flex flex-col md:flex-row basis-full bg-white rounded-md p-1 lg:p-10 relative">
            <div class="flex flex-col basis-1/4">
                @if( $vacancy->parent->image == null )
                <img class="h-40 lg:h-48 rounded-lg mx-auto p-1 flex object-cover" src="{{ url('/image/no-image.png')}}" alt="image" />
                @else
                <img class="h-40 lg:h-48 rounded-lg mx-auto p-1 flex object-cover" src="{{ asset( 'storage/'.$vacancy->parent->image) }}" alt="image">
                @endif
            </div>
            <div class="flex flex-col px-3 lg:px-10 basis-3/4">
                <h3 class="text-left text-xl lg:text-2xl mx-4">{{ $vacancy->name }}</h1>
                    <p class="text-left text-sm mx-4 my-1 text-gray-600">инициатор: {{ $vacancy->parent->name ? $vacancy->parent->name : $vacancy->parent->firstname }} {{ $vacancy->parent->lastname }}</p>
                    <p class="text-left text-sm mx-4 my-1 text-gray-600">город: {{ $vacancy->city->name }} ({{$vacancy->region->name }})</p>
                    <p class="text-left text-sm mx-4 my-1 text-gray-500">{{ $vacancy->address }}</p>
                    <p class="text-left text-sm mx-4 my-1 text-gray-600">{{ $vacancy->description }}</p>
                    <p class="text-left mx-4 my-1 text-gray-800 font-bold">
                        @if($vacancy->price !== null && $vacancy->price !== 0)
                        {{ $vacancy->price }} RUB.
                        @else
                        no price
                        @endif
                    </p>
                    <hr class="mt-3 mb-3">
                    <div class="flow-root mb-3">
                        <h4 class="text-left text-lg lg:text-xl my-2 mx-3">Социальные сети</h4>
                        <div class="grid grid-cols-2 justify-center gap-2 mx-3">
                            <div class="text-sm font-normal text-gray-600">
                                телефон: {{ $vacancy->parent->phone ? $vacancy->parent->phone : 'не указан' }}
                            </div>
                            <div class="text-sm font-normal text-gray-600">
                                web: {{ $vacancy->parent->web ? $vacancy->parent->web : 'не указан' }}
                            </div>
                            <div class="text-sm font-normal text-gray-600">
                                vkontakte: {{ $vacancy->parent->vkontakte ? $vacancy->parent->vkontakte : 'не указан'}}
                            </div>
                            <div class="text-sm font-normal text-gray-600">
                                watsapp: {{ $vacancy->parent->whatsapp ? $vacancy->parent->vwhatsapp : 'не указан'}}
                            </div>
                            <div class="text-sm font-normal text-gray-600">
                                telegram: {{ $vacancy->parent->telegram ? $vacancy->parent->telegram  : 'не указан'}}
                            </div>
                            <div class="text-sm font-normal text-gray-600">
                                instagram: {{ $vacancy->parent->instagram ? $vacancy->parent->instagram : 'не указан'}}
                            </div>
                            <div class="text-sm font-normal text-gray-600">
                                viber: {{ $vacancy->parent->viber ? $vacancy->parent->viber : 'не указан'}}
                            </div>

                        </div>
                    </div>
            </div>
        </div>
    </div>
</section>
@endsection