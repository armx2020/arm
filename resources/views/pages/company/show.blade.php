@extends('layouts.app')
@section('title', '- МАРКЕТ')
@section('content')

    <x-pages.breadcrumbs secondPositionUrl="{{ route('companies.index') }}" secondPositionName='Компании'
        fourthPositionUrl="{{ route('companies.show', ['id' => $company->id]) }}" fourthPositionName="{{ $company->name }}" />
    <section>
        <div class="flex flex-col mx-auto my-6 lg:my-8">
            <div class="flex flex-col md:flex-row basis-full bg-white rounded-md p-1 lg:p-3">


                <div class="flex flex-col basis-1/5 flex-none" @if ($company->image !== null && count($company->offers) > 0) id="slider" @endif>
                    <ul>
                        @if ($company->image == null)
                            <img src="{{ url('/image/no-image.png') }}" class="h-56 w-56 rounded-2xl p-2 flex object-cover"
                                alt="image" />
                        @else
                            <li><img src="{{ asset('storage/' . $company->image) }}"
                                    class="h-56 w-full rounded-2xl p-2 flex object-cover" alt="image"></li>
                        @endif



                        @if (count($company->offers) > 0)
                            @foreach ($company->offers as $offer)
                                @if ($offer->image)
                                    <li><img src="{{ asset('storage/' . $offer->image) }}"
                                            class="h-56 w-full rounded-2xl p-2 flex object-cover" alt="image"></li>
                                @endif

                                @if ($offer->image1)
                                    <li><img src="{{ asset('storage/' . $offer->image) }}"
                                            class="h-56 w-full rounded-2xl p-2 flex object-cover" alt="image"></li>
                                @endif

                                @if ($offer->image2)
                                    <li><img src="{{ asset('storage/' . $offer->image) }}"
                                            class="h-56 w-full rounded-2xl p-2 flex object-cover" alt="image"></li>
                                @endif

                                @if ($offer->image3)
                                    <li><img src="{{ asset('storage/' . $offer->image) }}"
                                            class="h-56 w-full rounded-2xl p-2 flex object-cover" alt="image"></li>
                                @endif

                                @if ($offer->image4)
                                    <li><img src="{{ asset('storage/' . $offer->image) }}"
                                            class="h-56 w-full rounded-2xl p-2 flex object-cover" alt="image"></li>
                                @endif

                                @if ($offer->image5)
                                    <li><img src="{{ asset('storage/' . $offer->image) }}"
                                            class="h-56 w-full rounded-2xl p-2 flex object-cover" alt="image"></li>
                                @endif
                            @endforeach
                        @endif
                    </ul>
                </div>
                <div class="flex flex-col px-3 lg:px-6 sm:basis-full">
                    <h3 class="text-left text-xl lg:text-2xl mx-4">
                        {{ mb_substr($company->name, 0, 130, 'UTF-8') }}
                        @if (mb_strlen($company->name) > 130)
                            ...
                        @endif
                    </h3>
                    <p class="text-left text-sm mx-4 my-1 text-gray-500 break-all">
                        {{ mb_substr($company->name, 0, 400, 'UTF-8') }}
                        @if (mb_strlen($company->name) > 400)
                            ...
                        @endif
                    </p>

                    <hr class="mt-3 mb-3">

                    <div class="flex flex-col basis-1/2">
                        <div class="overflow-x-auto">
                            <div class="inline-block">
                                <div class="overflow-hidden">
                                    <table class="min-w-full text-center text-sm text-surface dark:text-white">
                                        <tbody>
                                            @if ($company->address)
                                                <tr>
                                                    <td class="whitespace-nowrap px-6 py-1 text-left">Адрес:</td>
                                                    <td class="whitespace-nowrap px-6 py-1 text-left">
                                                        {{ $company->city->name }},
                                                        {{ $company->address }}</td>
                                                </tr>
                                            @endif

                                            @if ($company->web)
                                                <tr>
                                                    <td class="whitespace-nowrap px-6 py-1 text-left">Веб-сайт:</td>
                                                    <td class="whitespace-nowrap px-6 py-1 text-left">{{ $company->web }},
                                                        {{ $company->web }}</td>
                                                </tr>
                                            @endif

                                            @if ($company->phone)
                                                <tr>
                                                    <td class="whitespace-nowrap px-6 py-1 text-left">Телефон:</td>
                                                    <td class="whitespace-nowrap px-6 py-1 text-left">
                                                        {{ $company->phone }},
                                                        {{ $company->phone }}</td>
                                                </tr>
                                            @endif

                                            @if ($company->whatsapp)
                                                <tr>
                                                    <td class="whitespace-nowrap px-6 py-1 text-left">whatsapp:</td>
                                                    <td class="whitespace-nowrap px-6 py-1 text-left">
                                                        {{ $company->whatsapp }},
                                                        {{ $company->whatsapp }}</td>
                                                </tr>
                                            @endif

                                            @if ($company->telegram)
                                                <tr>
                                                    <td class="whitespace-nowrap px-6 py-1 text-left">telegram:</td>
                                                    <td class="whitespace-nowrap px-6 py-1 text-left">
                                                        {{ $company->telegram }},
                                                        {{ $company->telegram }}</td>
                                                </tr>
                                            @endif

                                            @if ($company->viber)
                                                <tr>
                                                    <td class="whitespace-nowrap px-6 py-1 text-left">Вайбер:</td>
                                                    <td class="whitespace-nowrap px-6 py-1 text-left">
                                                        {{ $company->viber }},
                                                        {{ $company->viber }}</td>
                                                </tr>
                                            @endif

                                            @if ($company->instagram)
                                                <tr>
                                                    <td class="whitespace-nowrap px-6 py-1 text-left">instagram:</td>
                                                    <td class="whitespace-nowrap px-6 py-1 text-left">
                                                        {{ $company->instagram }},
                                                        {{ $company->instagram }}</td>
                                                </tr>
                                            @endif

                                            @if ($company->vkontakte)
                                                <tr>
                                                    <td class="whitespace-nowrap px-6 py-1 text-left">vkontakte:</td>
                                                    <td class="whitespace-nowrap px-6 py-1 text-left">
                                                        {{ $company->vkontakte }},
                                                        {{ $company->vkontakte }}</td>
                                                </tr>
                                            @endif

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="ya-share2" data-curtain data-size="s" data-shape="round" data-limit="0"
                    data-more-button-type="short" data-services="vkontakte,odnoklassniki,telegram,viber,whatsapp"></div>
            </div>

            @if (count($company->offers) > 0)
                <div class="flex flex-col basis-full my-5">
                    <div class="w-full text-left p-4 mt-8">
                        <div class="flex items-center text-left justify-left">
                            <h3 class="text-2xl font-normal">Товары компании</h3>
                        </div>
                    </div>
                    <hr class="w-full mb-4">
                    <div class="grid grid-cols-1 md:grid-cols-3 xl:grid-cols-4 gap-3 lg:gap-5">
                        @foreach ($company->offers as $offer)
                            <div class="block rounded-lg bg-white h-80">
                                <a href="{{ route('offers.show', ['id' => $offer->id]) }}" class="block h-52">
                                    @if ($offer->image == null)
                                        <img class="h-48 w-full rounded-2xl p-2 flex object-cover"
                                            src="{{ url('/image/no-image.png') }}" alt="image" />
                                    @else
                                        <img class="h-48 w-full rounded-2xl p-2 flex object-cover"
                                            src="{{ asset('storage/' . $offer->image) }}" alt="image">
                                    @endif
                                </a>
                                <div class="px-6">
                                    <div class="h-12">
                                        <h5 class="mb-3 break-words text-lg font-medium leading-tight text-neutral-800">
                                            {{ $offer->name }}
                                        </h5>
                                    </div>
                                    <hr class="my-2">
                                    <div>
                                        <p class="text-right font-bold pb-0">
                                            {{ $offer->price }} {{ $offer->unit_of_price }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

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
                @if ($company->events->isEmpty())
                    <div class="w-full text-center p-4">
                        <div class="flex items-center text-center justify-center">
                            <h3 class="text-2xl font-normal mx-auto">У КОМПАНИИ НЕТ ПРЕДСТОЯЩИХ МЕРОПРИЯТИЙ</h3>
                        </div>
                    </div>
                @else
                    <div class="w-full grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-3 lg:gap-5">
                        @foreach ($company->events as $event)
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
                @if ($company->projects->isEmpty())
                    <div class="w-full text-center p-4">
                        <div class="flex items-center text-center justify-center">
                            <h3 class="text-2xl font-normal mx-auto">У КОМПАНИИ НЕТ ПРОЕКТОВ</h3>
                        </div>
                    </div>
                @else
                    <div class="w-full grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-3 lg:gap-5">
                        @foreach ($company->projects as $project)
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
                @if ($company->works->isEmpty())
                    <div class="w-full text-center p-4">
                        <div class="flex items-center text-center justify-center">
                            <h3 class="text-2xl font-normal mx-auto">У КОМПАНИИ НЕТ ВАКАНСИЙ</h3>
                        </div>
                    </div>
                @else
                    <div class="w-full grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-3 lg:gap-5">
                        @foreach ($company->works as $work)
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
                @if ($company->news->isEmpty())
                    <div class="w-full text-center p-4">
                        <div class="flex items-center text-center justify-center">
                            <h3 class="text-2xl font-normal mx-auto">У КОМПАНИИ НЕТ НОВОСТЕЙ</h3>
                        </div>
                    </div>
                @else
                    <div class="w-full grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-3 lg:gap-5">
                        @foreach ($company->news as $new)
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
