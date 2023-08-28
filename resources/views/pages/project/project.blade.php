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
            <a href="{{ route('project.index') }}" class="text-primary transition duration-150 ease-in-out hover:text-primary-600 focus:text-primary-600 active:text-primary-700 dark:text-primary-400 dark:hover:text-primary-500 dark:focus:text-primary-500 dark:active:text-primary-600">Проекты</a>
        </li>
        <li>
            <span class="mx-2 text-neutral-500 dark:text-neutral-400">/</span>
        </li>
        <li class="text-neutral-500 dark:text-neutral-400">
            <a href="{{ route('project.show', ['id' => $project->id]) }}">
                {{ $project->name }}</a>
        </li>
    </ol>
</nav>
<section>
    <div class="flex flex-col w-11/12 mx-auto my-6 lg:my-8">
        <div class="flex flex-col md:flex-row basis-full bg-white rounded-md p-1 lg:p-10 relative">
            <div class="flex flex-col basis-1/4">
                @if( $project->image == null )
                <img class="h-40 lg:h-48 rounded-lg mx-auto p-1 flex object-cover" src="{{ url('/image/no-image.png')}}" alt="image" />
                @else
                <img class="h-40 lg:h-48 rounded-lg mx-auto p-1 flex object-cover" src="{{ asset( 'storage/'.$project->image) }}" alt="image">
                @endif
                <div class="m-5">
                    <div class="my-2 flex flex-row">
                        <div class="basis-1/2 text-left font-bold">{{ $project->donations_need }} руб.</div>
                        <div class="basis-1/2 text-right">{{ $fullness }} %</div>
                    </div>
                    <div class="w-full bg-gray-200">
                        <div class="bg-green-500 h-5 text-gray-50 align-middle p-0.5 text-center text-md font-medium leading-none text-primary-100" style='width: {{ $fullness }}%'></div>
                    </div>
                </div>
            </div>
            <div class="flex flex-col px-3 lg:px-10 basis-3/4">
                <h3 class="text-left text-xl lg:text-2xl mx-4">{{ $project->name }}</h1>
                    <p class="text-left text-sm mx-4 my-1 text-gray-600">инициатор: {{ $project->parent->name ? $project->parent->name : $project->parent->firstname }} {{ $project->parent->lastname }}</p>
                    <p class="text-left text-sm mx-4 my-1 text-gray-600">город: {{ $project->city->name }} ({{$project->region->name }})</p>
                    <p class="text-left text-sm mx-4 my-1 text-gray-500">{{ $project->description }}</p>
                    <hr class="mt-3 mb-3">
                    <div class="flow-root mb-3">
                        <h4 class="text-left text-lg lg:text-xl my-2 mx-3">Социальные сети</h4>
                        <div class="grid grid-cols-2 justify-center gap-2 mx-3">
                            <div class="text-sm font-normal text-gray-600">
                                телефон: {{ $project->parent->phone ? $project->parent->phone : 'не указан' }}
                            </div>
                            <div class="text-sm font-normal text-gray-600">
                                web: {{ $project->parent->web ? $project->parent->web : 'не указан' }}
                            </div>
                            <div class="text-sm font-normal text-gray-600">
                                vkontakte: {{ $project->parent->vkontakte ? $project->parent->vkontakte : 'не указан'}}
                            </div>
                            <div class="text-sm font-normal text-gray-600">
                                watsapp: {{ $project->parent->whatsapp ? $project->parent->vwhatsapp : 'не указан'}}
                            </div>
                            <div class="text-sm font-normal text-gray-600">
                                telegram: {{ $project->parent->telegram ? $project->parent->telegram  : 'не указан'}}
                            </div>
                            <div class="text-sm font-normal text-gray-600">
                                instagram: {{ $project->parent->instagram ? $project->parent->instagram : 'не указан'}}
                            </div>
                            <div class="text-sm font-normal text-gray-600">
                                viber: {{ $project->parent->viber ? $project->parent->viber : 'не указан'}}
                            </div>

                        </div>
                    </div>
            </div>
        </div>
    </div>
</section>
@endsection