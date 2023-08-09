@extends('layouts.app')
@section('content')
<div class="flex flex-col lg:flex-row w-11/12 mx-auto my-10">

    <x-nav-profile page="mygroups"></x-nav-profile>

    <div class="flex flex-col basis-full lg:basis-4/5 lg:m-3 my-3 lg:ml-5">
        @if(session('success'))
        <div class="mb-4 flex basis-full bg-green-100 rounded-lg px-6 py-5 text-base text-green-700" role="alert" style="max-height:64px;">
            {{ session('success')}}
        </div>
        @endif
        <div class="flex flex-col basis-full">
            <div class="flex flex-col md:flex-row basis-full bg-white rounded-md p-1 lg:p-5 relative">
                <div class="flex flex-col basis-1/4">
                    @if( $group->image == null )
                    <img class="h-40 lg:h-48 rounded-lg mx-auto p-14 flex object-cover" src="{{ url('/image/no-image.png')}}" alt="image" />
                    @else
                    <img src="{{ asset( 'storage/'.$group->image) }}" alt="" class="h-40 lg:h-48 rounded-lg mx-auto p-1 flex object-cover">
                    @endif
                    <div class="m-5">
                        <div class="my-2 flex flex-row">
                            <div class="basis-4/5 text-left text-sm">Заполненость профиля группы</div>
                            <div class="basis-1/5 text-right text-sm">{{ $fullness }}%</div>
                        </div>
                        <div class="w-full bg-gray-200 rounded-md mb-5">
                            <div class="bg-green-500 h-2 text-gray-50 align-middle p-0.5 text-center text-md font-medium leading-none text-primary-100" style='width: {{ $fullness }}%'></div>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col px-3 lg:px-10 basis-3/4">
                    <h3 class="text-left text-xl lg:text-2xl mx-4">{{ $group->name }}</h1>
                        <p class="text-left text-md lg:text-lg mx-4 my-1 text-gray-500">город: {{ $group->city->name }} ({{$group->region->name }})</p>
                        <p class="text-left text-sm mx-4 my-1 text-gray-600">{{ $group->description }}</p>

                        <hr class="mt-3 mb-3">
                        <div class="flow-root mb-3">
                            <h4 class="text-left text-lg lg:text-xl my-2 mx-3">Социальные сети</h4>
                            <div class="grid grid-cols-2 justify-center gap-2 mx-3">
                                <div class="text-sm font-normal text-gray-600">
                                    телефон: {{ $group->phone ? $group->phone : 'не указан' }}
                                </div>
                                <div class="text-sm font-normal text-gray-600">
                                    web: {{ $group->web ? $group->web : 'не указан' }}
                                </div>
                                <div class="text-sm font-normal text-gray-600">
                                    vkontakte: {{ $group->vkontakte ? $group->vkontakte : 'не указан'}}
                                </div>
                                <div class="text-sm font-normal text-gray-600">
                                    watsapp: {{ $group->whatsapp ? $group->whatsapp : 'не указан'}}
                                </div>
                                <div class="text-sm font-normal text-gray-600">
                                    telegram: {{ $group->telegram ? $group->telegram  : 'не указан'}}
                                </div>
                                <div class="text-sm font-normal text-gray-600">
                                    instagram: {{ $group->instagram ? $group->instagram : 'не указан'}}
                                </div>
                                <div class="text-sm font-normal text-gray-600">
                                    viber: {{ $group->viber ? $group->viber : 'не указан'}}
                                </div>

                            </div>
                        </div>
                </div>
                <div class="absolute right-6 top-3">
                    <div class="my-3 break-all text-base text-right">
                        <a href="{{ route('mygroups.edit', ['mygroup' => $group->id]) }}" class="inline border-2 hover:border-yellow-400 border-yellow-100 bg-yellow-100 hover:bg-yellow-400 rounded-md py-2 pl-2 pr-1 my-1" title="редактировать">
                            <svg class="inline" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" width="22" height="22" viewBox="0 0 485.219 485.22" style="enable-background:new 0 0 485.219 485.22;" xml:space="preserve">
                                <g>
                                    <path d="M467.476,146.438l-21.445,21.455L317.35,39.23l21.445-21.457c23.689-23.692,62.104-23.692,85.795,0l42.886,42.897   C491.133,84.349,491.133,122.748,467.476,146.438z M167.233,403.748c-5.922,5.922-5.922,15.513,0,21.436   c5.925,5.955,15.521,5.955,21.443,0L424.59,189.335l-21.469-21.457L167.233,403.748z M60,296.54c-5.925,5.927-5.925,15.514,0,21.44   c5.922,5.923,15.518,5.923,21.443,0L317.35,82.113L295.914,60.67L60,296.54z M338.767,103.54L102.881,339.421   c-11.845,11.822-11.815,31.041,0,42.886c11.85,11.846,31.038,11.901,42.914-0.032l235.886-235.837L338.767,103.54z    M145.734,446.572c-7.253-7.262-10.749-16.465-12.05-25.948c-3.083,0.476-6.188,0.919-9.36,0.919   c-16.202,0-31.419-6.333-42.881-17.795c-11.462-11.491-17.77-26.687-17.77-42.887c0-2.954,0.443-5.833,0.859-8.703   c-9.803-1.335-18.864-5.629-25.972-12.737c-0.682-0.677-0.917-1.596-1.538-2.338L0,485.216l147.748-36.986   C147.097,447.637,146.36,447.193,145.734,446.572z" />
                                </g>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            <div class="flex-flex-row py-2 lg:py-10">
                <ul class="mb-4 flex list-none flex-row flex-wrap border-b-0 pl-0">
                    <li>
                        <button id="event_button" class="my-2 block border-x-0 border-b-2 border-t-0 border-neutral-200 px-2 md:px-5 lg:px-10 pb-2 lg:pb-3.5 pt-4 sm:text-xs md:text-sm lg:text-lg font-thin text-neutral-600 hover:border-gray-500 hover:text-gray-700">
                            События
                        </button>
                    </li>
                    <li>
                        <button id="project_button" class="my-2 block border-x-0 border-b-2 border-t-0 border-neutral-200 px-2 md:px-5 lg:px-10 pb-2 lg:pb-3.5 pt-4 sm:text-xs md:text-sm lg:text-lg font-thin text-neutral-600 hover:border-gray-500 hover:text-gray-700">
                            Проекты
                        </button>
                    </li>
                    <li>
                        <button id="vacancy_button" class="my-2 block border-x-0 border-b-2 border-t-0 border-neutral-200 px-2 md:px-5 lg:px-10 pb-2 lg:pb-3.5 pt-4 sm:text-xs md:text-sm lg:text-lg font-thin text-neutral-600 hover:border-gray-500 hover:text-gray-700">
                            Работа
                        </button>
                    </li>
                    <li>
                        <button id="news_button" class="my-2 block border-x-0 border-b-2 border-t-0 border-neutral-200 px-2 md:px-5 lg:px-10 pb-2 lg:pb-3.5 pt-4 sm:text-xs md:text-sm lg:text-lg font-thin text-neutral-600 hover:border-gray-500 hover:text-gray-700">
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
                            <h5 class="mb-1 lg:mb-3 break-words text-md lg:text-lg font-medium leading-tight text-neutral-800">
                                {{ $event->name }}
                            </h5>
                            <p class="mb-4 break-all text-base text-neutral-400">
                                {{ $event->description }}
                            </p>
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
                            <h5 class="mb-1 lg:mb-3 break-words text-md lg:text-lg font-medium leading-tight text-neutral-800">
                                {{ $project->name }}
                            </h5>
                            <p class="mb-4 break-all text-base text-neutral-400">
                                {{ $project->description }}
                            </p>
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
                                <h5 class="mb-1 lg:mb-3 break-words text-md lg:text-lg font-medium leading-tight text-neutral-800">
                                    {{ $work->name }}
                                </h5>
                                <p class="mb-4 break-all text-base text-neutral-400">
                                    {{ $work->description }}
                                </p>
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
    </div>
</div>
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