@extends('layouts.app')
@section('content')
<div class="flex flex-col lg:flex-row w-11/12 mx-auto my-10">
    <div class="flex flex-col basis-full lg:basis-1/5 ">
        <div class="bg-white rounded-md pb-3 lg:m-3 my-3 hidden lg:block" id="selectCategory">
            <ul class="m-6 text-md">
                <li class="p-2 hover:text-gray-500 rounded-md"><a href="{{ route('dashboard') }}">Главная</a></li>
                <li class="p-2 hover:text-gray-500 rounded-md"><a href="{{ route('dashboard') }}">Мои компания</a></li>
                <li class="p-2 hover:text-gray-500 rounded-md"><a href="{{ route('mygroup.index') }}">Мои группы</a></li>
                <li class="p-2 hover:text-gray-500 rounded-md"><a href="{{ route('dashboard') }}">Маркет</a></li>
                <li class="p-2 hover:text-gray-500 rounded-md"><a href="{{ route('dashboard') }}">Новости</a></li>
                <li class="p-2 hover:text-gray-500 rounded-md"><a href="{{ route('dashboard') }}">Мероприятия</a></li>
                <li class="p-2 hover:text-gray-500 rounded-md"><a href="{{ route('dashboard') }}">Моё резюме</a></li>
                <li class="p-2 hover:text-gray-500 rounded-md"><a href="{{ route('dashboard') }}">Мои проекты</a></li>
                <hr class="mt-3">
                <li class="p-2 bg-gray-100 hover:text-gray-500 rounded-md"><a href="{{ route('profile.edit') }}">Настройки</a></li>
                <li class="p-2 hover:text-gray-500 rounded-md"><a href="{{ route('dashboard') }}">Справочник</a></li>
                <li class="p-2 hover:text-gray-500 rounded-md"><a href="{{ route('dashboard') }}">Выход</a></li>
            </ul>
        </div>
    </div>
    <div class="flex basis-full lg:basis-4/5 lg:m-3 my-3 lg:ml-5">
        <div class="w-full mx-auto space-y-6">
            <div class="p-4 sm:p-8 bg-white rounded-md">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow rounded-md">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow rounded-md">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection