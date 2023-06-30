@extends('layouts.app')

@section('content')

<section>

    <nav class="w-11/12 my-2 lg:my-5 rounded-md mx-auto px-3 lg:px-2 text-sm md:text-md">
        <ol class="list-reset flex">
            <li>
                <a href="{{ route('home') }}" class="text-primary transition duration-150 ease-in-out hover:text-primary-600 focus:text-primary-600 active:text-primary-700 dark:text-primary-400 dark:hover:text-primary-500 dark:focus:text-primary-500 dark:active:text-primary-600">Главная</a>
            </li>
            <li>
                <span class="mx-2 text-neutral-500 dark:text-neutral-400">/</span>
            </li>
            <li class="text-neutral-500 dark:text-neutral-400">
            <a href="{{ route('offer.index') }}">
            Предложения</a>
            </li>
        </ol>
    </nav>


    @livewire('select-offers')
   
</section>

@endsection