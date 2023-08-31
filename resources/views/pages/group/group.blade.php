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
            <div class="flex flex-col basis-1/5" @if( $group->image !== null && $group->image1 !== null)
                id="slider"
                @endif
                >
                <ul>
                    @if( $group->image == null )
                    <img src="{{ url('/image/no-image.png')}}" class="h-56 w-full rounded-2xl p-2 flex object-cover" alt="image" />
                    @else
                    <li><img src="{{ asset( 'storage/'.$group->image) }}" class="h-56 w-full rounded-2xl p-2 flex object-cover" alt="image"></li>
                    @endif

                    @if($group->image1)
                    <li><img src="{{ asset( 'storage/'.$group->image1) }}" class="h-56 w-full rounded-2xl p-2 flex object-cover" alt="image1"></li>
                    @endif

                    @if($group->image2)
                    <li><img src="{{ asset( 'storage/'.$group->image2) }}" class="h-56 w-full rounded-2xl p-2 flex object-cover" alt="image2"></li>
                    @endif

                    @if($group->image3)
                    <li><img src="{{ asset( 'storage/'.$group->image3) }}" class="h-56 w-full rounded-2xl p-2 flex object-cover" alt="image3"></li>
                    @endif

                    @if($group->image4)
                    <li><img src="{{ asset( 'storage/'.$group->image4) }}" class="h-56 w-full rounded-2xl p-2 flex object-cover" alt="image4"></li>
                    @endif
                </ul>

                <div class="m-5">
                    <div class="my-2 flex flex-row">
                        <div class="basis-1/2 text-right">{{ $fullness }} %</div>
                    </div>
                    <div class="w-full bg-gray-200">
                        <div class="bg-green-500 h-5 text-gray-50 align-middle p-0.5 text-center text-md font-medium leading-none text-primary-100" style='width: {{ $fullness }}%'></div>
                    </div>
                </div>

            </div>
            <div class="flex flex-col px-3 lg:px-10">
                <h3 class="text-left text-xl lg:text-2xl m-2 md:m-5">{{ $group->name }}</h1>
                    <p class="text-left text-md mx-4 my-1 text-gray-600">{{ $group->city->name }} ({{ $group->region->name }})</p>
                    <p class="text-left text-sm mx-4 my-1 text-gray-500 break-all">{{ $group->description }}</p>
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
                <div class="block rounded-lg bg-white h-80">
                    <a href="{{ route('event.show', ['id' => $event->id ]) }}" class="block h-52">
                        @if( $event->image == null )
                        <img class="h-48 w-full rounded-2xl p-2 flex object-cover" src="{{ url('/image/no-image.png')}}" alt="image" />
                        @else
                        <img class="h-48 w-full rounded-2xl p-2 flex object-cover" src="{{ asset( 'storage/'.$event->image) }}" alt="image">
                        @endif
                    </a>
                    <div class="px-6">
                        <div class="h-12">
                            <h5 class="mb-3 break-words text-lg font-medium leading-tight text-neutral-800">
                                {{ $event->name }}
                            </h5>
                        </div>
                        <hr class="my-3">
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
                <div class="block rounded-lg bg-white h-96">
                    <a href="{{ route('project.show', ['id' => $project->id ]) }}" class="block h-52">
                        @if( $project->image == null )
                        <img class="h-48 w-full rounded-2xl p-2 flex object-cover" src="{{ url('/image/no-image.png')}}" alt="image" />
                        @else
                        <img class="h-48 w-full rounded-2xl p-2 flex object-cover" src="{{ asset( 'storage/'.$project->image) }}" alt="image">
                        @endif
                    </a>
                    <div class="px-6">
                        <h5 class="mb-3 break-words text-lg font-medium leading-tight text-neutral-800 h-20">
                            {{ $project->name }}
                        </h5>
                        <hr class="my-2">
                        <div>
                            <div class="my-2 flex flex-row">
                                <div class="basis-1/2 text-left font-bold">{{ $project->donations_need }} руб.</div>
                                <div class="basis-1/2 text-right">{!! round($project->donations_have ? ($project->donations_have * 100)/ $project->donations_need : 0) !!} %</div>
                            </div>
                            <div class="w-full bg-gray-200">
                                <div class="bg-green-500 h-5 text-gray-50 align-middle p-0.5 text-center text-md font-medium leading-none text-primary-100" style='width: {!! round($project->donations_have ? ($project->donations_have * 100)/ $project->donations_need : 0) !!}%'></div>
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
                <div class="block rounded-lg bg-white h-80">
                    <a href="{{ route('vacancy.show', ['id' => $work->id ]) }}" class="block h-52">
                        @if( $work->parent == null )
                        <img class="h-48 w-full rounded-2xl p-2 flex object-cover" src="{{ url('/image/no-image.png')}}" alt="image" />
                        @else
                        @if( $work->parent->image == null )
                        <img class="h-48 w-full rounded-2xl p-2 flex object-cover" src="{{ url('/image/no-image.png')}}" alt="image" />
                        @else
                        <img class="h-48 w-full rounded-2xl p-2 flex object-cover" src="{{ asset( 'storage/'.$work->parent->image) }}" alt="image">
                        @endif
                        @endif
                    </a>
                    <div class="px-6">
                        <h5 class="mb-3 break-words text-lg font-medium leading-tight text-neutral-800">
                            {{$work->name }}
                        </h5>
                        <hr class="my-2">
                        <div class="my-4 break-all text-base text-right">
                            <p class="mx-3 inline text-md font-bold">
                                @if($work->price !== null && $work->price !== 0)
                                {{ $work->price }} RUB.
                                @else
                                no price
                                @endif
                            </p>
                        </div>
                    </div>
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
                <div class="block rounded-lg bg-white h-80">
                    <a href="{{ route('news.show', ['id' => $new->id ]) }}" class="block h-52">
                        @if( $new->image == null )
                        <img class="h-48 w-full rounded-2xl p-2 flex object-cover" src="{{ url('/image/no-image.png')}}" alt="image" />
                        @else
                        <img class="h-48 w-full rounded-2xl p-2 flex object-cover" src="{{ asset( 'storage/'.$new->image) }}" alt="image">
                        @endif
                    </a>
                    <div class="px-6">
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
        $('#slider ul').bxSlider({
            pager: true,
            controls: true,
            auto: true,
            mode: 'fade',
            pause: 10000,
            minSlides: 1,
            maxSlides: 1
        });
    });
</script>
@endsection