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
            <a href="{{ route('group.index') }}" class="text-primary transition duration-150 ease-in-out hover:text-primary-600 focus:text-primary-600 active:text-primary-700 dark:text-primary-400 dark:hover:text-primary-500 dark:focus:text-primary-500 dark:active:text-primary-600">Группы</a>
        </li>
        <li>
            <span class="mx-2 text-neutral-500 dark:text-neutral-400">/</span>
        </li>
        <li class="text-neutral-500 dark:text-neutral-400">
            <a href="{{ route('group.show', ['id' => $group->id]) }}">
                {{ $group->name }}</a>
        </li>
    </ol>
</nav>
<section>
    <div class="flex flex-col w-11/12 mx-auto my-6 lg:my-8">
        <div class="flex flex-col md:flex-row basis-full bg-white rounded-md p-1 lg:p-10">
            <div class="flex flex-col">
                @if( $group->image == null )
                <img class="max-w-xs h-48 rounded-lg my-2 mx-auto p-16" src="{{ url('/image/no-image.png')}}" alt="image" />
                @else
                <img src="{{ asset( 'storage/'.$group->image) }}" alt="" class="h-48 rounded-lg m-1 lg:m-5">
                @endif
                <!-- <p class="text-left font-bold text-md mx-5 my-5">Рейтинг 8,2</p> -->
                <div class="mx-5">
                    <div class="my-2 flex flex-row">
                        <div class="basis-4/5 text-left text-sm">Заполненость профиля</div>
                        <div class="basis-1/5 text-right text-sm">{{ $fullness }}%</div>
                    </div>
                    <div class="w-full bg-gray-200 rounded-md mb-5">
                        <div class="bg-green-500 h-2 text-gray-50 align-middle p-0.5 text-center text-md font-medium leading-none text-primary-100" style='width: {{ $fullness }}%'></div>
                    </div>
                </div>
            </div>
            <div class="flex flex-col px-3 lg:px-10">
                <h3 class="text-left text-xl lg:text-2xl m-2 md:m-5">{{ $group->name }}</h1>
                    <p class="text-left text-md lg:text-lg mx-2 md:mx-5 text-gray-500">{{ $group->city->name }}</p>
                    <p class="text-justify m-2 lg:m-5 mt-6 lg:mt-10 text-md break-all">{{ $group->description }}</p>
            </div>
        </div>
        <div class="flex-flex-row py-2 lg:py-10">
            <ul class="mb-4 flex list-none flex-row flex-wrap border-b-0 pl-0 basis-1/2">
                <li>
                    <button id="event_button" class="my-2 block border-x-0 border-b-2 border-t-0 border-neutral-200 px-5 lg:px-10 pb-2 lg:pb-3.5 pt-4 text-sm lg:text-lg font-medium text-neutral-600 hover:border-gray-500 hover:text-gray-700">
                        Мероприятия
                    </button>
                </li>
                <li>
                    <button id="project_button" class="my-2 block border-x-0 border-b-2 border-t-0 border-neutral-200 px-5 lg:px-10 pb-2 lg:pb-3.5 pt-4 text-sm lg:text-lg font-medium text-neutral-600 hover:border-gray-500 hover:text-gray-700">
                        Проекты
                    </button>
                </li>
                <li>
                    <button id="vacancy_button" class="my-2 block border-x-0 border-b-2 border-t-0 border-neutral-200 px-5 lg:px-10 pb-2 lg:pb-3.5 pt-4 text-sm lg:text-lg font-medium text-neutral-600 hover:border-gray-500 hover:text-gray-700">
                        Работа
                    </button>
                </li>
                <li>
                    <button id="news_button" class="my-2 block border-x-0 border-b-2 border-t-0 border-neutral-200 px-5 lg:px-10 pb-2 lg:pb-3.5 pt-4 text-sm lg:text-lg font-medium text-neutral-600 hover:border-gray-500 hover:text-gray-700">
                        Новости
                    </button>
                </li>
            </ul>
        </div>
        <div class="flex basis-full mt-3 mb-16" id="events">
            @if($group->events->isEmpty())
            <div class="w-full text-center p-4">
                <div class="flex items-center text-center justify-center">
                    <h3 class="text-2xl font-normal mx-auto">У ГРУППЫ НЕТ ПРЕДСТОЯЩИХ МЕРОПРИЯТИЙ</h3>
                </div>
            </div>
            @else
            <div class="w-full grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-3 lg:gap-5">
                @foreach($group->events as $event)
                <div class="block rounded-lg bg-white">
                    <a href="#!" class="h-48 max-w-lg block">
                        @if( $event->image == null )
                        <img class="max-w-lg h-48 rounded-lg my-2 mx-auto p-16" src="{{ url('/image/no-image.png')}}" alt="image" />
                        @else
                        <img class="h-40 lg:h-48 rounded-lg mx-auto p-1 lg:p-4 flex object-cover" src="{{ asset( 'storage/'.$event->image) }}" alt="image">
                        @endif
                    </a>
                    <div class="p-3 lg:p-6">
                        <div class="h-12">
                            <h5 class="mb-1 lg:mb-3 break-words text-md lg:text-lg font-medium leading-tight text-neutral-800">
                                {{ $event->name }}
                            </h5>
                        </div>
                        <hr class="my-1 lg:my-3">
                        <div>
                            <p class="text-right pb-0">{{ $event->date_to_start }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
        </div>
        <div class="basis-full mt-3 mb-16 hidden" id="projects">
            @if($group->projects->isEmpty())
            <div class="w-full text-center p-4">
                <div class="flex items-center text-center justify-center">
                    <h3 class="text-2xl font-normal mx-auto">У ГРУППЫ НЕТ ПРОЕКТОВ</h3>
                </div>
            </div>
            @else
            <div class="w-full grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-3 lg:gap-5">
                @foreach($group->projects as $project)
                <div class="block rounded-lg bg-white">
                    <a href="#!" class="h-48 max-w-lg block">
                        @if( $project->image == null )
                        <img class="max-w-lg h-48 rounded-lg my-2 mx-auto p-16" src="{{ url('/image/no-image.png')}}" alt="{{ $project->image }}" />
                        @else
                        <img class="h-40 lg:h-48 rounded-lg mx-auto p-1 lg:p-4 flex object-cover" src="{{ asset( 'storage/'.$project->image) }}" alt="{{ $project->image }}">
                        @endif
                    </a>
                    <div class="p-3 lg:p-6">
                        <div class="h-12">
                            <h5 class="mb-1 lg:mb-3 break-words text-md lg:text-lg font-medium leading-tight text-neutral-800">
                                {{ $project->name }}
                            </h5>
                        </div>
                        <hr class="my-1 lg:my-3">
                        <div>
                            <div class="my-2 flex flex-row">
                                <div class="basis-1/2 text-left font-bold">{{ $project->donations_need }} руб.</div>
                                <div class="basis-1/2 text-right">{!! $project->donations_have ? ($project->donations_have * 100)/ $project->donations_need : 0 !!} %</div>
                            </div>
                            <div class="w-full bg-gray-200">
                                <div class="bg-green-500 h-5 text-gray-50 align-middle p-0.5 text-center text-md font-medium leading-none text-primary-100" style='width: {!! $project->donations_have ? ($project->donations_have * 100)/ $project->donations_need : 0 !!}%'></div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
        </div>
        <div class="basis-full mt-3 mb-16 hidden" id="vacancies">
            @if($group->vacancies->isEmpty())
            <div class="w-full text-center p-4">
                <div class="flex items-center text-center justify-center">
                    <h3 class="text-2xl font-normal mx-auto">У ГРУППЫ НЕТ ВАКАНСИЙ</h3>
                </div>
            </div>
            @else
            <div class="w-full grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-3 lg:gap-5">
                @foreach($group->vacancies as $work)
                <div class="block rounded-lg bg-white">
                    <a href="#!" class="h-26 block align-center">
                        <div class="p-3 lg:p-6">
                            <div class="h-12">
                                <h5 class="mb-1 lg:mb-3 break-words text-md lg:text-lg font-medium leading-tight text-neutral-800">
                                    {{ $work->name }}
                                </h5>
                            </div>
                            <hr class="my-1 lg:my-3">
                            <div>
                                <p class="text-center text-md font-bold pb-0">
                                    @if($work->price)
                                    {{ $work->price }} RUB.
                                    @else
                                    no price
                                    @endif
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
            @endif
        </div>
        <div class="basis-full mt-3 mb-16 hidden" id="news">
            @if($group->news->isEmpty())
            <div class="w-full text-center p-4">
                <div class="flex items-center text-center justify-center">
                    <h3 class="text-2xl font-normal mx-auto">У ГРУППЫ НЕТ НОВОСТЕЙ</h3>
                </div>
            </div>
            @else
            <div class="w-full grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-3 lg:gap-5">
                @foreach($group->news as $new)
                <div class="block rounded-lg bg-white">
                    <a href="#!" class="block h-52">
                        @if( $new->image == null )
                        <img class="max-w-xs h-48 rounded-lg my-2 mx-auto p-16" src="{{ url('/image/no-image.png')}}" alt="image" />
                        @else
                        <img class="h-48 w-full rounded-2xl p-2 flex object-cover" src="{{ asset( 'storage/'.$new->image) }}" alt="image">
                        @endif
                    </a>
                    <div class="p-6">
                        <div class="h-12">
                            <h5 class="mb-3 break-words text-lg font-medium leading-tight text-neutral-800">
                                {{ $new->name }}
                            </h5>
                        </div>
                        <hr class="my-3">
                        <div>
                            <p class="text-right pb-0">{{ $new->date }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
        </div>
    </div>
</section>
<script>
    $(document).ready(function() {
        $('#event_button').css('color', '#0043ff');
        $('#event_button').css('border-bottom-color', '#0043ff');
        $('#event_button').on('click', function() {
            $('#events').show();
            $('#projects').hide();
            $('#vacancies').hide();
            $('#news').hide();
            $('#event_button').css('color', '#0043ff');
            $('#event_button').css('border-bottom-color', '#0043ff');
            $('#project_button').css('color', '');
            $('#project_button').css('border-bottom-color', '');
            $('#vacancy_button').css('color', '');
            $('#vacancy_button').css('border-bottom-color', '');
            $('#news_button').css('color', '');
            $('#news_button').css('border-bottom-color', '');
        });
        $('#project_button').on('click', function() {
            $('#events').hide();
            $('#projects').show();
            $('#vacancies').hide();
            $('#news').hide();
            $('#event_button').css('color', '');
            $('#event_button').css('border-bottom-color', '');
            $('#project_button').css('color', '#0043ff');
            $('#project_button').css('border-bottom-color', '#0043ff');
            $('#vacancy_button').css('color', '');
            $('#vacancy_button').css('border-bottom-color', '');
            $('#news_button').css('color', '');
            $('#news_button').css('border-bottom-color', '');
        });
        $('#vacancy_button').on('click', function() {
            $('#events').hide();
            $('#projects').hide();
            $('#vacancies').show();
            $('#news').hide();
            $('#event_button').css('color', '');
            $('#event_button').css('border-bottom-color', '');
            $('#project_button').css('color', '');
            $('#project_button').css('border-bottom-color', '');
            $('#vacancy_button').css('color', '#0043ff');
            $('#vacancy_button').css('border-bottom-color', '#0043ff');
            $('#news_button').css('color', '');
            $('#news_button').css('border-bottom-color', '');
        });
        $('#news_button').on('click', function() {
            $('#events').hide();
            $('#projects').hide();
            $('#vacancies').hide();
            $('#news').show();
            $('#event_button').css('color', '');
            $('#event_button').css('border-bottom-color', '');
            $('#project_button').css('color', '');
            $('#project_button').css('border-bottom-color', '');
            $('#vacancy_button').css('color', '');
            $('#vacancy_button').css('border-bottom-color', '');
            $('#news_button').css('color', '#0043ff');
            $('#news_button').css('border-bottom-color', '#0043ff');
        });
    });
</script>
@endsection