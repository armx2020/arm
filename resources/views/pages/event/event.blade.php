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
            <a href="{{ route('event.index') }}" class="text-primary transition duration-150 ease-in-out hover:text-primary-600 focus:text-primary-600 active:text-primary-700 dark:text-primary-400 dark:hover:text-primary-500 dark:focus:text-primary-500 dark:active:text-primary-600">Афиша</a>
        </li>
        <li>
            <span class="mx-2 text-neutral-500 dark:text-neutral-400">/</span>
        </li>
        <li class="text-neutral-500 dark:text-neutral-400">
            <a href="{{ route('event.show', ['id' => $event->id]) }}">
                {{ $event->name }}</a>
        </li>
    </ol>
</nav>
<section>
    <div class="flex flex-col w-11/12 mx-auto my-6 lg:my-8">
        <div class="flex flex-col md:flex-row basis-full bg-white rounded-md p-1 lg:p-5 relative">
            <div class="flex flex-col basis-1/4">
                @if( $event->image == null )
                <img class="h-40 lg:h-48 rounded-lg mx-auto p-1 flex object-cover" src="{{ url('/image/no-image.png')}}" alt="image" />
                @else
                <img class="h-40 lg:h-48 rounded-lg mx-auto p-1 flex object-cover" src="{{ asset( 'storage/'.$event->image) }}" alt="image">
                @endif
            </div>
            <div class="flex flex-col px-3 lg:px-10 basis-3/4">
                <h3 class="text-left text-xl lg:text-2xl mx-4">{{ $event->name }}</h1>
                    <p class="text-left text-sm mx-4 my-1 text-gray-600">инициатор: {{ $event->parent->name ? $event->parent->name : $event->parent->firstname }} {{ $event->parent->lastname }}</p>
                    <p class="text-left text-sm mx-4 my-1 text-gray-600">город: {{ $event->city->name }} ({{$event->region->name }})</p>
                    <p class="text-left text-sm mx-4 text-gray-600">{{ $event->date_to_start }}</p>
                    <p class="text-left text-sm mx-4 my-1 text-gray-600">{{ $event->description }}</p>
            </div>
        </div>
    </div>
</section>
@endsection