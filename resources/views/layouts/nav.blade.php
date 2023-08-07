<nav class="flex-no-wrap relative flex w-full items-center justify-between bg-white lg:flex-wrap lg:justify-start p-2 lg:py-5">
    <div class="flex w-11/12 flex-wrap items-center justify-between mx-auto">
        <div class="block px-2 xl:hidden">
            <a class="" href="{{ route('home') }}">
                <img src="{{ url('/image/logo.png')}}" class="w-21 h-7" alt="logo" />
            </a>
        </div>
        <div class="block px-2 xl:hidden">
            <button class="text-blue-600 text-sm hover:text-blue-400 locationButton" id="locationButton">
                <img src="{{ url('/image/location-marker.png')}}" class="w-4 h-4 inline" />
                @if ($city)
                {{ preg_replace("/\([^)]+\)/","", $city) }}
                @else
                Вся Россия
                @endif
            </button>
        </div>
        <button class="block px-2 xl:hidden" type="button" id="openMenu">
            <span class="[&>svg]:w-7">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-7 w-7">
                    <path fill-rule="evenodd" d="M3 6.75A.75.75 0 013.75 6h16.5a.75.75 0 010 1.5H3.75A.75.75 0 013 6.75zM3 12a.75.75 0 01.75-.75h16.5a.75.75 0 010 1.5H3.75A.75.75 0 013 12zm0 5.25a.75.75 0 01.75-.75h16.5a.75.75 0 010 1.5H3.75a.75.75 0 01-.75-.75z" clip-rule="evenodd" />
                </svg>
            </span>
        </button>
        <div class="bg-white w-full min-h-screen absolute top-0 right-0 z-40 hidden" id="menu">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" id="closeMenu" class="w-6 h-6 absolute right-8 top-3">
                <g>
                    <path d="M21 21L12 12M12 12L3 3M12 12L21.0001 3M12 12L3 21.0001" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </g>
            </svg>
            <ul class="list-style-none mx-auto flex flex-col pl-0 text-center text-xl mt-10">
                <li class="mb-4 my-2 p-4 flex border justify-center">
                    @auth
                    <div class="flex flex-row items-center">
                        <a class="mx-6 text-md" href="{{ route('dashboard') }}">{{ Auth::user()->email }}</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="inline-block bg-orange-600 rounded-lg px-6 pb-2 pt-2.5 text-white" href="{{ route('register') }}">
                                Выход
                            </button>
                        </form>
                    </div>
                    @endauth

                    @guest
                    <div class="flex flex-row items-center">
                        <a class="mx-4" href="{{ route('login') }}">Войти</a>
                        <a class="mx-4" href="{{ route('register') }}">
                            Регистрация
                        </a>
                    </div>
                    @endguest
                </li>
                <li class="mb-2 block">
                    <a class="" href="{{ route('project.index') }}">Проекты</a>
                </li>
                <li class="mb-2">
                    <a class="" href="{{ route('offer.index') }}">Маркет</a>
                </li>
                <li class="mb-2">
                    <a class="" href="{{ route('event.index') }}">Афиша</a>
                </li>
                <li class="mb-2">
                    <a class="" href="{{ route('news.index') }}">Новости</a>
                </li>
                <li class="mb-2">
                    <a class="" href="{{ route('group.index') }}">Группы</a>
                </li>
                <li class="mb-2">
                    <a class="" href="{{ route('vacancy.index') }}">Работа</a>
                </li>
            </ul>
        </div>
        <div class="hidden flex-grow items-center xl:flex">
            <a href="{{ route('home') }}">
                <img src="{{ url('/image/logo.png')}}" class="w-30 h-10" alt="logo" />
            </a>
        </div>
        <div class="visible hidden flex-grow basis-full items-center xl:!flex xl:basis-auto">
            <ul class="list-style-none mr-5 flex flex-col pl-0 lg:flex-row">
                <li class="mb-4 lg:mb-0 lg:pr-4 mr-3">
                    <a class="" href="{{ route('project.index') }}">Проекты</a>
                </li>
                <li class="mb-4 lg:mb-0 lg:pr-4 mr-3">
                    <a class="" href="{{ route('offer.index') }}">Маркет</a>
                </li>
                <li class="mb-4 lg:mb-0 lg:pr-4 mr-3">
                    <a class="" href="{{ route('event.index') }}">Афиша</a>
                </li>
                <li class="mb-4 lg:mb-0 lg:pr-4 mr-3">
                    <a class="" href="{{ route('news.index') }}">Новости</a>
                </li>
                <li class="mb-4 lg:mb-0 lg:pr-4 mr-3">
                    <a class="" href="{{ route('group.index') }}">Группы</a>
                </li>
                <li class="mb-4 lg:mb-0 lg:pr-4 mr-3">
                    <a class="" href="{{ route('vacancy.index') }}">Работа</a>
                </li>
            </ul>
        </div>
        <div class="hidden lg:basis-1/3 xl:flex basis-1/4 items-center justify-between">
            <div class="block">
                <button class="text-blue-600 text-sm hover:text-blue-400 block locationButton" id="locationButton">
                    <img src="{{ url('/image/location-marker.png')}}" class="w-4 h-4 inline align-middle" />
                    @isset ($city)
                    {{ preg_replace("/\([^)]+\)/","", $city) }}
                    @else
                    Вся Россия
                    @endisset
                </button>
            </div>

            @auth
            <div class="flex flex-row items-center">
                <a class="mx-6 text-md" href="{{ route('dashboard') }}">{{ Auth::user()->email }}</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="inline-block bg-orange-600 rounded-lg px-6 pb-2 pt-2.5 text-white" href="{{ route('register') }}">
                        Выход
                    </button>
                </form>
            </div>
            @endauth

            @guest
            <div class="flex flex-row items-center">
                <a class="mx-4" href="{{ route('login') }}">Войти</a>
                <a class="inline-block bg-orange-600 rounded-lg px-6 pb-2 pt-2.5 text-white" href="{{ route('register') }}">
                    Регистрация
                </a>
            </div>
            @endguest

        </div>
    </div>
</nav>

<div id="location_form" class="hidden fixed inset-0 px-4 min-h-full overlow-hidden sm:px-0 z-50" focusable>
    <div class="absolute inset-0 bg-gray-500 opacity-75 location-close"></div>

    <div class="my-5 mx-auto opacity-100 translate-y-0 sm:scale-100 bg-white rounded-lg overflow-auto shadow-xl transform transition-all sm:w-11/12 lg:w-10/12 h-5/6">
        
        <div class="m-7">
        <x-secondary-button class="location-close absolute right-4 top-4">
            {{ __('Закрыть') }}
        </x-secondary-button>
            @foreach($cities as $letter => $letterCities)
            <h3 class="text-xl font-bold my-2">{{ $letter }}</h3>
            <div class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                @foreach($letterCities as $city)
                <div class="px-1 hover:text-gray-500">
                    <a href="{{ route('changeCity', ['id' => $city->id ]) }}">
                    {{ $city->name }}
                    </a>
                </div>
                @endforeach
            </div>
            <hr class="my-4">
            @endforeach
        </div>
    </div>
</div>

<script type='text/javascript'>
    $(document).ready(function() {
        $(".locationButton").click(function() {
            $("#location_form").toggle();
            $('body, html').css('overflow', 'hidden')
        });
        $(".location-close").click(function() {
            $("#location_form").toggle();
            $('body, html').css('overflow', 'visible')
        });
    });
</script>