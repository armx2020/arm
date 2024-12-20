<div class="flex-flex-row py-2 lg:py-10">
    <ul class="mb-4 flex list-none flex-row flex-wrap border-b-0 pl-0">
        <li>
            <button id="event_button"
                class="my-2 block border-x-0 border-b-2 border-t-0 border-neutral-200 px-2 md:px-5 lg:px-10 pb-2 lg:pb-3.5 pt-4 sm:text-xs md:text-sm lg:text-lg font-thin text-neutral-600 hover:border-gray-500 hover:text-gray-700">
                События
            </button>
        </li>
        <li>
            <button id="project_button"
                class="my-2 block border-x-0 border-b-2 border-t-0 border-neutral-200 px-2 md:px-5 lg:px-10 pb-2 lg:pb-3.5 pt-4 sm:text-xs md:text-sm lg:text-lg font-thin text-neutral-600 hover:border-gray-500 hover:text-gray-700">
                Проекты
            </button>
        </li>
        <li>
            <button id="vacancy_button"
                class="my-2 block border-x-0 border-b-2 border-t-0 border-neutral-200 px-2 md:px-5 lg:px-10 pb-2 lg:pb-3.5 pt-4 sm:text-xs md:text-sm lg:text-lg font-thin text-neutral-600 hover:border-gray-500 hover:text-gray-700">
                Работа
            </button>
        </li>
        <li>
            <button id="news_button"
                class="my-2 block border-x-0 border-b-2 border-t-0 border-neutral-200 px-2 md:px-5 lg:px-10 pb-2 lg:pb-3.5 pt-4 sm:text-xs md:text-sm lg:text-lg font-thin text-neutral-600 hover:border-gray-500 hover:text-gray-700">
                Новости
            </button>
        </li>
    </ul>
</div>
<div class="flex basis-full mt-3 mb-16" id="events">
    @if ($entity->events->isEmpty())
        <div class="w-full text-center p-4">
            <div class="flex items-center text-center justify-center">
                <h3 class="text-2xl font-normal mx-auto">У КОМПАНИИ НЕТ ПРЕДСТОЯЩИХ МЕРОПРИЯТИЙ</h3>
            </div>
        </div>
    @else
        <div class="w-full grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-3 lg:gap-5">
            @foreach ($entity->events as $event)
                <div class="block rounded-lg bg-white h-80">
                    <a href="{{ route('events.show', ['id' => $event->id]) }}" class="block h-52">
                        @if ($event->image == null)
                            <img class="h-48 w-full rounded-2xl p-2 flex object-cover"
                                src="{{ url('/image/no-image.png') }}" alt="image" />
                        @else
                            <img class="h-48 w-full rounded-2xl p-2 flex object-cover"
                                src="{{ asset('storage/' . $event->image) }}" alt="image">
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
    @if ($entity->projects->isEmpty())
        <div class="w-full text-center p-4">
            <div class="flex items-center text-center justify-center">
                <h3 class="text-2xl font-normal mx-auto">У КОМПАНИИ НЕТ ПРОЕКТОВ</h3>
            </div>
        </div>
    @else
        <div class="w-full grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-3 lg:gap-5">
            @foreach ($entity->projects as $project)
                <div class="block rounded-lg bg-white h-96">
                    <a href="{{ route('projects.show', ['id' => $project->id]) }}" class="block h-52">
                        @if ($project->image == null)
                            <img class="h-48 w-full rounded-2xl p-2 flex object-cover"
                                src="{{ url('/image/no-image.png') }}" alt="image" />
                        @else
                            <img class="h-48 w-full rounded-2xl p-2 flex object-cover"
                                src="{{ asset('storage/' . $project->image) }}" alt="image">
                        @endif
                    </a>
                    <div class="px-6">
                        <h5 class="mb-3 break-words text-lg font-medium leading-tight text-neutral-800 h-20">
                            {{ $project->name }}
                        </h5>
                        <hr class="my-2">
                        <div>
                            <div class="my-2 flex flex-row">
                                <div class="basis-1/2 text-left font-bold">{{ $project->donations_need }} руб.
                                </div>
                                <div class="basis-1/2 text-right">{!! round($project->donations_have ? ($project->donations_have * 100) / $project->donations_need : 0) !!} %</div>
                            </div>
                            <div class="w-full bg-gray-200">
                                <div class="bg-green-500 h-5 text-gray-50 align-middle p-0.5 text-center text-md font-medium leading-none text-primary-100"
                                    style='width: {!! round($project->donations_have ? ($project->donations_have * 100) / $project->donations_need : 0) !!}%'></div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
<div class="basis-full mt-3 mb-16 hidden" id="vacancies">
    @if ($entity->works->isEmpty())
        <div class="w-full text-center p-4">
            <div class="flex items-center text-center justify-center">
                <h3 class="text-2xl font-normal mx-auto">У КОМПАНИИ НЕТ ВАКАНСИЙ</h3>
            </div>
        </div>
    @else
        <div class="w-full grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-3 lg:gap-5">
            @foreach ($entity->works as $work)
                <div class="block rounded-lg bg-white h-80">
                    <a href="{{ route('vacancy.show', ['id' => $work->id]) }}" class="block h-52">
                        @if ($work->parent == null)
                            <img class="h-48 w-full rounded-2xl p-2 flex object-cover"
                                src="{{ url('/image/no-image.png') }}" alt="image" />
                        @else
                            @if ($work->parent->image == null)
                                <img class="h-48 w-full rounded-2xl p-2 flex object-cover"
                                    src="{{ url('/image/no-image.png') }}" alt="image" />
                            @else
                                <img class="h-48 w-full rounded-2xl p-2 flex object-cover"
                                    src="{{ asset('storage/' . $work->parent->image) }}" alt="image">
                            @endif
                        @endif
                    </a>
                    <div class="px-6">
                        <h5 class="mb-3 break-words text-lg font-medium leading-tight text-neutral-800">
                            {{ $work->name }}
                        </h5>
                        <hr class="my-2">
                        <div class="my-4 break-all text-base text-right">
                            <p class="mx-3 inline text-md font-bold">
                                @if ($work->price !== null && $work->price !== 0)
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
    @if ($entity->news->isEmpty())
        <div class="w-full text-center p-4">
            <div class="flex items-center text-center justify-center">
                <h3 class="text-2xl font-normal mx-auto">У КОМПАНИИ НЕТ НОВОСТЕЙ</h3>
            </div>
        </div>
    @else
        <div class="w-full grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-3 lg:gap-5">
            @foreach ($entity->news as $new)
                <div class="block rounded-lg bg-white h-80">
                    <a href="{{ route('news.show', ['id' => $new->id]) }}" class="block h-52">
                        @if ($new->image == null)
                            <img class="h-48 w-full rounded-2xl p-2 flex object-cover"
                                src="{{ url('/image/no-image.png') }}" alt="image" />
                        @else
                            <img class="h-48 w-full rounded-2xl p-2 flex object-cover"
                                src="{{ asset('storage/' . $new->image) }}" alt="image">
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
