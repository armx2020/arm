@extends('layouts.app')

@section('content')

<section>

    <nav class="w-10/12 m-5 rounded-md mx-auto">
        <ol class="list-reset flex">
            <li>
                <a href="{{ route('home') }}" class="text-primary transition duration-150 ease-in-out hover:text-primary-600 focus:text-primary-600 active:text-primary-700 dark:text-primary-400 dark:hover:text-primary-500 dark:focus:text-primary-500 dark:active:text-primary-600">Главная</a>
            </li>
            <li>
                <span class="mx-2 text-neutral-500 dark:text-neutral-400">/</span>
            </li>
            <li class="text-neutral-500 dark:text-neutral-400">
            <a href="{{ route('group.index') }}">
            Группы</a>
            </li>
        </ol>
    </nav>



    @livewire('select-groups')
   
</section>

@endsection