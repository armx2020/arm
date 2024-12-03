@extends('layouts.app')
@section('title', '- АФИША')
@section('content')
<nav class="mb-2 mt-5 rounded-md mx-auto px-3 lg:px-2 text-sm md:text-md">
    <ol class="list-reset flex">
        <li>
            <a href="{{ route('home') }}" class="text-primary transition duration-150 ease-in-out hover:text-primary-600 focus:text-primary-600 active:text-primary-700 dark:text-primary-400 dark:hover:text-primary-500 dark:focus:text-primary-500 dark:active:text-primary-600">Главная</a>
        </li>
        <li>
            <span class="mx-2 text-neutral-500 dark:text-neutral-400">/</span>
        </li>
        <li>
            <a href="{{ route('events.index') }}" class="text-primary transition duration-150 ease-in-out hover:text-primary-600 focus:text-primary-600 active:text-primary-700 dark:text-primary-400 dark:hover:text-primary-500 dark:focus:text-primary-500 dark:active:text-primary-600">Афиша</a>
        </li>
        <li>
            <span class="mx-2 text-neutral-500 dark:text-neutral-400">/</span>
        </li>
        <li class="text-neutral-500 dark:text-neutral-400">
            <a href="{{ route('events.show', ['id' => $event->id]) }}">
                {{ $event->name }}</a>
        </li>
    </ol>
</nav>
<section>
    <div class="flex flex-col mx-auto my-6 lg:my-8">
        <div class="flex flex-col md:flex-row basis-full bg-white rounded-md p-1 lg:p-5 relative">
            <div class="flex flex-col basis-1/5">
                @if( $event->image == null )
                <img class="h-56 w-full rounded-2xl p-2 flex object-cover" src="{{ url('/image/no-image.png')}}" alt="image" />
                @else
                <img class="h-56 w-full rounded-2xl p-2 flex object-cover" src="{{ asset( 'storage/'.$event->image) }}" alt="image">
                @endif

                <div class="m-5">
                    <div class="my-2 text-center">
                        <p class="mx-3 inline">{{ $event->date_to_start }}</p>
                    </div>
                </div>
            </div>
            <div class="flex flex-col px-3 lg:px-10 basis-3/4">
                <h3 class="text-left text-xl lg:text-2xl mx-4">{{ $event->name }} ({{ $event->parent->name ? $event->parent->name : $event->parent->firstname. ' ' .$event->parent->lastname }})</h3>
                <p class="text-left text-md mx-4 my-1 text-gray-600">{{ $event->city->name }} {{ $event->address }}</p>
                <p class="text-left text-sm mx-4 my-1 text-gray-500 break-all">{{ $event->description }}</p>
            </div>
        </div>
    </div>
</section>
@endsection